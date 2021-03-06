<?php
/**
 * User: Daniel Cruz
 * Date: 12/01/2015
 * Time: 22:34
 */

namespace Civieta\AppBundle\Repository;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository
{
    public function findAll()
    {
        $dql = $this->createQueryBuilder('c')
            ->addSelect('a')
            ->leftJoin('c.address', 'a');

        $query = $dql->getQuery();

        return $query->getResult();
    }

    public function findCompleteCustomer($id)
    {
        $dql = $this->createQueryBuilder('c')
            ->addSelect('a', 'p')
            ->leftJoin('c.address', 'a')
            ->leftJoin('a.province', 'p')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id);

        $query = $dql->getQuery();

        return $query->getSingleResult();
    }

}