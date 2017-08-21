<?php

namespace Procash\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Procash\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class UtilisateurController extends Controller {

    public function getUserAction($username) {
        $user = $this->getDoctrine()->getManager()->getRepository("ProcashUserBundle:User")->findOneByUsername($username);
        $response = new Response();
        if ($user == null) {
            $response->setContent(json_encode(array()));
        } else {
            if ($user->getProfil()->getCode() != "col") {
                 throw new BadCredentialsException('Bad credential');
            } else {
                $response->setContent(json_encode(array(
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmailcanonical(),
                    'nom' => $user->getNom(),
                    'prenom' => $user->getPrenom(),
                    'reseau'=> array(
                        'id'=> $user->getReseau()->getId(),
                        'nom' => $user->getReseau()->getLibelle(),
                        'dateEdition' => date_format($user->getReseau()->getDateEdition(), "d/m/Y")
                    ),
                    'profil' => $user->getProfil()->getCode()
                )));
            }
        }
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
