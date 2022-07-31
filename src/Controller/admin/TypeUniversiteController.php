<?php

namespace App\Controller\admin;

use App\Entity\TypeUniversite;
use App\Form\TypeUniversiteType;
use App\Repository\TypeUniversiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/type/universite")
 */
class TypeUniversiteController extends AbstractController
{
    /**
     * @Route("/", name="type_universite_index", methods={"GET"})
     */
    public function index(TypeUniversiteRepository $typeUniversiteRepository): Response
    {
        return $this->render('type_universite/index.html.twig', [
            'type_universites' => $typeUniversiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_universite_new", methods={"GET","POST"})
     */
    public function new(Request $request , TypeUniversiteRepository $typeUniversiteRepository): Response
    {
        $typeUniversite = new TypeUniversite();
        $form = $this->createForm(TypeUniversiteType::class, $typeUniversite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeUniversite);
            $entityManager->flush();

            return $this->redirectToRoute('type_universite_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_universite/new.html.twig', [
            'type_universite' => $typeUniversite,
            'form' => $form,
            'type_universites' => $typeUniversiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_universite_show", methods={"GET"})
     */
    public function show(TypeUniversite $typeUniversite): Response
    {
        return $this->render('type_universite/show.html.twig', [
            'type_universite' => $typeUniversite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_universite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeUniversite $typeUniversite): Response
    {
        $form = $this->createForm(TypeUniversiteType::class, $typeUniversite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_universite_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_universite/edit.html.twig', [
            'type_universite' => $typeUniversite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_universite_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeUniversite $typeUniversite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeUniversite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeUniversite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_universite_new', [], Response::HTTP_SEE_OTHER);
    }
}
