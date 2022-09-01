<?php

namespace App\Controller\admin;

use App\Entity\Etudiant;
use App\Entity\TypeDiplome;
use App\Repository\CandidatureRepository;
use App\Repository\EtudiantRepository;
use App\Repository\FluxRepository;
use App\Repository\FluxSortantRepository;
use App\Repository\TypeDiplomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="app_chart")
     */
    public function index(TypeDiplomeRepository $typeDiplomeRepository ,   CandidatureRepository $candidatureRepository ,  FluxRepository $fluxRepository , EtudiantRepository $etudiantRepository ,  FluxSortantRepository $fluxSortantRepository  ): Response
    {  
        
          $flux = $fluxRepository->findAll();

           $sortant = $fluxSortantRepository->findBy([
            'type' =>"sortant"
           ]);
           $resident = $fluxSortantRepository->findBy([
            'type' =>"resident"
           ]);
           $candida_bourse = $candidatureRepository->findBy([
            "bourse"=>"oui"
           ]);
           $candida_bourse_non = $candidatureRepository->findBy([
            "bourse"=>"non"
           ]);
           $ursus_interne = $candidatureRepository->findBy([
            "cursus"=>"interne"
           ]);
           $ursus_externe = $candidatureRepository->findBy([
            "cursus"=>"externe"
           ]);
           $ursus_2 = $candidatureRepository->findBy([
            "cursus"=>"deux"
           ]);

           $stage = $candidatureRepository->findBy([
            "stage"=>"oui"
           ]);
           $stage_non = $candidatureRepository->findBy([
            "stage"=>"non"
           ]);
           $type_etudiant = $candidatureRepository->findBy([
            "type"=>"etudiant"
           ]);
           $type_emp = $candidatureRepository->findBy([
            "type"=>"employe"
           ]);

           //cycle d'etude flux entrant 
           $cycle1= $fluxRepository->findBy([
            "cycle"=>"cycle 1"
           ]);
           $cycle2= $fluxRepository->findBy([
            "cycle"=>"cycle 2"
           ]);
           $cycle3= $fluxRepository->findBy([
            "cycle"=>"cycle 3"
           ]);
           
           $libelle = [];
           $count_diplome =[];
           $color = [];

           $diplome = $candidatureRepository->stat_diplome();
           foreach($diplome as $dp){
             $libelle[]= $dp['libelle'];
             $count_diplome[] =$dp['diplome_count'];
             $color[]= $dp["color"];
           }
            
            //gestion de flux 
            $sexe = $fluxRepository->stat_sexe();
            foreach($sexe as $sx ){
              $count[] =$sx["count_id"];
              $sexes[]=$sx["sexe"];
            }
            
            $flux_annee = $fluxRepository->stat_flux_anne();
            foreach( $flux_annee as $flux ){
              $count_flux_anne[] = $flux["ct"];
              $anne[] = $flux["anne"];
            }
            $fux_diplome = $fluxRepository->stat_diplome_flux();
            foreach( $fux_diplome as $flux ){
              $nom_diplome[]=  $flux['libelle'];
              $count_diplome[] = $flux['diplome_count'];
              $color_diplome[] = $flux['color'];
            }
            //gestion par pays 
            $flux_pays = $fluxRepository->stat_pays_flux();
            $categCount = [];
            foreach($flux_pays as $pays ){
              $nom_pays[]= $pays["pays"];
              $count_pays[] = $pays["ct"];
              
            }
           $count_resident = count($resident);
           $count_entant = count($flux);
           $count_sortant = count($sortant);
           $nom_etudiant_boursier = count(  $candida_bourse);
           $nom_etudiant_boursier_non = count($candida_bourse_non);
           $cursus_interne = count($ursus_interne);
           $cursus_externe = count( $ursus_externe);
           $cursus_2 = count(  $ursus_2);
           $stage = count($stage);
           $stage_non = count($stage_non);
           $type_etudiant  = count( $type_etudiant);
           $employe = count(  $type_emp );
         
           
         return $this->render('chart/index.html.twig', [
           'flux' =>   $count_entant ,
           'sortant'=>  $count_sortant  , 
           'resident'=>  $count_resident ,
           'bourse_oui'=>  $nom_etudiant_boursier  , 
           'boursier_non'=> $nom_etudiant_boursier_non , 
           'cursus_interne'=> $cursus_interne , 
           'cursus_externe'=>  $cursus_externe , 
           "cursus_interne_externe"=>$cursus_2 , 
           "stage"=>$stage , 
           "stage_non"=> $stage_non , 
           "etudiant"=> $type_etudiant , 
           "employe"=>  $employe , 
           "diplome"=>  json_encode( $libelle) , 
           "count_diplome" =>  json_encode($count_diplome) , 
           "color"=> json_encode($color), 
           "count_sexe"=> json_encode($count) , 
           "sexe_flux_entrant"=>json_encode($sexes) , 
           "flux_annee"=>json_encode($count_flux_anne) , 
           "annee_flux"=>json_encode($anne),
           "cycle1"=>json_encode(count($cycle1)),
           "cycle2"=>json_encode(count($cycle2)) , 
           "cycle3"=>json_encode(count($cycle3)) , 
           "nom_dip_flux"=>json_encode($nom_diplome), 
           "color_dip_flux"=>json_encode($color_diplome) , 
           "count_diplome_flux"=> json_encode( $count_diplome) , 
           "nom_pays"=> json_encode($nom_pays) , 
           'count_pays'=>json_encode($count_pays)
           
        ]);
    }
}
