<?php

namespace Procash\GestionBundle\Controller;

use DateTime;
use Procash\GestionBundle\Entity\SaisiFermeture;
use Procash\GestionBundle\Form\SaisiFermetureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SaisiFermetureController extends Controller {

    /**
     * @Template
     */
    public function saisiFermetureAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $saisiFermeture = new SaisiFermeture();
        $form = $this->createForm(new SaisiFermetureType(), $saisiFermeture);
        $lisetMotifFermetures = $em->getRepository('ProcashAdministrationBundle:MotifFermeture')->findBy(array('dateSuppression' => null));
        $saisiFerms = $em->getRepository('ProcashGestionBundle:SaisiFermeture')->findBy(array('dateSuppression' => null));
        $listesClients = $em->getRepository('ProcashAdministrationBundle:Client')->findBy(array('dateSuppression' => null));
        $dateDebut = null;
        $dateFin = null;
        $client = null;
        $motif = null;

        if ($request->isMethod('POST')) {
            $f = $request->request->get('filtre');
            if (!is_null($f['date_debut'])) {
                $dateDebut = $f['date_debut'];
            }
            if (!is_null($f['date_fin'])) {
                $dateFin = $f['date_fin'];
            }
            if (!is_null($f['client'])) {
                $client = $f['client'];
            }
            if (!is_null($f['motif'])) {
                $motif = $f['motif'];
            }
            $saisiFerms = $em->getRepository('ProcashGestionBundle:SaisiFermeture')->getMotifFermeturesFiltre($request->request->get('filtre'));
        }
        return array(
            "listeFermeture" => $saisiFerms,
            "form" => $form->createView(),
            "listeMotifFermeture" => $lisetMotifFermetures,
            "listesClients" => $listesClients,
            "dateDebut" => $dateDebut,
            "dateFin" => $dateFin,
            "client" => $client,
            "motif" => $motif,
        );
    }

    /**
     * @Template()
     */
    public function ajouterAction() {
        $request = $this->getRequest();
        $userEncours = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $fermeture = new SaisiFermeture();
        $delaiFermeture = $em->getRepository('ProcashAdministrationBundle:DelaiFermeture')->findAll();
        $form = $this->createForm(new SaisiFermetureType(), $fermeture);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $request->get('procash_gestionbundle_saisifermeture');
                $dateDebut = $data['dateDebutFermeture'];
                $dateDebutFermeture = DateTime::createFromFormat('d/m/Y', $dateDebut);
                $dateFin = $data['dateFinFermeture'];
                $dateFinFermeture = DateTime::createFromFormat('d/m/Y', $dateFin);
                $cli = $data['client'];
                $client = $em->getRepository('ProcashAdministrationBundle:Client')->find($cli);
                $fermeture->setClient($client);
                $fermeture->setDateDebutFermeture($dateDebutFermeture);
                $fermeture->setDateFinFermeture($dateFinFermeture);
                $fermeture->setDateHeureSaisie(new \Datetime());
                $fermeture->setLoginSaisie($userEncours);
                $em->persist($fermeture);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Fermeture ajoutée avec succès.');
                return $this->redirect($this->generateUrl('procash_liste_fermeture'));
            }
        }
        $listeFermetures = $em->getRepository('ProcashAdministrationBundle:Titre')->findBy(array('dateSuppression' => null));
        return array(
            "listeFermeture" => $listeFermetures,
            "form" => $form->createView(),
            "delaiFermeture" => $delaiFermeture
        );
    }

    /**
     * @Template()
     */
    public function modifierAction($id) {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $userEncours = $this->get('security.context')->getToken()->getUser();
        $fermeture = $em->getRepository('ProcashGestionBundle:SaisiFermeture')->find($id);
        $delaiFermeture = $em->getRepository('ProcashAdministrationBundle:DelaiFermeture')->findAll();
        $form = $this->createForm(new SaisiFermetureType(), $fermeture);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $request->get('procash_gestionbundle_saisifermeture');
                $dateDebut = $data['dateDebutFermeture'];
                $dateDebutFermeture = DateTime::createFromFormat('d/m/Y', $dateDebut);
                $dateFin = $data['dateFinFermeture'];
                $dateFinFermeture = DateTime::createFromFormat('d/m/Y', $dateFin);
                $cli = $data['client'];
                $client = $em->getRepository('ProcashAdministrationBundle:Client')->find($cli);
                $fermeture->setClient($client);
                $fermeture->setDateDebutFermeture($dateDebutFermeture);
                $fermeture->setDateFinFermeture($dateFinFermeture);
                $fermeture->setDateHeureSaisie(new \Datetime());
                $fermeture->setLoginSaisie($userEncours);
                $em->persist($fermeture);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Fermeture modifiée avec succès.');
                return $this->redirect($this->generateUrl('procash_liste_fermeture'));
            }
        }
        $listeFermetures = $em->getRepository('ProcashAdministrationBundle:Titre')->findBy(array('dateSuppression' => null));
        return array(
            'listeFermeture' => $listeFermetures,
            'form' => $form->createView(),
            'fermeture' => $fermeture,
            "delaiFermeture" => $delaiFermeture
        );
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $fermeture = $em->getRepository('ProcashGestionBundle:SaisiFermeture')->find($id);
        $fermeture->setDateSuppression(new \Datetime());
        $em->persist($fermeture);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', 'Fermeture supprimée avec succès.');
        return $this->redirect($this->generateUrl('procash_liste_fermeture'));
    }

    public function csvFermeture($em, $ftp_conn) {
        $fermetures = $em->getRepository('ProcashGestionBundle:SaisiFermeture')->findBy(array('dateSuppression' => null));
        $list [] = array("JF_RES_ID", "JF_CLI_ID", "JF_DATE_DEBUT", "JF_DATE_FIN", "JF_MOTF_FERMETURE", "JF_Login_saisi", "JF_date_heure_saisie");
        if ($fermetures !== NULL) {
            foreach ($fermetures as $f) {
                $ddf = $this->dateToString($f->getDateDebutFermeture()); // date debut fermeture
                $dff = $this->dateToString($f->getDateFinFermeture()); // date fin fermeture
                $dhsf = $this->dateToString($f->getDateHeureSaisie()); // date de saisie fermeture
                $list[] = array($f->getClient()->getReseau()->getId(), $f->getClient()->getId(), $ddf, $dff, $f->getMotifFermeture()->getLibelle(), $f->getLoginSaisie()->getUsername(), $dhsf);
            }
            $date = new \DateTime();
            $dateEtHeure = $date->format('YmdHi');
            $fichier = __DIR__ . '/../../../../web/export/Fermetures_' . $dateEtHeure . '.csv';
            $file = fopen($fichier, "w");
            foreach ($list as $line) {
                fputcsv($file, $line, '|');
            }
            fclose($file);
            if (ftp_put($ftp_conn, 'public_html/procash/exports/fermetures/Fermetures_' . $dateEtHeure . '.csv', $fichier, FTP_ASCII)) {
                if (file_exists($fichier)) {
                    unlink($fichier);
                }
            } else {
                echo "Error uploading $file.";
            }
        }
    }

    public function csvChiffreVente($em, $ftp_conn) {
        $chiffreVentes = $em->getRepository('ProcashGestionBundle:ChiffreVente')->findBy(array('dateSuppression' => null));
        $list [] = array("CV_CLI_ID", "CV_PRD_ID", "CV_DATE", "CV_Invendu_saisi", "CV_Regul_saisi", "CV_Login_saisi", "CV_date_heure_saisie", "CV_Login_modif", "CV_date_heure_modif");
        if ($chiffreVentes !== NULL) {
            foreach ($chiffreVentes as $cv) {
                if (!is_null($cv->getDate())) {
                    $d = $cv->getDate();
                    $dateParution = $d->format('d-m-Y');
                } else {
                    $dateParution = '-';
                }
                if (!is_null($cv->getDateHeureSaisi())) {
                    $dhsl = $this->dateToString($cv->getDateHeureSaisi()); // date heure de la personne qui saisie
                } else {
                    $dhsl = '-';
                }
                if (!is_null($cv->getDateModification())) {
                    $dhsm = $this->dateToString($cv->getDateModification()); // date heure de la personne qui a modifié la saisie
                } else {
                    $dhsm = '-';
                }
                if (!is_null($cv->getLoginSaisiModif())) {
                    $loginModif = $cv->getLoginSaisiModif()->getUsername();
                } else {
                    $loginModif = '-';
                }
                if (!is_null($cv->getNombreRegulSaisi())) {
                    $nbrRegu = $cv->getNombreRegulSaisi();
                } else {
                    $nbrRegu = '-';
                }
                if (!is_null($cv->getNombreInvenduSaisi())) {
                    $nbrSaisInv = $cv->getNombreInvenduSaisi();
                } else {
                    $nbrSaisInv = '-';
                }

                $list[] = array($cv->getLoginSaisi()->getId(), $cv->getProduit()->getId(), $dateParution, $nbrSaisInv, $nbrRegu, $cv->getLoginSaisi(), $dhsl, $loginModif, $dhsm);
            }

            $date = new \DateTime();
            $dateEtHeure = $date->format('YmdHi');
            $fichier = __DIR__ . '/../../../../web/export/CHIFFRE_VENTE_' . $dateEtHeure . '.csv';
            $file = fopen($fichier, "w");
            foreach ($list as $line) {
                fputcsv($file, $line, '|');
            }
            fclose($file);
            if (ftp_put($ftp_conn, 'public_html/procash/exports/chiffres_ventes/CHIFFRE_VENTE_' . $dateEtHeure . '.csv', $fichier, FTP_ASCII)) {
                if (file_exists($fichier)) {
                    unlink($fichier);
                }
            } else {
                echo "Error uploading $file.";
            }
        }
    }

    public function csvRedistribution($em, $ftp_conn) {
        $redistributions = $em->getRepository('ProcashGestionBundle:Redistribution')->findBy(array('dateSuppression' => null));
        $list [] = array("RD_RES_ID", "RD_CLI_ID", "RD_DATE_PARUTION", "RD_PRD_ID", "RD_COMMANDES_SAISIES", "RD_Login_saisi", "RD_date_heure_saisie");
        if ($redistributions !== NULL) {
            foreach ($redistributions as $re) {
                if (!is_null($re->getTitreADistribuer())) {
                    $d = $re->getTitreADistribuer()->getDateCreation();
                    $dp = $this->dateToString($d);
                    $idProd = $re->getTitreADistribuer()->getId();
                } else {
                    $dp = '-';
                    $idProd = '-';
                }
                $dS = $re->getDateHeureSaisie();
                $dateHeureSaisie = $this->dateToString($dS);
                $list[] = array($re->getClientRedistribue()->getReseau()->getId(), $re->getClientRedistribue()->getId(), $dp, $idProd, $re->getCommandeSaisie(), $re->getLoginSaisi()->getUsername(), $dateHeureSaisie);
            }
            $date = new \DateTime();
            $dateEtHeure = $date->format('YmdHi');
            $fichier = __DIR__ . '/../../../../web/export/Redistribution_' . $dateEtHeure . '.csv';
            $file = fopen($fichier, "w");
            foreach ($list as $line) {
                fputcsv($file, $line, '|');
            }
            fclose($file);
            if (ftp_put($ftp_conn, 'public_html/procash/exports/redistributions/Redistribution_' . $dateEtHeure . '.csv', $fichier, FTP_ASCII)) {
                if (file_exists($fichier)) {
                    unlink($fichier);
                }
            } else {
                echo "Error uploading $file.";
            }
        }
    }

    public function csvEncaissement($em, $ftp_conn) {
        $encaissements = $em->getRepository('ProcashGestionBundle:Facturation')->findBy(array('dateSuppression' => null));
        $list [] = array("FA_RES_ID", "FA_CLI_ID", "FA_NUM_FAC", "FA_ANNEE", "FA_MOIS", "FA_JOUR", "FA_SOURCE", "FA_MONTANT_ENCAISSE_SAISIE", "FA_TYPE_REGLEMENT", "FA_Login_saisi", "FA_date_heure_saisie", "FA_Login_modif", "FA_date_heure_modif", "FA_Nom_du_recu", "FA_date_envoi_recu_email", "FA_date_impression_recu", "FA_Cli_email");
        if ($encaissements !== NULL) {
            foreach ($encaissements as $enc) {
                if (!is_null($enc->getDateHeureSaisi())) {
                    $d = $enc->getDateHeureSaisi();
                    $dhs = $this->dateToString($d);
                } else {
                    $dhs = '-';
                }
                if (!is_null($enc->getDateEnvoiRecuEmail())) {
                    $de = $enc->getDateEnvoiRecuEmail();
                    $derm = $this->dateToString($de);
                } else {
                    $derm = '-';
                }
                if (!is_null($enc->getDateImpressionRecu())) {
                    $dei = $enc->getDateImpressionRecu();
                    $dir = $this->dateToString($dei);
                } else {
                    $dir = '-';
                }
                if (!is_null($enc->getDateHeureModif())) {
                    $dhm = $enc->getDateHeureModif();
                    $dhmr = $this->dateToString($dhm);
                } else {
                    $dhmr = '-';
                }
                if (!is_null($enc->getLoginModifSaisi())) {
                    $loginModif = $enc->getLoginModifSaisi()->getUsername();
                } else {
                    $loginModif = '-';
                }
                $list [] = array($enc->getClient()->getReseau()->getId(), $enc->getClient()->getId(), $enc->getNumeroFacture(), $enc->getAnneeFacture(), $enc->getMoisFacture(), $enc->getJourFacture(), $enc->getSource(), $enc->getMontantEncaisseSaisi(), $enc->getTypePaiement()->getLibelle(), $enc->getLoginSaisi()->getUsername(), $dhs, $loginModif, $dhmr, $enc->getNomRecu(), $derm, $dir, $enc->getEmailClient());
            }
            $date = new \DateTime();
            $dateEtHeure = $date->format('YmdHi');
            $fichier = __DIR__ . '/../../../../web/export/Encaissement_' . $dateEtHeure . '.csv';
            $file = fopen($fichier, "w");
            foreach ($list as $line) {
                fputcsv($file, $line, '|');
            }
            fclose($file);
            if (ftp_put($ftp_conn, 'public_html/procash/exports/encaissements/Encaissement_' . $dateEtHeure . '.csv', $fichier, FTP_ASCII)) {
                if (file_exists($fichier)) {
                    unlink($fichier);
                }
            } else {
                echo "Error uploading $file.";
            }
        }
    }

    public function dateToString($d) {
        $dateEtHeure = $d->format('Y-m-d H:i:s');
        return $dateEtHeure;
    }

    public function testNull($v) {
        $valeur = (is_null($v)) ? '-' : $v;
        return $valeur;
    }

    public function creationDir($param) {
        if (!file_exists($param)) {
            $oldmask = umask(0);
            mkdir($param, 0777);
            umask($oldmask);
        }
    }

}
