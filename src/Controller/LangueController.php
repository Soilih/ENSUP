<?php

namespace App\Controller;

use App\Entity\Langue;
use App\Form\LangueType;
use App\Repository\LangueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/langue")
 */
class LangueController extends AbstractController
{
    /**
     * @Route("/", name="langue_index", methods={"GET"})
     */
    public function index(LangueRepository $langueRepository): Response
    {
        return $this->render('langue/index.html.twig', [
            'langues' => $langueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="langue_new", methods={"GET","POST"})
     */
    public function new(Request $request ,  LangueRepository $langueRepository): Response
    {
        $langue = new Langue();
        //je recupere l'id user qui est connecte 
        $langue->setUser($this->getUser());
        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($langue);
            $entityManager->flush();
            $this->addFlash("success" , "informations sont bien enregistrées avec success ");
            return $this->redirectToRoute('langue_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('langue/new.html.twig', [
            'langue' => $langue,
            'form' => $form,
            'langues'=>$langueRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="langue_show", methods={"GET"})
     */
    public function show(Langue $langue): Response
    {
        return $this->render('langue/show.html.twig', [
            'langue' => $langue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="langue_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Langue $langue): Response
    {
        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('langue/edit.html.twig', [
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="langue_delete", methods={"POST"})
     */
    public function delete(Request $request, Langue $langue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$langue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($langue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
    }
}
