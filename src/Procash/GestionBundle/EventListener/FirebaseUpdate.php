<?php

namespace Procash\GestionBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Procash\GestionBundle\Entity\Facturation;
use Procash\GestionBundle\Entity\ChiffreVente;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Doctrine\ORM\EntityManager;

class FirebaseUpdate {

    private $container;
    private $em;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function postPersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if ($this->container->hasParameter('default_url') && $this->container->hasParameter('default_token')) {
            $firebase = new \Firebase\FirebaseLib(
                    $this->container->getParameter('default_url'), $this->container->getParameter('default_token')
            );
        }
        if ($this->container->hasParameter("default_path")) {
            $path = $this->container->getParameter("default_path");
        } else {
            $path = "";
        }
        $entityManager = $args->getEntityManager();
        if ($entity instanceof Facturation) {
            if ($entity->getId()) {
                $ancientF = $entityManager->getRepository("ProcashGestionBundle:facturation")->find($entity->getIdParent());
                if ($ancientF) {
                    $firebase->delete($path . 'facturations/' . $ancientF->getId());
                }
                $bqFire = array(
                    "montantFacture" => $entity->getMontantFacture(),
                    "montantAvoir" => $entity->getMontantAvoir(),
                    "numeroFacture" => $entity->getNumeroFacture(),
                    "emailClient" => $entity->getEmailClient()
                );
                $firebase->set($path . 'facturations/' . $entity->getId(), $bqFire);
            }
        }
        if ($entity instanceof ChiffreVente){
            if ($entity->getId() && !$entity->getLoginSaisi()) {
                $ancientC = $entityManager->getRepository("ProcashGestionBundle:ChiffreVente")->find($entity->getIdParent());
                if ($ancientC) {
                    $firebase->delete($path . 'chiffreVentes/' . $ancientC->getId());
                }
                $bqFire = array(
                    "invendu" => $entity->getNombreInvenduSaisi()?$entity->getNombreInvenduSaisi():($entity->getNombreInvendu()?$entity->getNombreInvendu():0),
                    "regul" => $entity->getNombreRegulSaisi()?$entity->getNombreRegulSaisi():($entity->getNombreRegul()?$entity->getNombreRegul():0)
                );
                $firebase->set($path . 'chiffreVentes/' . $entity->getId(), $bqFire);
            }
        }
    }

}
