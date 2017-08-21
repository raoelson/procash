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
class BanqueController extends Controller {

    public function getBanquesAction() {
        $banques = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:Banque")->findByDateSuppression(null);
        $response = new Response();
        $banquesTab = array();

        foreach ($banques as $b) {
            array_push(
                    $banquesTab, array(
                'id' => $b->getId(),
                'codeInterne' => $b->getCodeInterne(),
                'libelle' => $b->getLibelle(),
                'refExterne' => $b->getRefExterne()
                    )
            );
        }
        $response->setContent(json_encode($banquesTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getTitresAction() {
        $titres = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:Produit")->findByDateSuppression(null);
        $response = new Response();
        $titresTab = array();

        foreach ($titres as $t) {
            array_push(
                    $titresTab, array(
                'id' => $t->getId(),
                'libelle' => $t->getLibelle()
                    )
            );
        }
        $response->setContent(json_encode($titresTab));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
