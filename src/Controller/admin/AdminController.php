<?php

namespace App\Controller\admin;

use App\Entity\Etudiant;
use App\Entity\User;
use App\Entity\Langue;
use App\Entity\Experience;
use App\Entity\Bourse;
use App\Entity\FluxSortant;
use App\Entity\Flux;
use App\Entity\InformationBac;
use App\Entity\ParcoursUniversitaire;
use App\Repository\EtudiantRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FluxRepository;
use App\Repository\BourseRepository;
use App\Repository\DiplomeRepository;
use App\Repository\FluxSortantRepository;
use App\Repository\InformationBacRepository;
use App\Repository\LangueRepository;
use App\Form\EtudiantType;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;
use App\Repository\DocumentRepository;
use App\Repository\ParcoursUniversitaireRepository;
use App\Repository\ResponsableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session; 


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class AdminController extends AbstractController 
{
    public function __construct(EtudiantRepository $repo){
        $this->repo = $repo ;
    }

     /**
     * cette controller permet de creer le profile utilisateur
     * @Route("/" , name="index")
     */

    public function index(): Response
    {
        return $this->render("admin/index.html.twig");
    }
    
     /**
     * cette controller permet de creer le profile utilisateur
     * @Route("/profile" , name="profile")
     */

    public function profile(): Response
    {
        return $this->render("admin/profile.html.twig");
    }

    //liste de tous les etudiants 
    /**
     * @route( "/admin" ,  name="listetudiant")
     *
     */

    public function  listeEtudiant(EtudiantRepository $etudiantRepository ): Response {
       
        return $this->render("admin/listeEtudiant.html.twig" , [
            'nos_etudiant'=> $etudiantRepository->listeEtudiant()
        ]
         );
    }

     //flux entrant  
     /**
     * @route( "/etudiantsdetail/" ,  name="listetudiantdetail")
     */

    public function  listeEtudiantDetail(FluxRepository $fluxRepository , FluxSortantRepository $fluxSortantRepository ): Response {
        return $this->render("admin/listefluxEntrant.twig" , [
            'nos_etudiant'=>$fluxRepository->Flux_etudiant() , 
            "count"=>$fluxRepository->NombreFlux(),
            "compte_flux_sortant"=> $fluxSortantRepository->NombreFlux_sortant(),
            "compte_flux_resident"=> $fluxSortantRepository->NombreFlux_resident()
        ]
        );
    }
      
      public function  stat(FluxRepository $fluxRepository , FluxSortantRepository $fluxSortantRepository ): Response {
        return $this->render("base.html.twig" , [
            "count"=>$fluxRepository->NombreFlux(),
            "compte_flux_sortant"=> $fluxSortantRepository->NombreFlux_sortant(),
            "compte_flux_resident"=> $fluxSortantRepository->NombreFlux_resident()
        ]
        );
    }


    //flux sortant 
    /**
     * @route( "/etudiantfluxsortant/" ,  name="fluxStantEtudiant")
     */

    public function  listeEtudiantFluxSortant(FluxSortantRepository  $fluxSortantRepository ): Response {
        return $this->render("admin/listeFluxSortant.html.twig" , [
            'nos_etudiant'=>$fluxSortantRepository->listeFluxSortantEtudiant()
        ]
         );
    }
     
    //flux resident 

    /**
     * @route( "/etudiantfluxresident/" ,  name="fluxresident")
     *
    */

    public function  listeEtudiantresident(FluxSortantRepository  $fluxSortantRepository ): Response {
        return $this->render("admin/listeFluxresident.html.twig" , [
            'nos_etudiant'=>$fluxSortantRepository->listeResidentEtudiant()
        ]);
    }
    //detail etudiant 
    /**
     * @route( "/etudiantsss/{id}" ,  name="listetudiantDetailEtudiant")
     * @param int $id 
    */
    public function  listeEtudiantDetails( EtudiantRepository $etudiantRepository ,  $id ): Response {
         $repo=$etudiantRepository->InformationEtudiant($id);
         $reporespo = $etudiantRepository->listResponsable($id);
         $langue = $etudiantRepository->listLangue($id);
         $experience = $etudiantRepository->listExperience($id);
         $diplome = $etudiantRepository->listDiplome($id);
         $flux_sortant = $etudiantRepository-> Flux_sortant($id);
         $flux_entrant = $etudiantRepository->Flux_entrant($id);
         $cursus = $etudiantRepository->Cursus($id);
         $bourse = $etudiantRepository->bourseEtude($id);
        return $this->render("admin/DetailEtudiantId.html.twig" , [
            "nos_etudiantt"=> $repo ,
            "reponsable"=>$reporespo , 
            "langue"=> $langue , 
            "experiences"=>$experience , 
            "diplomes"=> $diplome , 
            "flux_sortant"=> $flux_sortant , 
            "flux"=>$flux_entrant , 
            "cursus"=>  $cursus , 
            "bourses"=> $bourse , 
           
         ]);
    }


    //ici je recupere je recupere la liste des responsable 
     /**
     * @route( "/responsables/" ,  name="listeResponsable")
     *
     */
    public function  listeResponsable(ResponsableRepository $responsableRepository ): Response {
        return $this->render("admin/Responsable.html.twig" , [
            'nos_etudiant'=>$responsableRepository->listeDesResponsable()
        ]
         );
    }

    /**
     * @Route("/secure", name="secure_area")
     *
     * @throws \Exception
     */
    public function indexAction():Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('listetudiant');
        }else{
            return $this->redirectToRoute('candidature');
        }
       throw new \Exception(AccessDeniedException::class);
    }

     /**
     * @Route("/users" , name="home_accueil")
     */
    public function Accueil_user(
        EtudiantRepository $etudiantRepository,
        ResponsableRepository $responsableRepository,
        ParcoursUniversitaireRepository $parcoursUniversitaire,
        ExperienceRepository $experienceRepository,
        LangueRepository $langueRepository, bourseRepository $bourseRepository ,
        FluxRepository $fluxRepository,
        FluxSortantRepository $fluxSortantRepository , 
        InformationBacRepository $informationBac , 
        DiplomeRepository $diplomeRepository , 
        DocumentRepository $documentRepository , 
        CandidatureRepository $candidatureRepository
     ):Response {
        return $this->render('admin/home_user.html.twig', [
                'etudiants'    =>   $etudiantRepository->findAll(),
                "responsables" =>$responsableRepository->findAll() ,
                "parcours_universitaires" => $parcoursUniversitaire->findAll(),
                "bourses"=>$bourseRepository->findAll(),
                "experiences"  => $experienceRepository->findAll(),
                'langues'     => $langueRepository->findAll() ,
                'fluxes'  => $fluxRepository->findAll() ,
                "fluxSortants"=> $fluxSortantRepository->findAll() , 
                "informationBacs" => $informationBac->findAll(),
                "diplomes"=> $diplomeRepository->findAll() , 
                "documents"=>$documentRepository->findAll() , 
                "candidatures"=>$candidatureRepository->findAll() 
        ]);
    }

    /**
     *@Route("/universitaire" , name="niveau_universitaire")
    */
    public function listUniversitaire(EtudiantRepository  $etudiantRepository):Response{
        $etudiant = $etudiantRepository->listUniversitaire();
      return $this->render("admin/universitaire.html.twig" , [
        "etudiantuni"=> $etudiant
      ]);
    }

     /**
     *@Route("/baccalaureat" , name="niveau_bac")
    */
    public function listBaccalaureat(EtudiantRepository  $etudiantRepository ):Response{
        $etudiant = $etudiantRepository->listBaccalaureat();
       return $this->render("admin/niveau.html.twig" , [
            "etudiants"=> $etudiant
        ]);
    }
    
    



}
    
   


