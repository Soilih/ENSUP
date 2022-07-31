<?php

namespace App\Controller\admin;

use App\Entity\Etudiant;
use App\Repository\CandidatureRepository;
use App\Repository\EtudiantRepository;
use App\Repository\FluxRepository;
use App\Repository\FluxSortantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="app_chart")
     */
    public function index(CandidatureRepository $candidatureRepository ,  FluxRepository $fluxRepository , EtudiantRepository $etudiantRepository ,  FluxSortantRepository $fluxSortantRepository  ): Response
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
           "employe"=>  $employe
           
        ]);
    }
}
