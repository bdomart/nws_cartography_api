<?php

namespace App\Repository;

use App\Entity\TypeGeometry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeGeometry|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeGeometry|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeGeometry[]    findAll()
 * @method TypeGeometry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeGeometryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeGeometry::class);
    }

    // /**
    //  * @return TypeGeometry[] Returns an array of TypeGeometry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeGeometry
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
