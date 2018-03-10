<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Order;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;

/**
 * OrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderRepository extends \Doctrine\ORM\EntityRepository
{
    private $em;

    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        $this->em = $em;

        parent::__construct($em, $class);
    }

    public function save(Order $order)
    {
        try {
            $this->em->persist($order);
            $this->em->flush();
        } catch (OptimisticLockException $e) {
        }
    }
}
