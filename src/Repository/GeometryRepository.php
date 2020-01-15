<?php

namespace App\Repository;

use App\Entity\Geometry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Geometry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Geometry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Geometry[]    findAll()
 * @method Geometry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeometryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Geometry::class);
    }

    // /**
    //  * @return Geometry[] Returns an array of Geometry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Geometry
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
