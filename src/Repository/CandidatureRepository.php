<?php

namespace App\Repository;

use App\Entity\Candidature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Candidature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidature[]    findAll()
 * @method Candidature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidature::class);
    }
    
    public function decision_admin($status , $com , $iduser , $idcan) {
        $conn = $this->getConnection();
        $sql = "UPADTE candidature SET status = ? , commentaire = ? 
        date_create = NOW() , user_id = ? 
        WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($status,$com ,$iduser,$idcan));
        return $resultSet;
    }

    // public function soumettre_candidature( $iduser , $idcan) {
    //     $em = $this->getDoctrine()->getManager();     
    //     $query = $em->getRepository(Candidature::class)->createQueryBuilder('')
    //                 ->update(Candidature::class, 'c')
        
    //                 ->set('c.status', '1')
    //                 ->set('c.user_id ', ':iduser')
                  
    //                 ->setParameter('key', $project->key)
    //                 ->setParameter('leader', $project->leader)
        
    //                 ->where('c.id = :id')
    //                 ->setParameter('id', $project->id)
    //                 ->getQuery();
        
    //     $result = $query->execute()
    // }



    // /**
    //  * @return Candidature[] Returns an array of Candidature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Candidature
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
