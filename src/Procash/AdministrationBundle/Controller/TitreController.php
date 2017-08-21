<?php

namespace Procash\AdministrationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Procash\AdministrationBundle\Form\TitreType;
use Procash\AdministrationBundle\Entity\Titre;

class TitreController extends Controller {

    /**
     * @Template()
     */
    public function listeAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $titre = new Titre();
        $form = $this->createForm(new TitreType(), $titre);

        $titres = $em->getRepository('ProcashAdministrationBundle:Titre')->findBy(array('dateSuppression' => null));
        return array(
            "listeTitre" => $titres,
            "form" => $form->createView(),
        );
    }

    /**
     * @Template()
     */
    public function ajouterAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $titre = new Titre();
        $form = $this->createForm(new TitreType(), $titre);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $titre->setDateCreation(new \DateTime());
                $em->persist($titre);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Titre ajouté avec succès.');
                return $this->redirect($this->generateUrl('procash_titre_liste'));
            }
        }
        $titres = $em->getRepository('ProcashAdministrationBundle:Titre')->findBy(array('dateSuppression' => null));
        return array(
            "listeTitre" => $titres,
            "form" => $form->createView(),
        );
    }

    /**
     * @Template()
     */
    public function modifierAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $titre = $em->getRepository('ProcashAdministrationBundle:Titre')->find($id);
        $form = $this->createForm(new TitreType(), $titre);
        $listeTitres = $em->getRepository('ProcashAdministrationBundle:Titre')->findBy(array('dateSuppression' => null));
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $titre->setDateModification(new \DateTime());
                $em->persist($titre);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Titre modifié avec succès.');
                return $this->redirect($this->generateUrl('procash_titre_liste'));
            }
        }

        return array(
            'form' => $form->createView(),
            'titre' => $titre,
            'listeTitre' => $listeTitres,
        );
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $titre = $em->getRepository('ProcashAdministrationBundle:Titre')->find($id);
        if (!$titre) {
            throw $this->createNotFoundException('Impossible de trouver l\'utilisateur.');
        }
        $titre->setDateSuppression(new \DateTime());
        $em->persist($titre);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', 'Titre supprimé avec succès.');
        return $this->redirect($this->generateUrl('procash_titre_liste'));
    }

}
