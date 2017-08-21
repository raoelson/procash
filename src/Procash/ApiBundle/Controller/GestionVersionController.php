<?php

namespace Procash\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GestionVersionController extends Controller {

    public function getVersionApkAction() {
        $versions = $this->getDoctrine()->getManager()->getRepository("ProcashAdministrationBundle:GestionVersion")->getGestionVersionActif();
        $response = new Response();
        $vers = array();
        if (count($versions) > 0) {
            foreach ($versions as $version) {
                array_push(
                        $vers, array(
                    'id' => $version->getId(),
                    'version' => $version->getVersion(),
                ));
            }
        }
        $response->setContent(json_encode($vers));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
