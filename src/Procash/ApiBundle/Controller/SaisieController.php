<?php

namespace Procash\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Procash\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Procash\AdministrationBundle\Entity\Reseau;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of SaisieController
 *
 * @author Prince BABAY
 */
class SaisieController extends Controller {

    public function getSaisiesAction() {
        ini_set("memory_limit",-1);
        $saisies = $this->getDoctrine()->getManager()->getRepository("ProcashGestionBundle:ChiffreVente")->findBy(array('loginSaisi'=>null, 'dateSuppression'=>null));
        $response = new Response();
        $saisiesTab = array();

        foreach ($saisies as $saisie) {
            if ($saisie->getDateHeureSaisi()) {
                $editable = true;
            } else {
                $editable = true;
            }
            array_push(
                    $saisiesTab, array(
                'id' => $saisie->getId(),
                'clientId' => $saisie->getClient()->getId(),
                'produitId' => $saisie->getProduit()->getId(),
                'reseauId' => $saisie->getReseau()->getId(),
                'nbCommande' => ($saisie->getNombreNumCommande()!=null ? $saisie->getNombreNumCommande() : 0),
                'nbInvendu' => ($saisie->getNombreInvendu()!=null ? $saisie->getNombreInvendu() : 0),
                'nbRegul' => ($saisie->getNombreRegul()!=null ? $saisie->getNombreRegul() : 0),
                'date' => date_format($saisie->getDate(), "Y-m-d"),
                'nbVendu' => $saisie->getNombreVendu(),
                'editable' => $editable
                    )
            );
        }
        $response->setContent(json_encode($saisiesTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getSaisieAction(Request $request) {
        $data = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $data = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }

        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository("ProcashAdministrationBundle:Client")->find($data["client"]);
        $produit = $em->getRepository("ProcashAdministrationBundle:Produit")->find($data["titre"]);
        $utilisateur = $em->getRepository("ProcashUserBundle:User")->find($data["utilisateur"]);
        if (isset($data["dateEdition"])) {
//            $sasies = $em->getRepository("ProcashGestionBundle:ChiffreVente")->findBy(array(
//                'client' => $client,
//                'produit' => $produit,
//                'date' => date_create($data["dateEdition"])
//            ));
//            $sasies = $em->getRepository("ProcashGestionBundle:ChiffreVente")->getListeSaisie($client,$produit);
            $sasies = $em->getRepository("ProcashGestionBundle:ChiffreVente")->findBy(array(
                'client' => $client,
                'produit' => $produit,
            ));
        } else {
            $sasies = $em->getRepository("ProcashGestionBundle:ChiffreVente")->findBy(array(
                'client' => $client,
                'produit' => $produit
            ));
        }

        $saisieJson = array();
        $result = array();
        array_push($result, array("count" => sizeOf($sasies)));
        foreach ($sasies as $s) {
            if ($s->getDateHeureSaisi()) {
                $editable = false;
            } else {
                $editable = true;
            }
            array_push(
                    $saisieJson, array(
                'id' => $s->getId(),
                'date' => date_format($s->getDate(), 'Y-m-d'),
                'commande' => $s->getNombreNumCommande(),
                'regu' => $s->getNombreRegulSaisi(),
                'vendu' => $s->getNombreVendu(),
                'invendu' => $s->getNombreInvendu(),
                'editable' => $editable
                    )
            );
        }

        array_push($result, array("data" => $saisieJson));

        $response = new Response();
        $response->setContent(json_encode(array("count" => sizeOf($saisieJson), "data" => $saisieJson)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getSaisieUserAction(Request $request) {
        $data = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $data = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        $em = $this->getDoctrine()->getManager();
        $saisies = $em->getRepository("ProcashGestionBundle:Saisie")->findByUtilisateur($data["user_id"]);
        $count = 0;
        $saisieJson = array();
        foreach ($saisies as $saisie) {
            $detaillSaisie = $em->getRepository("ProcashGestionBundle:DetailSaisie")->findBySaisie($saisie);
            $count = $count + sizeOf($detaillSaisie);
            foreach ($detaillSaisie as $s) {
                if ($s->getDate() < new \DateTime()) {
                    $editable = false;
                } else {
                    $editable = true;
                    array_push(
                            $saisieJson, array(
                        'id' => $s->getId(),
                        'date' => date_format($s->getDate(), 'Y-m-d'),
                        'commande' => $s->getQteCommande(),
                        'regu' => $s->getRegularisation(),
                        'vendu' => $s->getQteVendu(),
                        'invendu' => $s->getQteInvendu(),
                        'editable' => $editable,
                        'user_id' => $s->getSaisie()->getUtilisateur()->getId(),
                        'client_id' => $s->getSaisie()->getClient()->getId(),
                        'titre_id' => $s->getSaisie()->getTitre()->getId()
                            )
                    );
                }
            }
        }

        $response = new Response();
        $response->setContent(json_encode(array("count" => $count, "data" => $saisieJson)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setSaisieAction(Request $request) {
        $data = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $data = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        $em = $this->getDoctrine()->getManager();
        foreach ($data as $s) {
            $saisie = $em->getRepository("ProcashGestionBundle:ChiffreVente")->find($s["id"]);
            if (is_object($saisie)) {
                $saisie->setNombreRegulSaisi($s["regu"]);
                $saisie->setNombreVendu($s["vendu"]);
                $saisie->setNombreInvenduSaisi($s["invendu"]);
                $saisie->setDateHeureSaisi(new \Datetime());
                if (isset($s["appVersion"])) {
                    $saisie->setAppVersion($s["appVersion"]);
                }
                if (isset($s["adresseMac"])) {
                    $saisie->setMac($s["adresseMac"]);
                }
                if (isset($s["descript"])) {
                    $saisie->setDescriptionSync($s["descript"]);
                }
                $saisie->setLoginSaisi($em->getRepository("ProcashUserBundle:User")->find($s["user_id"]));
                $em->persist($saisie);
                $em->flush();
            }
        }
        $response = new Response();
        $response->setContent(json_encode(array("status" => 200, "etat" => "success")));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getEncaissementClientAction(Request $request) {
        $data = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $data = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository("ProcashAdministrationBundle:Client")->find($data["client"]);
        $encaissements = $em->getRepository("ProcashGestionBundle:Encaissement")->findBy(
                array(
                    "client" => $client
                )
        );

        $detailleEncaissements = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($encaissements as $enc) {
            $dEnc = $em->getRepository("ProcashGestionBundle:DetailEncaissement")->findByEncaissement($enc);
            foreach ($dEnc as $d) {
                $detailleEncaissements->add($d);
            }
        }
        $encaissementsJson = array();
        $result = array();
        array_push($result, array("count" => sizeOf($detailleEncaissements)));
        foreach ($detailleEncaissements as $e) {
            if ($e->getDate() < new \DateTime()) {
                $editable = false;
            } else {
                $editable = true;
            }
            array_push(
                    $encaissementsJson, array(
                'id' => $e->getId(),
                'date' => date_format($e->getDate(), 'Y-m-d'),
                'montant' => $e->getMontantFacture(),
                'montantdu' => $e->getMontantDu(),
                'montantpaye' => $e->getMontantPaye(),
                'editable' => $editable
                    )
            );
        }

        array_push($result, array("data" => $encaissementsJson));

        $response = new Response();
        $response->setContent(json_encode(array("count" => sizeOf($detailleEncaissements), "data" => $encaissementsJson)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setEncaissementClientAction(Request $request) {
        $data = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $data = json_decode($content, true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        $em = $this->getDoctrine()->getManager();

        $response = new Response();
        $response->setContent(json_encode(array("status" => 200, "etat" => "success")));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
