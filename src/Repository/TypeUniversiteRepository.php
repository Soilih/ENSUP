<?php

namespace App\Repository;

use App\Entity\TypeUniversite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeUniversite|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeUniversite|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeUniversite[]    findAll()
 * @method TypeUniversite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeUniversiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeUniversite::class);
    }

    // /**
    //  * @return TypeUniversite[] Returns an array of TypeUniversite objects
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
    public function findOneBySomeField($value): ?TypeUniversite
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
