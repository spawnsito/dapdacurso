<?php
/**
 * User: Daniel Cruz
 * Date: 24/01/2015
 * Time: 20:23
 */

namespace Civieta\AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProvincesRepository extends EntityRepository
{
    public function findAll()
    {
        $dql = $this->createQueryBuilder('p')
            ->addSelect('a')
            ->join('p.autonomousCommunity', 'a');

        $dql = $dql->getQuery();

        return $dql->getResult();
    }
}