<?php

namespace Procash\AdministrationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReseauClientController extends Controller {

    /**
     * @Template()
     */
    public function indexAction() {
         $em = $this->getDoctrine()->getManager();
        $listeReseaux = $em->getRepository('ProcashAdministrationBundle:Reseau')->findBy(array('dateSuppression' => null));

        return array(
            'listeReseaux' => $listeReseaux,
        );
    }

}
