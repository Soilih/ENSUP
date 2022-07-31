<?php

namespace App\Controller\admin;

use App\Entity\Composant;
use App\Form\ComposantType;
use App\Repository\ComposantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/composant")
 */
class ComposantController extends AbstractController
{
    /**
     * @Route("/", name="composant_index", methods={"GET"})
     */
    public function index(ComposantRepository $composantRepository): Response
    {
        return $this->render('composant/index.html.twig', [
            'composants' => $composantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="composant_new", methods={"GET","POST"})
     */
    public function new(Request $request , ComposantRepository $composantRepository): Response
    {
        $composant = new Composant();
        $form = $this->createForm(ComposantType::class, $composant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($composant);
            $entityManager->flush();

            return $this->redirectToRoute('composant_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('composant/new.html.twig', [
            'composant' => $composant,
            'form' => $form,
             'composants'=>  $composantRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="composant_show", methods={"GET"})
     */
    public function show(Composant $composant): Response
    {
        return $this->render('composant/show.html.twig', [
            'composant' => $composant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="composant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Composant $composant): Response
    {
        $form = $this->createForm(ComposantType::class, $composant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('composant_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('composant/edit.html.twig', [
            'composant' => $composant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="composant_delete", methods={"POST"})
     */
    public function delete(Request $request, Composant $composant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$composant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($composant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('composant_new', [], Response::HTTP_SEE_OTHER);
    }
}
