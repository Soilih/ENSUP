<?php

namespace App\Repository;

use App\Entity\FluxSortant;
use App\Entity\User;
use App\Entity\Etudiant;
use App\Entity\Niveau;
use App\Entity\TypeUniversite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FluxSortant|null find($id, $lockMode = null, $lockVersion = null)
 * @method FluxSortant|null findOneBy(array $criteria, array $orderBy = null)
 * @method FluxSortant[]    findAll()
 * @method FluxSortant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FluxSortantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FluxSortant::class);
    }

    // /**
    //  * @return FluxSortant[] Returns an array of FluxSortant objects
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
    public function findOneBySomeField($value): ?FluxSortant
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return FluxSortant[]
     * @return Etudiant[]
     * @return User[]
     * @return Niveau[]
     */
    public function listeFluxSortantEtudiant(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT    f.dateDepart , u.id , f.filiere , f.id , u.Nom as nom , n.libelle 
             libelle , f.pays as pays , f.universite as universite , f.cycle as cycle
             ,  u.prenom as prenom , f.type as type ,  f.ville as ville , 
             f.typeuniversit as typeuniversit  
             FROM App\Entity\FluxSortant f , App\Entity\User u , App\Entity\Niveau n  
             where   f.user = u.id AND  f.niveau = n.id  AND f.type='sortant'  "
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function listeResidentEtudiant(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT    f.dateDepart , u.id , f.filiere , f.id , u.Nom as nom , n.libelle 
             as libelle , f.pays as pays , f.universite as universite , f.cycle as cycle
             ,  u.prenom as prenom , f.type as type , f.typeuniversit  as typ ,
             t.libelle as lib_type
            
             FROM App\Entity\FluxSortant f , App\Entity\User u , App\Entity\Niveau n , App\Entity\TypeUniversite t
             where  f.typeuniversite = t.id AND  f.user = u.id AND  f.niveau = n.id  AND f.type='resident'  "
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function NombreFlux_sortant()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT COUNT(flux_sortant.id) as compte ,flux_sortant.type as type   FROM flux_sortant 
         WHERE flux_sortant.type='sortant'
         ";
        $stmt = $conn->query($sql);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function NombreFlux_resident()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT COUNT(flux_sortant.id) as compte ,flux_sortant.type as type   FROM flux_sortant 
         WHERE flux_sortant.type='resident'
         ";
        $stmt = $conn->query($sql);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }



   
    
}
