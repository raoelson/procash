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
class FermetureController extends Controller {

    public function getDelaiFermetureAction() {
        $delaiFermetures = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:delaiFermeture")->findByDateSuppression(null);
        $response = new Response();
        $delaiFermetureTab = array();

        $delFerm = $delaiFermetures[0];
        array_push(
                $delaiFermetureTab, array(
            'id' => $delFerm->getId(),
            'delaiMin' => $delFerm->getDelaiMin(),
            'seuilMax' => $delFerm->getSeuilMax(),
                )
        );

        $response->setContent(json_encode($delaiFermetureTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getMotifFermetureAction() {
        $motifs = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:MotifFermeture")->findByDateSuppression(null);
        $response = new Response();
        $motifsTab = array();

        foreach ($motifs as $m) {
            array_push(
                    $motifsTab, array(
                'id' => $m->getId(),
                'libelle' => $m->getLibelle(),
                'code' => $m->getCode(),
                    )
            );
        }

        $response->setContent(json_encode($motifsTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setFermetureAction(Request $request) {
        $data = array();
        $datas = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $datas = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }

        $em = $this->getDoctrine()->getManager();
        foreach ($datas as $data) {
            $fermeture = new \Procash\GestionBundle\Entity\SaisiFermeture();
            $client = $em->getRepository("ProcashAdministrationBundle:Client")->find($data["client"]);
            $fermeture->setClient($client);
            $fermeture->setDateDebutFermeture(date_create($data["date_debut"]));
            $fermeture->setDateFinFermeture(date_create($data["date_fin"]));
            $motifFermeture = $em->getRepository("ProcashAdministrationBundle:MotifFermeture")->find($data["motif"]);
            $fermeture->setMotifFermeture($motifFermeture);
            $user = $em->getRepository("ProcashUserBundle:User")->find($data["user"]);
            $fermeture->setLoginSaisie($user);
            $fermeture->setDateHeureSaisie(new \Datetime());
            if (isset($data["appVersion"])) {
                $fermeture->setAppVersion($data["appVersion"]);
            }
            if (isset($data["adresseMac"])) {
                $fermeture->setMac($data["adresseMac"]);
            }
            if (isset($data["descript"])) {
                $fermeture->setDescriptionSync($data["descript"]);
            }
            $em->persist($fermeture);
        }

        $em->flush();

        $response = new Response();
        $response->setContent(json_encode(array("status" => 200, "etat" => "success", "id" => $fermeture->getId())));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getFermeturesAction() {
        $fermetures = $this->getDoctrine()->getManager()->getRepository("ProcashGestionBundle:SaisiFermeture")->findByDateSuppression(null);
        $response = new Response();
        $fermeturesTab = array();

        foreach ($fermetures as $f) {
            array_push(
                    $fermeturesTab, array(
                'id' => $f->getId(),
                'dateDebut' => date_format($f->getDateDebutFermeture(), "Y-m-d"),
                'dateFin' => date_format($f->getDateFinFermeture(), "Y-m-d"),
                'clientId' => $f->getClient()->getId(),
                'motifId' => $f->getMotifFermeture()->getId(),
                'libelle' => $f->getMotifFermeture()->getLibelle()
                    )
            );
        }

        $response->setContent(json_encode($fermeturesTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getRemplacementClientAction() {
        $remplacementsClient = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:RemplacementClient")->findByDateSuppression(null);
        $response = new Response();
        $remplacementsClientTab = array();

        foreach ($remplacementsClient as $r) {
            array_push(
                    $remplacementsClientTab, array(
                'id' => $r->getId(),
                'numeroOrdre' => $r->getNumeroOrdre(),
                'clientId' => $r->getClient()->getId(),
                'numeroClientRemplacementId' => $r->getClientRemplacement()->getId()
                    )
            );
        }

        $response->setContent(json_encode($remplacementsClientTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setRedistributionAction(Request $request) {
        $data = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $data = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }

        $em = $this->getDoctrine()->getManager();
        $redistribution = new \Procash\GestionBundle\Entity\Redistribution();
        $client = $em->getRepository("ProcashAdministrationBundle:Client")->find($data["client_redistribue"]);
        $redistribution->setClientRedistribue($client);
        $clientRemplace = $em->getRepository("ProcashAdministrationBundle:Client")->find($data["depositaire"]);
        $redistribution->setClientRemplace($clientRemplace);
        $redistribution->setCommandeSaisie($data["nombre"]);
        $loginSaisi = $em->getRepository("ProcashUserBundle:User")->find($data["user"]);
        $redistribution->setLoginSaisi($loginSaisi);
        $fermeture = $em->getRepository("ProcashGestionBundle:SaisiFermeture")->find($data["fermeture"]);
        $redistribution->setFermeture($fermeture);
        $titreADistribuer = $em->getRepository("ProcashAdministrationBundle:Produit")->find($data["titre"]);
        $redistribution->setTitreADistribuer($titreADistribuer);
        $redistribution->setDateHeureSaisie(new \Datetime());
        $redistribution->setDate(new \DateTime());
        $em->persist($redistribution);
        $em->flush();

        $response = new Response();
        $response->setContent(json_encode(array("status" => 200, "etat" => "success", "id" => $redistribution->getId())));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getRedistributionAction() {
        $redistributions = $this->getDoctrine()->getManager()->getRepository("ProcashGestionBundle:Redistribution")->findByDateSuppression(null);
        $response = new Response();
        $redistributionsTab = array();

        foreach ($redistributions as $r) {
            array_push(
                    $redistributionsTab, array(
                'id' => $r->getId(),
                'fermeture' => $r->getFermeture()->getId(),
                'client_a_redistribue_id' => $r->getClientRedistribue()->getId(),
                'client_remplacant_id' => $r->getClientRemplace()->getId(),
                'commande_saisie' => $r->getCommandeSaisie(),
                'titre_id' => $r->getTitreADistribuer()->getId()
                    )
            );
        }

        $response->setContent(json_encode($redistributionsTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
