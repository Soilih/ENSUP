<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Candidature;
use App\Form\CandidatureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiant;
use App\Entity\User;
use App\Entity\Langue;
use App\Entity\Experience;
use App\Entity\FluxSortant;
use App\Entity\Flux;
use App\Entity\Pays;
use App\Entity\ParcoursUniversitaire;
use App\Entity\ParcousColaire;
use App\Repository\CandidatureRepository;
use App\Repository\EtudiantRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FluxRepository;
use App\Repository\FluxSortantRepository;
use App\Repository\LangueRepository;
use App\Repository\ParcoursUniversitaireRepository;
use App\Repository\ParcousColaireRepository;
use App\Repository\ResponsableRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use   Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * @Route("/candidature")
 */

class CandidatureController extends AbstractController
{
    
    
    /**
     * @Route("/candidature/{id_candidature}", name="candidature_valider")
     */
    public function SommettreDossier(Request $request , EntityManagerInterface  $entityManager ,   CandidatureRepository $candidatureRepository , $id  ): Response
    {      $candidat = new Candidature();
           $id = $request->get('id_candidature');
           
         return $this->render('candidature/index.html.twig');
    }
   

    /**
     * @Route("/new"  , name="candidature" , methods={"GET","POST"})
    */
    public function createDossier( EntityManagerInterface $entityManager ,    Request $request): Response 
    {
        $candidat = new Candidature();
        $candidat->setUser($this->getUser());
        $candidat->setStatus('0');
        $candidat->setReference($this->codeDossier());
        $candidat->setDateCreate(new \DateTime('now'));
        $form= $this->createForm(CandidatureType::class , $candidat);
        $form->handleRequest($request);
        //j'envoie le formulaire 
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($candidat);
            $entityManager->flush();
            return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('candidature/index.html.twig' , [
        'form'=>$form
        ]);
    }

    /**
     * @Route("/listcandidature" , name="mon_dossier")
    */
    public function mon_dossier(CandidatureRepository $candidatureRepository , Request $request):Response
    {
        $candidat = $candidatureRepository->findAll();
        return $this->render('admin/home_user.html.twig' , [
            "candidatures"=> $candidat
        ]);


    }

    public function codeDossier(){
        $date = Date("y-m");
        $rd = rand(1,1000);
        $code = 'ESP'.$date .''.$rd;
        return $code;
    }

    /**
     * @Route("/valider_candidature" , name="decision")
    */

    public function decision_administrature():Response {
        


        
        return $this->render('admin/DetailEtudiantId.html.twig' , [
            "name"=>"salut koko"
        ]);

    }
    
}
