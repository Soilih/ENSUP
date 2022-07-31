<?php

namespace App\Repository;

use App\Entity\Responsable;
use App\Entity\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use   Doctrine\ORM\EntityManagerInterface;
/**
 * @method Responsable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Responsable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Responsable[]    findAll()
 * @method Responsable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Responsable::class);
    }

    // /**
    //  * @return Responsable[] Returns an array of Responsable objects
    //  */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Responsable
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
   
  
     
     * @return User[]
     * @return Responsable[]
     */
    public function listeDesResponsable(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
                           
            "SELECT  r.nom as n ,  r.prenom as pr , r.tel as t  , r.adresse as ad , u.Nom as nommm  , u.prenom as p
             FROM App\Entity\Responsable r   , App\Entity\User u 
             where r.user = u.id  
              "
             
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    
}
