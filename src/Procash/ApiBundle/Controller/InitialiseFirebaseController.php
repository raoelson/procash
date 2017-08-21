<?php

namespace Procash\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class InitialiseFirebaseController extends Controller {

    /**
     * @Route("initialiser-firebase")
     * @Template()
     */
    public function InitialiseAction() {
        $container = $this->container;
        if ($container->hasParameter("default_path")) {
            $path = $container->getParameter("default_path");
        } else {
            $path = "";
        }
        $em = $this->getDoctrine()->getManager();
        if ($container->hasParameter('default_url') && $container->hasParameter('default_token')) {
            $firebase = new \Firebase\FirebaseLib(
                    $container->getParameter('default_url'), $container->getParameter('default_token')
            );
            $banques = $em->getRepository("ProcashAdministrationBundle:Banque")->findByDateSuppression(null);
            foreach ($banques as $bq) {
                $bqFire = array(
                    "code" => $bq->getCodeInterne(),
                    "libelle" => $bq->getLibelle(),
                    "refExterne" => $bq->getRefExterne()
                );
                if ($firebase->get($path . "banque/50") == 'null') {
                    $dateTime = new \DateTime();
                    $firebase->set($path . 'banque/' . $bq->getId(), $bqFire);
                } else {
                    $firebase->update($path . 'banque/' . $bq->getId(), $bqFire);
                }
            }
            
            $facturation = $em->getRepository("ProcashGestionBundle:facturation")->findBy(array('dateSuppression'=>null,'loginSaisi'=> null));
            foreach ($facturation as $f) {
                $bqFire = array(
                    "montantFacture" => $f->getMontantFacture(),
                    "montantAvoir" => $f->getMontantAvoir(),
                    "numeroFacture" => $f->getNumeroFacture(),
                    "emailClient" => $f->getEmailClient()
                );
                $firebase->update($path . 'facturations/' . $f->getId(), $bqFire);
            }
            $chiffreVentes = $em->getRepository("ProcashGestionBundle:ChiffreVente")->findBy(array('dateSuppression'=>null, 'loginSaisi'=> null));
            foreach ($chiffreVentes as $cv) {
                $bqFire = array(
                    "invendu" => $cv->getNombreInvenduSaisi()?$cv->getNombreInvenduSaisi():($cv->getNombreInvendu()?$cv->getNombreInvendu():0),
                    "regul" => $cv->getNombreRegulSaisi()?$cv->getNombreRegulSaisi():($cv->getNombreRegul()?$cv->getNombreRegul():0)
                );

                $firebase->update($path . 'chiffreVentes/' . $cv->getId(), $bqFire);
            }
        }
        return array(
        );
    }

}
