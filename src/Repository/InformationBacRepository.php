<?php

namespace App\Repository;

use App\Entity\InformationBac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InformationBac|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationBac|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationBac[]    findAll()
 * @method InformationBac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationBacRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationBac::class);
    }
    

    // /**
    //  * @return InformationBac[] Returns an array of InformationBac objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InformationBac
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
