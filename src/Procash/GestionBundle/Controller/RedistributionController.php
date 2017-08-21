<?php

namespace Procash\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RedistributionController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $redistributions = $em->getRepository('ProcashGestionBundle:Redistribution')->findAll();        
        return $this->render('ProcashGestionBundle:Redistribution:index.html.twig', 
               array('redistributions' => $redistributions));
    }

}
