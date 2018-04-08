<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.04.18
 * Time: 09:24
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Photo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;

class PhotoRepository extends \Doctrine\ORM\EntityRepository
{
    private $em;

    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        $this->em = $em;

        parent::__construct($em, $class);
    }

    public function getCarPhotos($car)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.car = :car')
            ->setParameter('car', $car)
            ->getQuery();

        return $qb->execute();
    }

    public function remove(Photo $photo)
    {
        $this->em->remove($photo);
        $this->em->flush();
    }
}