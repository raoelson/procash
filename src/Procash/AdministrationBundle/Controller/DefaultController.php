<?php

namespace Procash\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProcashAdministrationBundle:Default:index.html.twig');
    }
    public function erreurAction()
    {
        return $this->render('ProcashAdministrationBundle:Default:erreur.html.twig');
    }
}
