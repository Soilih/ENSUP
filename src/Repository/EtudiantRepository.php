<?php

namespace App\Repository;

use   App\Entity\Etudiant;
use   App\Entity\Langue;
use   App\Entity\User;
use   App\Entity\Experience;
use   App\Entity\ParcoursUniversitaire;
use   App\Entity\Responsable;
use   App\Entity\Flux;
use   App\Entity\Diplome;
use   App\Entity\Bourse;
use   App\Entity\FluxSortant;
use   App\Entity\Niveau;
use   App\Entity\Serie;
use   App\Entity\InformationBac;
use   Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use   Doctrine\Persistence\ManagerRegistry;
use   Doctrine\ORM\EntityManagerInterface;
/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
        parent::__construct($registry, Serie::class);
        parent::__construct($registry, Langue::class);
    }
    /**
     * @return Flux[]
     * @return Etudiant[]
     * @return User[]
     * @return Langue[]
     * @return Diplome[]
     * @return FluxSortant[]
     * @return Bourse[]
     * @return Experience[] 
     * @return Responsable[]
     * @return Diplome[]
     * @return ParcoursUniversitaire[]
     * 
     * @throws \Exception
     */
    public function InformationEtudiant(int $id): array
    {   
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT  candidature.id as idcandidat ,   user.id as id , candidature.reference as reference ,
        candidature.date_create as dtcreate , candidature.niveau_id as niveau , candidature.bourse as bourse , 
        niveau.libelle as libelle_niv , candidature.flux as flux , candidature.stage as stage ,
        candidature.status as statut , etudiant.sexe as sexe , candidature.cursus as cursus ,
        etudiant.etatcivile  as etat , etudiant.date_naissance as dtna , 
        etudiant.lieu_naissance  as lieu  , etudiant.adresse as adresse, 
        etudiant.ile as ile , user.nom  as nom , user.prenom as prenom , 
        etudiant.pays as pays , etudiant.telephone as tel  , user.email as email, 
        etudiant.tel_urgence as urgence , etudiant.cv as cv ,
        etudiant.type_identite as typeidentite , etudiant.pieceidentite as piece , 
        etudiant.num_carteidentite as num_ca , etudiant.nationalite as nationalite , 
        user.nin as nin , user.code as code , etudiant.date_delivrance as dtliv , etudiant.date_expiration as dtEx , 
        information_bac.ecole as ecole , serie.libelle as serie , 
        information_bac.mention as mention ,  information_bac.moyenne as moy , 
        user.numerocarte 	as nutable , user.session as session , 
        information_bac.session  as sess , information_bac.releve as rele , 
        information_bac.attestation as att
        FROM    user , candidature , niveau , etudiant , 
        information_bac , serie
        where user.id = candidature.user_id AND  
        candidature.niveau_id = niveau.id AND 
        user.id = etudiant.user_id AND 
        information_bac.serie_id = serie.id AND 
        information_bac.user_id = user.id AND
        user.id = ? ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));

         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    
    /**
     * @return Etudiant[]
     * @return User[]
     * @throws \Exception
     */

    public function listeEtudiant() 
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT  
            u.Nom as nom  , u.prenom as prenom ,
            u.Numerocarte as num_table , 
            u.Nin as nin , 
            u.email as email ,
            u.code as code , 
            u.id as id , 
            u.session as session  , 
            u.roles as roles , 
            u.isVerified  as isVerified
           FROM  App\Entity\User u  
          
        ");
           return  $query->getResult();
    }

    public function listResponsable($id):array 
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT   user.id as id , responsable.prenom as resp_nom , 
        responsable.nom  as nom , responsable.tel as tel , responsable.email as email ,
        responsable.proffession as prof , responsable.adresse as ad , 
        responsable.lieunaissance as lieu , responsable.pays as pays , 
        responsable.detail as dt 
        FROM  user  
        LEFT JOIN responsable  ON user.id = responsable.user_id
        WHERE user.id = ?
         ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));

         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    public function listLangue($id):array 
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT   user.id as id , langue.libelle as lib , 
        langue.niveau as niv ,  langue.detail as dt 
        FROM  user  
        LEFT JOIN langue  ON user.id = langue.user_id
        WHERE user.id = ?
         ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));

         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    public function listExperience ($id):array 
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT   user.id as id , experience.poste as poste , 
         experience.date_experience as dtex ,   experience.datefin as dtfin , 
         experience.entreprise as ent , experience.pays as pays , 
         experience.detail as dt   
        FROM  user , experience  
        WHERE  user.id = experience.user_id AND user.id = ? 
         
         ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));

         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    public function listDiplome ($id):array 
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT   user.id as id , diplome.libelle as lib ,
        diplome.id as dpid , 
        diplome.mention as mention , diplome.universite as universite , 
        type_diplome.libelle as type_diplome , diplome.pays as pays , 
        diplome.moyenne as moy , diplome.session as session  , 
        type_universite.libelle as lib_uni , diplome.fichier as fichier , 
        composant.libelle as compo , diplome.description  as dt 

        FROM  user     
        LEFT JOIN diplome  ON user.id = diplome.user_id
        LEFT JOIN type_diplome  ON type_diplome.id = diplome.typediplome_id 
        LEFT JOIN type_universite  ON type_universite.id = diplome.typeuniversite_id  
        LEFT JOIN composant  ON composant.id = diplome.composant_id  
        WHERE user.id = ? 
         ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));

         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    public function Flux_sortant($id , $type_flux = null ):array 
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT   user.id as id , flux_sortant.filiere as filiere , 
        niveau.libelle as lib_niveau , flux_sortant.universite as univ , 
        flux_sortant.date_depart as depart , type_universite.libelle as type_univ , 
        flux_sortant.ville as ville , flux_sortant.pays as pays , flux_sortant.cycle as cycle 
         , composant.libelle as lib_compo , flux_sortant.moyen as moyen , flux_sortant.motivation as motivation , 
         flux_sortant.typeuniversit as type_uni , flux_sortant.type as type 

        FROM  user     
        LEFT JOIN flux_sortant  ON user.id = flux_sortant.user_id
        LEFT JOIN type_universite  ON type_universite.id = flux_sortant.typeuniversite_id  
        LEFT JOIN composant  ON composant.id = flux_sortant.composant_id
        LEFT JOIN niveau ON niveau.id =   flux_sortant.niveau_id
        WHERE user.id = ? AND type='sortant'
         ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));

         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    public function Flux_entrant ($id , $type_flux = null ):array 
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT   user.id as id , flux.depart as depart , 
        flux.date_arrive  as dtArrive , flux.projet as projet , 
        flux.etude_poursuite as etude , flux.detail as detail , 
        flux.probleme as probleme , flux.suggestion as sug ,  
        flux.cycle as cycle , flux.pays as pays , 
        niveau.libelle as lib_niveau
        FROM  user     
        INNER JOIN flux  ON user.id = flux.user_id
        INNER JOIN niveau ON niveau.id = flux.niveau_actuel_id 
        WHERE user.id = ?
         ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));

         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    public function Cursus($id):array 
    {
        $conn = $this->getEntityManager()->getConnection();
         $sql = "SELECT   user.id as id , niveau.libelle as lib_niveau ,
         parcours_universitaire.anne_inscription  as anne ,  parcours_universitaire.filiere as filiere , 
         parcours_universitaire.mention as mention , parcours_universitaire.fichier as fichier , 
         parcours_universitaire.detail as detail ,parcours_universitaire.titre_univeriste as titre , 
         parcours_universitaire.moyenne as moy , type_universite.libelle as libelle  , 
         parcours_universitaire.pays as pays 
        FROM  user     
        INNER JOIN parcours_universitaire  ON user.id = parcours_universitaire.user_id
        INNER JOIN niveau ON niveau.id = parcours_universitaire.niveau_id 
        INNER JOIN type_universite ON parcours_universitaire.type_universite_id  = type_universite.id   

        WHERE user.id = ?
         ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));
         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
    }

    public function bourseEtude($id):array {
        $conn = $this->getEntityManager()->getConnection();
        $sql ="SELECT user.id as id  ,   bourse.nature as nat , 
        bourse.montant as mont , bourse.pays as pays_b , bourse.detail as bour_de
         FROM  user
        INNER JOIN bourse ON   bourse.user_id = user.id 
        WHERE user.id = ? ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute(array($id));
         // returns an array of arrays (i.e. a raw data set)
         return $resultSet->fetchAll();
        
    }  

    public function listBaccalaureat(): array {
        $conn = $this->getEntityManager()->getConnection();
        $sql ="SELECT user.id as id , user.nom as nom , 
        user.prenom as prenom , etudiant.date_naissance as dt , 
        candidature.niveau_id as niv , user.nin as nin , user.code as code , 
        user.numerocarte as num , information_bac.mention as mention , 
        information_bac.serie_id  as serie , information_bac.ecole as ecole , 
        user.session as session , serie.libelle as serie_libelle , 
        candidature.flux as flux 
        FROM  user 
        INNER JOIN  etudiant ON   etudiant.user_id = user.id
        INNER JOIN  candidature ON   candidature.user_id = user.id
        INNER JOIN  information_bac ON   information_bac.user_id = user.id 
        INNER JOIN  serie ON   information_bac.serie_id = serie.id   
        WHERE candidature.niveau_id = 1
         ";
        $stmt = $conn->query($sql);
        $resultSet = $stmt->fetchAll(); 
         // returns an array of arrays (i.e. a raw data set)
         return  $resultSet ;
    }

    public function listUniversitaire(): array {
        $conn = $this->getEntityManager()->getConnection();
        $sql ="SELECT user.id as id , user.nom as nom , 
        user.prenom as prenom , etudiant.date_naissance as dt , 
        candidature.niveau_id as niv , user.nin as nin , user.code as code , 
        user.numerocarte as num , information_bac.mention as mention , 
        information_bac.serie_id  as serie , information_bac.ecole as ecole , 
        user.session as session ,  candidature.flux as flux , niveau.libelle as lib_ni
       
        FROM  user 
        INNER JOIN  etudiant ON   etudiant.user_id = user.id
        INNER JOIN  candidature ON   candidature.user_id = user.id
        INNER JOIN  information_bac ON   information_bac.user_id = user.id 
        INNER JOIN  niveau  ON   candidature.niveau_id  = niveau.id
        WHERE candidature.niveau_id > 1 
         ";
        $stmt = $conn->query($sql);
        $resultSet = $stmt->fetchAll(); 
         // returns an array of arrays (i.e. a raw data set)
         return  $resultSet ;
    }

    


}



   
   

