<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Candidature;
use App\Form\CandidatureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/{id}/edit" , name="edit_candidature" , methods={"GET" , "POST"})
     */

     public function edit(Request $request , Candidature $candidature , EntityManagerInterface $entityManager ): Response {
         //instance de classe 
        $candidat = new Candidature();
        $candidat->setDateCreate(new \DateTime('now'));
        $form= $this->createForm(CandidatureType::class , $candidature);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('candidature', [], Response::HTTP_SEE_OTHER);
    
        }
        return $this->renderForm('candidature/edit.html.twig' , [
            'form'=>$form , 
             'candidature'=> $candidature
            ]);
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
            $this->addFlash("success" , "informations de bourses sont bien enregistrées avec success ");
            return $this->redirectToRoute('candidature', [], Response::HTTP_SEE_OTHER);
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
        return $this->render('candidature/index.html.twig' , [
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
     * @Route("/delete/{id}" , name="delete_candidature" )
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $candidature = $this->getDoctrine()->getRepository(Candidature::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($candidature);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->render('candidature/index.html.twig');
    }

   /**
     * @Route("/activer/{id}", name="activer")
     * @Method({"GET"})
     */
    public function activer(Candidature  $candidature)
    {
        $candidature->setStatus("1");
        $em = $this->getDoctrine()->getManager();
        $em->persist( $candidature);
        $em->flush();

        return new Response("true");
    }

   


    
}
