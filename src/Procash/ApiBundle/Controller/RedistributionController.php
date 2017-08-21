<?php

namespace Procash\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Procash\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Procash\AdministrationBundle\Entity\Reseau;

class RedistributionController extends Controller {

    public function getReseauxUserAction($id) {
        $user = $this->getDoctrine()->getManager()->getRepository("ProcashUserBundle:User")->find($id);
        $reseaux = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:Reseau")->findByUtilisateur($user);
        $response = new Response();
        $listeClients = array();
        if (sizeOf($reseaux) == 0) {
            array_push(
                    $listeClients, array(
                'id' => '',
                'nom' => 'Pas de reseau',
                'dateEdition' => '',
                'user_id' => ''
                    )
            );
        } else {
            foreach ($reseaux as $reseau) {
                array_push(
                        $listeClients, array(
                    'id' => $reseau->getId(),
                    'nom' => $reseau->getLibelle(),
                    'dateEdition' => date_format($reseau->getDateEdition(), "d/m/Y"),
                    'user_id' => $reseau->getUtilisateur()->getId()
                        )
                );
            }
        }
        $response->setContent(json_encode($listeClients));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getClientsReseauAction(Reseau $reseau) {
        $clients = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:Client")->findByReseau($reseau);
        $response = new Response();
        $listeClients = array();
        if (sizeOf($clients) != 0) {
            foreach ($clients as $client) {
                array_push(
                        $listeClients, array(
                    'id' => $client->getId(),
                    'libelle' => $client->getNom(),
                    'adresse' => $client->getAdresse(),
                    'reseau_id' => $client->getReseau()->getId(),
                    'email' => $client->getEmail(),
                            'codePostale' => $client->getCodePostale(),
                            'ville' => $client->getVille()
                        )
                );
            }
        }
        $response->setContent(json_encode($listeClients));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getClientsUserAction(User $user) {
        $reseaux = $user->getReseaux();
        $response = new Response();
        $listeClients = array();

        foreach ($reseaux as $r) {
            $clients = $r->getClients();
            foreach ($clients as $client) {
                array_push(
                        $listeClients, array(
                    'id' => $client->getId(),
                    'libelle' => $client->getNom(),
                    'adresse' => $client->getAdresse(),
                    'reseau_id' => $client->getReseau()->getId(),
                    'user_id' => $user->getId(),
                    'email' => $client->getEmail()
                        )
                );
            }
        }
        $response->setContent(json_encode($listeClients));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getReseauxAction() {
        $reseaux = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:Reseau")->findAll();
        $response = new Response();
        $reseauxTab = array();

        foreach ($reseaux as $reseau) {
            array_push(
                    $reseauxTab, array(
                'id' => $reseau->getId(),
                'nom' => $reseau->getLibelle(),
                'dateEdition' => date_format($reseau->getDateEdition(), "d/m/Y"),
                    )
            );
        }
        $response->setContent(json_encode($reseauxTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getClientsAction() {
        $clients = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:Client")->findAll();
        $response = new Response();
        $clientsTab = array();

        foreach ($clients as $client) {
            array_push(
                    $clientsTab, array(
                'id' => $client->getId(),
                'libelle' => $client->getNom(),
                'adresse' => $client->getAdresse(),
                'reseau_id' => $client->getReseau()->getId(),
                'adresse' => $client->getAdresse(),
                'prenom' => $client->getPrenom(),
                'nom' => $client->getNom(),
                'civite' => $client->getCivilite(),
                'raisonSociale' => $client->getRaisonSociale(),
                'complementAdresse' => $client->getComplementAdresse(),
                'codePostale' => $client->getCodePostale(),
                'ville' => $client->getVille(),
                'email' => $client->getEmail(),
                'telephone' => $client->getTelephone(),
                'fax' => $client->getFax(),
                'portable' => $client->getPortable()
                    )
            );
        }
        $response->setContent(json_encode($clientsTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
