<?php

namespace App\Repository;

use App\Entity\Flux;
use App\Entity\User;
use App\Entity\Etudiant;
use App\Entity\Niveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Flux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flux[]    findAll()
 * @method Flux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FluxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flux::class);
    } 
    /**
     * @return Flux[]
     * @return Etudiant[]
     * @return User[]
     */
    public function listeFluxEtudiant(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT   u.Nom as nom   , u.email as email ,  u.prenom  as prenom 
            , f.pays as pays , f.depart as dt  , f.diplome  as diplome , f.specialite as specialite
             , f.cycle as cycle  , f.dateArrive as dtarive , n.libelle as lib 
             FROM App\Entity\Flux f   , App\Entity\User u , App\Entity\Niveau n 
             where f.user = u.id  AND f.user = n.id
            "
             
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function stat_sexe(){
    $conn = $this->getEntityManager()->getConnection();
    $sql ="
    SELECT count(flux.id) as count_id , etudiant.sexe as sexe FROM flux , user , etudiant where flux.user_id = user.id AND etudiant.user_id = user.id GROUP by sexe " ; 
        $stmt = $conn->query( $sql);
        return $result = $stmt->fetchAllAssociative();
    }

    public function stat_flux_anne_arrive(){
        $conn = $this->getEntityManager()->getConnection();
        $sql ="SELECT flux.id as flux_id ,    COUNT(flux.id) as ct  , DATE_FORMAT(flux.date_arrive , '%Y' ) as anne
       
        FROM flux GROUP by anne 
        ORDER by date_arrive DESC ";
        $stmt = $conn->query( $sql);
         return $result = $stmt->fetchAllAssociative();
    }

    public function stat_diplome_flux(){
        $conn = $this->getEntityManager()->getConnection();
        $sql ="SELECT COUNT(flux.typediplome_id) as diplome_count , type_diplome.color as color ,  type_diplome.libelle as libelle FROM flux , type_diplome 
        where flux.typediplome_id = type_diplome.id 
        GROUP BY type_diplome.libelle  " ;
        $stmt = $conn->query( $sql);
        return $result = $stmt->fetchAll();
    }

    public function stat_pays_flux(){
        $conn = $this->getEntityManager()->getConnection();
        $sql ="SELECT  COUNT(flux.id)  as ct , flux.pays as pays 
         FROM flux  GROUP BY flux.pays " ;
        $stmt = $conn->query( $sql);
        return $result = $stmt->fetchAllAssociative();
    }
    
    

    // /**
    //  * @return Flux[] Returns an array of Flux objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Flux
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function Flux_etudiant()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
            SELECT * FROM  flux , user , niveau    where
             flux.niveau_actuel_id = niveau.id AND 
             flux.user_id = user.id  
            ";
        $stmt = $conn->query($sql);
        
         // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function NombreFlux()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT COUNT(flux.id) as compte FROM flux ";
        $stmt = $conn->query($sql);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

   

}
