<?php

namespace App\Controller;

use App\Entity\ParcoursUniversitaire;
use App\Form\ParcoursUniversitaireType;
use App\Entity\User;
use App\Repository\ParcoursUniversitaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
/**
 * @Route("/parcours/universitaire")
 */
class ParcoursUniversitaireController extends AbstractController
{
    

    /**
     * @Route("/new", name="parcours_universitaire_new", methods={"GET","POST"})
     */
    public function new(FileUploader $fileUploader , ParcoursUniversitaireRepository $parcoursUniversitaireRepository , Request $request): Response
    {
        $parcoursUniversitaire = new ParcoursUniversitaire();
        $parcoursUniversitaire->setUser($this->getUser());
        $repo =  $parcoursUniversitaireRepository->findOneBy(['typeCursus' => 'interne']);
        $form = $this->createForm(ParcoursUniversitaireType::class, $parcoursUniversitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('fichier')->getData();
            if ($brochureFile) 
            {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $parcoursUniversitaire->setFichier($brochureFileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($parcoursUniversitaire);
                $entityManager->flush();
            }
            $this->addFlash("success" , "informations  sont bien enregistrées avec success ");
           return $this->redirectToRoute('parcours_universitaire_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_universitaire/new.html.twig', [
            'parcours_universitaire' => $parcoursUniversitaire,
            'form' => $form,
            'parcours_universitaires' => $repo
        ]);
    }

    
    /**
     * @Route("/externe", name="parcours_universitaire_new_externe", methods={"GET","POST"})
     */
    public function new_externe(FileUploader $fileUploader , ParcoursUniversitaireRepository $parcoursUniversitaireRepository , Request $request): Response
    {
        $parcoursUniversitaire = new ParcoursUniversitaire();
        $parcoursUniversitaire->setUser($this->getUser());
        $form = $this->createForm(ParcoursUniversitaireType::class, $parcoursUniversitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('fichier')->getData();
            if ($brochureFile) 
            {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $parcoursUniversitaire->setFichier($brochureFileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($parcoursUniversitaire);
                $entityManager->flush();
            }
           return $this->redirectToRoute('parcours_universitaire_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_universitaire/cursus.html.twig', [
            'parcours_universitaire' => $parcoursUniversitaire,
            'form' => $form,
            'parcours_universitaires' => $parcoursUniversitaireRepository->findOneBy(array('typeCursus' => 'externe'), array('anneInscription' => 'ASC'))
            
        ]);
    }

    /**
     * @Route("/{id}", name="parcours_universitaire_show", methods={"GET"})
     */
    public function show(ParcoursUniversitaire $parcoursUniversitaire): Response
    {
        return $this->render('parcours_universitaire/show.html.twig', [
            'parcours_universitaire' => $parcoursUniversitaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parcours_universitaire_edit", methods={"GET","POST"})
     */
    public function edit(FileUploader $fileUploader , Request $request, ParcoursUniversitaire $parcoursUniversitaire): Response
    {
        $form = $this->createForm(ParcoursUniversitaireType::class, $parcoursUniversitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('fichier')->getData();
            if ($brochureFile) 
            {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $parcoursUniversitaire->setFichier($brochureFileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($parcoursUniversitaire);
                $entityManager->flush();
            }
           return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_universitaire/edit.html.twig', [
            'parcours_universitaire' => $parcoursUniversitaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="parcours_universitaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id ): Response
    {
        $parcoursUniversitaire = $this->getDoctrine()->getRepository(ParcoursUniversitaire::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($parcoursUniversitaire);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->render('admin/home_user.html.twig');
    }
}
