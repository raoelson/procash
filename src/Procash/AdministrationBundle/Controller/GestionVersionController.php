<?php

namespace Procash\AdministrationBundle\Controller;

use Procash\AdministrationBundle\Entity\GestionVersion;
use Procash\AdministrationBundle\Form\GestionVersionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GestionVersionController extends Controller {

    /**
     * 
     * @Template()
     * 
     */
    public function indexAction(Request $req) {
        $em = $this->getDoctrine()->getEntityManager();
        $version = $em->getRepository('ProcashAdministrationBundle:GestionVersion')->findBy(array(), array('dateCreation' => 'desc'));
        $gest = new GestionVersion();
        if (count($version) > 0) {
            $versionActuelleActif = $em->getRepository('ProcashAdministrationBundle:GestionVersion')->findOneBy(array("actif"=>true));
            $ancienVersion = $versionActuelleActif->getVersion();
        } else {         
            $ancienVersion = "aucune";
        }

        $form = $this->createForm(new GestionVersionType(), $gest);
        if ($req->isMethod('POST')) {
            $form->handleRequest($req);
            if ($form->isValid()) {
                $versionActuelleActif = $em->getRepository('ProcashAdministrationBundle:GestionVersion')->findOneBy(array("actif"=>true));
                if($versionActuelleActif !== null){
                    $versionActuelleActif->setActif(false);
                    $versionActuelleActif->setDateSuppression(new \DateTime());
                    $em->persist($versionActuelleActif);
                    $em->flush();
                }  
                $oldVersion = $req->request->get('ancienVersion');
                    if ($oldVersion == 'aucune') {
                        $majeur = 0;
                        $mineur = 0;
                        $revision = 0;
                    } else {
                        $numVersion = explode('-', $oldVersion);
                        $majeur = intval($numVersion[0]);
                        $mineur = intval($numVersion[1]);
                        $revision = intval($numVersion[2]);
                    }
                    switch ($gest->getVersion()) {
                        case 0 :
                            $majeur++;
                            break;
                        case 1 :
                            $mineur++;
                            break;
                        case 2 :
                            $revision++;
                            break;
                    }
                    $nomApk = $majeur . '-' . $mineur . '-' . $revision;
                    $gest->uploadProfilePicture($nomApk);
                    $gest->setDateCreation(new \DateTime());
                    $gest->setActif(true);
                    $em->persist($gest);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('info', 'Ajout d\'une nouvelle version avec succès');
              
                return $this->redirect($this->generateUrl('procash_gestion_version_liste'));
            }
        }
        return array('form' => $form->createView(), 'versions' => $version, 'ancienVersion' => $ancienVersion);
    }

}
