<?php

namespace Procash\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\Common\Collections\ArrayCollection;
use Procash\GestionBundle\Entity\Facturation;
use Procash\GestionBundle\Entity\HistoriqueRegul;

class DefaultController extends Controller {

    /**
     * @Template()
     */
    public function modifierDetailClientAction($id = null) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $idFacture = $requete->attributes->get('idF');
        if ($idFacture) {
            $client = $em->getRepository('ProcashAdministrationBundle:Client')->find($id);
            $facture = $em->getRepository('ProcashGestionBundle:Facturation')->find($idFacture);
            $dateFacture = $facture->getDate();
        }
        //Affichage detail facturation
        $detailsFacturationsQuotidien = $em->getRepository('ProcashGestionBundle:ChiffreVente')->getDetailsFacturationQuotidienPar($id, $dateFacture->format('Y-m'));
        $detailsFacturationsVisu = $em->getRepository('ProcashGestionBundle:ChiffreVente')->getDetailsFacturationVisuPar($id, $dateFacture->format('Y-m'));
        return array(
            'detailFacturationQuotidien' => $detailsFacturationsQuotidien,
            'client' => $client,
            'detailFacturationVisu' => $detailsFacturationsVisu,
        );
    }

    /**
     * @Template()
     */
    public function modifierFactureAction($id) {
        $em = $this->getDoctrine()->getManager();
        $facturation = $em->getRepository('ProcashGestionBundle:Facturation')->find($id);
        $ancBanque = $facturation->getBanque();
        $modePaiements = $em->getRepository('ProcashAdministrationBundle:TypePaiement')->findBy(array('dateSuppression' => null));
        $listeBanques = $em->getRepository('ProcashAdministrationBundle:Banque')->findBy(array('dateSuppression' => null));
        $request = $this->getRequest();
        $userEncours = $this->get('security.context')->getToken()->getUser();
        $nomRecu = null;
        $numCheque = null;
        $montant = null;
        $banqueId = null;
        $banque = null;
        if ($request->isMethod('POST')) {
            $data = $request->get('encaissement');
            $mode = explode("__", $data['modePaiement']);
            $modePaiementId = $mode[0];
            $typePaiement = $em->getRepository('ProcashAdministrationBundle:TypePaiement')->find($modePaiementId);

            if ($typePaiement->getCode() == 'CHQ') {
                $nomRecu = $data['nomRecuC'];
                $numCheque = $data['numCheque'];
                $montant = $data['montantC'];
                $banqueId = $data['banque'];
                $banque = $em->getRepository('ProcashAdministrationBundle:Banque')->find($banqueId);
                $facturation->setBanque($banque);
            } else {
                $facturation->setBanque($ancBanque);
            }
            if ($typePaiement->getCode() == 'ESP') {
                $nomRecu = $data['nomRecuE'];
                $montant = $data['montantE'];
            }
            if ($typePaiement->getCode() == 'TRE') {
                $montant = $data['montantT'];
            }
            $echeance = \DateTime::createFromFormat('d/m/Y', $data['echeance']);
            //Clonage facturation pour avoir l'historique des montants saisis
            $factC = clone $facturation;
            $facturation->setDateSuppression(new \DateTime());
            if (is_null($facturation->getIdParent())) {
                $facturation->setIdParent($id);
                $factC->setIdParent($id);
            } else {
                $facturation->setIdParent($facturation->getIdParent());
                $factC->setIdParent($facturation->getId());
            }
            $factC->setMontantEncaisse($montant);
            $factC->setMontantEncaisseSaisi($montant);
            $factC->setNomRecu($nomRecu);
            $factC->setNumeroCheque($numCheque);
            $factC->setEcheance($echeance);
            $factC->setTypePaiement($typePaiement);
            $factC->setLoginModifSaisi($userEncours);

            //Calcul montant du = montant_facture - montant_encaisse - montant_avoir
            $montantFact = $factC->getMontantFacture();
            $montantEnc = floatval($montant);
            $montantAvoir = $factC->getMontantAvoir();
            $montantDu = 0;
            $montantDu = $montantFact - $montantEnc - $montantAvoir;
            $factC->setMontantDu($montantDu);
            $em->persist($factC);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Facturation modifiée avec succès');
            return $this->redirectToRoute('liste_encaissement');
        }
        return array(
            'facturation' => $facturation,
            'modePaiements' => $modePaiements,
            'listeBanques' => $listeBanques,
        );
    }

    public function modifierChiffreVenteAction(\Symfony\Component\HttpFoundation\Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userEncours = $this->get('security.context')->getToken()->getUser();
        $idChiffreVente = $request->get("id");
        $chiffreVente = $em->getRepository('ProcashGestionBundle:ChiffreVente')->find($idChiffreVente);
        if ($request->isMethod('POST')) {
            $commande = $request->get('commande');
            $regul = $request->get('regul');
            $invendu = $request->get('invendu');
            $vendu = $request->get('vendu');
            $historiqueCv = new HistoriqueRegul();
            $historiqueCv->setDateSaisie(new \DateTime());
            $historiqueCv->setInvendu($invendu);
            $historiqueCv->setLoginSaisi($userEncours);
            $historiqueCv->setNombreCommande($commande);
            $historiqueCv->setParentCv($chiffreVente);
            $historiqueCv->setRegul($regul);
            $chiffreVente->setNombreRegulSaisi($regul);
            $chiffreVente->setNombreInvenduSaisi($invendu);
            $chiffreVente->setNombreVendu($vendu);
            $chiffreVente->setNombreRegul($regul);
            $chiffreVente->setLoginSaisiModif($userEncours);
            $chiffreVente->setDateHeureSaisi(new \DateTime());
            $em->persist($historiqueCv);
            $em->flush();
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(json_encode(array("id" => $idChiffreVente)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     * @Template()
     */
    public function listeAction() {
        $em = $this->getDoctrine()->getManager();
        $listeReseaux = $em->getRepository('ProcashAdministrationBundle:Reseau')->findBy(array('dateSuppression' => null));
        $listeClients = $em->getRepository('ProcashAdministrationBundle:Client')->findBy(array('dateSuppression' => null));
        $listeCollecteurs = $em->getRepository('ProcashUserBundle:User')->getListeUserCollecteur();
        $listeReglements = $em->getRepository('ProcashAdministrationBundle:TypePaiement')->findBy(array('dateSuppression' => null));
        $listeProduits = $em->getRepository('ProcashAdministrationBundle:Produit')->findBy(array('dateSuppression' => null));
        $collectId = null;
        $clientId = null;
        $reglementId = null;
        $dateSynchro = null;
        $date = null;
        //Liste par clients
        $clients = $em->getRepository('ProcashGestionBundle:Facturation')->getListeClients();
        //Mis en place des filtres dans tableau
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $r = $request->request->get('filtre');
//            var_dump($r);die;
            if ($r['collecteur'] != 'toutes') {
                $collectId = $r['collecteur'];
            }
            if ($r['client'] != 'toutes') {
                $clientId = $r['client'];
            }
            if ($r['reglement'] != 'toutes') {
                $reglementId = $r['reglement'];
            }
            if ($r['date'] != null) {
                $dateSynchro = $r['date'];
                $date = \DateTime::createFromFormat('d/m/Y', $dateSynchro);
            }

            $clients = $em->getRepository('ProcashGestionBundle:Facturation')->getListeFacturationFiltrerPar($collectId, $clientId, $reglementId, $date);
        }
        return array(
            'clients' => $clients,
            'listeReseau' => $listeReseaux,
            'listeClients' => $listeClients,
            'listeCollecteurs' => $listeCollecteurs,
            'listeReglements' => $listeReglements,
            'listeProduits' => $listeProduits,
            'collectId' => $collectId,
            'clientId' => $clientId,
            'reglementId' => $reglementId,
            'date' => $dateSynchro,
        );
    }

    /**
     * @Template()
     */
    public function afficherHistoriqueRegulAction($id) {
        $em = $this->getDoctrine()->getManager();
        $historiqueCv = $em->getRepository('ProcashGestionBundle:HistoriqueRegul')->findBy(array('parentCv' => $id));
        return array(
            'chiffreVente' => $historiqueCv,
        );
    }

    /**
     * @Template()
     */
    public function afficherHistoriqueMontantAction($id) {
        $em = $this->getDoctrine()->getManager();
        $nvCv = $em->getRepository('ProcashGestionBundle:Facturation')->find($id);
        $facturations = $em->getRepository('ProcashGestionBundle:Facturation')->getListeHistoriqueMontant($nvCv->getIdParent());
        return array(
            'facturations' => $facturations,
        );
    }

    /**
     * @Template()
     */
    public function afficherHistoriqueInvenduAction($id) {
        $em = $this->getDoctrine()->getManager();
        $historiqueCv = $em->getRepository('ProcashGestionBundle:HistoriqueRegul')->findBy(array('parentCv' => $id));
        return array(
            'chiffreVente' => $historiqueCv,
        );
    }

    /**
     * @Template
     */
    public function factureProvisoirePdfAction(Facturation $id) {
        $em = $this->getDoctrine()->getManager();
        $pdf = $this->container->get("white_october.tcpdf")->create();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');
        $pdf->SetDisplayMode('fullpage');
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf
                ->setPrintFooter(false);

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 5, 5);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 5);
        $pdf->SetFont('helvetica', '', 9, '', true);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();
        $now = new \DateTime();
        $facturation = $em->getRepository('ProcashGestionBundle:Facturation')->find($id);
        $dateNow = $now->format('Ymd');


        $html = $this->renderView('ProcashGestionBundle:Default:factureProvisoirePdf.html.twig', array(
            'facturation' => $facturation,
            'now' => $now
        ));
        $nomPdf = $dateNow . "_" . $facturation->getNumeroFacture() . ".pdf";
        $filelocation = __DIR__ . "/../../../../web/uploads";
        $fileNL = $filelocation . "/" . $nomPdf;
        $pdf->writeHTML($html);
        $pdf->Output($fileNL, 'F');
        $pdf->Output($nomPdf, 'D');
        exit();
    }

}
