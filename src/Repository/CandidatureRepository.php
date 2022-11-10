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
    
    public function status_candidature($id){
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->update('App\Entity\Candidature', 'c')
                ->set('c.status', '1')
                ->where('c.id = :id')
                ->setParameter('id', $id )
                ->getQuery();
        $result = $query->execute();

        return $result;
    }



    public function stat_diplome(){
        $conn = $this->getEntityManager()->getConnection();
        $sql ="SELECT COUNT(candidature.id) as diplome_count , type_diplome.color as color , type_diplome.libelle as libelle
         FROM candidature , type_diplome where
          candidature.typediplome_id = type_diplome.id GROUP BY type_diplome.libelle , type_diplome.id " ;
        $stmt = $conn->query( $sql);
        return $result = $stmt->fetchAllAssociative();
    }
}
