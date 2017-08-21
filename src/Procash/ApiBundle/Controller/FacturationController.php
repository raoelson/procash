<?php

namespace Procash\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Procash\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Procash\AdministrationBundle\Entity\Reseau;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of FacturationController
 *
 * @author Prince BABAY
 */
class FacturationController extends Controller {

    public function getFacturationsAction() {
        $facturations = $this->getDoctrine()->getManager()->getRepository("ProcashGestionBundle:Facturation")->findBy(array('loginSaisi'=>null, 'dateSuppression'=>null));
        $response = new Response();
        $facturationsTab = array();

        foreach ($facturations as $f) {
            if ($f->getLoginSaisi()) {
                $editable = false;
            } else {
                $editable = true;
            }
            if (($montantEncaisse = $f->getMontantEncaisseSaisi()) == null) {
                $montantEncaisse = $f->getMontantEncaisse();
            }
            array_push(
                    $facturationsTab, array(
                'id' => $f->getId(),
                'numeroFacture' => $f->getNumeroFacture(),
                'montantFacture' => $f->getMontantFacture(),
                'montantEncaisse' => $montantEncaisse,
                'montantAvoir' => ($f->getMontantAvoir()!=null ? $f->getMontantAvoir() : 0),
                'nomRecu' => $f->getNomRecu(),
                'emailClient' => $f->getEmailClient(),
                'clientId' => $f->getClient()->getId(),
                'montantDu' => ($f->getMontantDu()!=null ? $f->getMontantDu() : 0),
                'date' => date_format($f->getDate(), "Y-m-d"),
                'editable' => $editable
                    )
            );
        }
        $response->setContent(json_encode($facturationsTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setFacturationsAction(Request $request) {
        $data = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $data = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        $em = $this->getDoctrine()->getManager();
        $myData = array();
        foreach ($data as $value) {
            $facturation = $em->getRepository("ProcashGestionBundle:Facturation")->find($value["id"]);
            $facturation->setBanque(null);
            $facturation->setDateHeureSaisi(new \DateTime());
            $facturation->setMontantAvoir($value["montant_avoir"]);
            $facturation->setMontantEncaisseSaisi($value["montant_encaisse"]);
            $facturation->setMontantDu($value["montant_du"]);
            $facturation->setMontantFacture($value["montant_facture"]);
            $facturation->setNumeroFacture($value["numero_facture"]);
            $facturation->setNomRecu($value["numero_recu"]);
            if(isset($value["appVersion"])){
               $facturation->setAppVersion($value["appVersion"]);
            }
            if(isset($value["adresseMac"])){
               $facturation->setMac($value["adresseMac"]);
            }
            if(isset($value["descript"])){
               $facturation->setDescriptionSync($value["descript"]);
            }        
            $user = $em->getRepository("ProcashUserBundle:User")->find($value["userId"]);
            $facturation->setLoginSaisi($user);
            $myData = $value["paiement"];
            if (array_key_exists('espece', $myData)) {
                $typePaiement = $em->getRepository("ProcashAdministrationBundle:TypePaiement")->findOneByCode("ESP");
                $facturation->setTypePaiement($typePaiement);
                $facturation->setBanque(null);
                $facturation->setNumeroCheque(null);
            }
            if (array_key_exists('traite', $myData)) {
                $typePaiement = $em->getRepository("ProcashAdministrationBundle:TypePaiement")->findOneByCode("TRE");
                $facturation->setTypePaiement($typePaiement);
            }
            if (array_key_exists('cheque', $myData)) {
                $typePaiement = $em->getRepository("ProcashAdministrationBundle:TypePaiement")->findOneByCode("CHQ");
                $banque = $em->getRepository("ProcashAdministrationBundle:Banque")->find($myData["cheque"]["banque"]);
                $facturation->setNumeroCheque($myData["cheque"]["numero"]);
                $facturation->setTypePaiement($typePaiement);
                $facturation->setBanque($banque);
            }

            $em->persist($facturation);
        }
        $em->flush();

        $response = new Response();
        $response->setContent(json_encode(array("status" => 200, "etat" => "success")));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
