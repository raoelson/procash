<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TypePaiementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypePaiementRepository extends EntityRepository
{
    
    public function getTypesPaiements() {
        $qB = $this->createQueryBuilder('tp');
        $qB->where($qB->expr()->isNull('tp.dateSuppression'));
        
        $qry = $qB->getQuery();
        
        return $qry->getResult();
    }
    
}