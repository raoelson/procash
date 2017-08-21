<?php

namespace Procash\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Procash\AdministrationBundle\Form\DelaiFermetureType;
use Procash\AdministrationBundle\Entity\DelaiFermeture;

class DelaiFermetureController extends Controller {

    public function indexAction(Request $req) {
        $utilisateur = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $delaiSeuilFermetures = $em->getRepository('ProcashAdministrationBundle:DelaiFermeture')->findBy(array('dateSuppression'=>null));
        if (count($delaiSeuilFermetures) == 0) {
            $delaiSeuilFermeture = new DelaiFermeture();
        } else {
            $delaiSeuilFermeture = $delaiSeuilFermetures[0];
        }
        $form = $this->createForm(new DelaiFermetureType(), $delaiSeuilFermeture);

        if ($req->isMethod('POST')) {
            $form->handleRequest($req);
            if ($delaiSeuilFermeture->getDateCreation()) {
                $delaiSeuilFermeture->setDateModification(new \DateTime());
            } else {
                $delaiSeuilFermeture->setDateCreation(new \DateTime());
            }
            $delaiSeuilFermeture->setUtilisateur($utilisateur);
            $em->persist($delaiSeuilFermeture);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Informations bien enregistrées.');
            return $this->redirect($this->generateUrl('procash_motif_fermeture_liste'));
        }

        return array(
            'form' => $form->createView()
        );
    }

}
