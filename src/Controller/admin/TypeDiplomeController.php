<?php

namespace App\Controller\admin;

use App\Entity\TypeDiplome;
use App\Form\TypeDiplomeType;
use App\Repository\TypeDiplomeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/type/diplome")
 */
class TypeDiplomeController extends AbstractController
{
    /**
     * @Route("/", name="type_diplome_index", methods={"GET"})
     */
    public function index(TypeDiplomeRepository $typeDiplomeRepository): Response
    {
        return $this->render('type_diplome/index.html.twig', [
            'type_diplomes' => $typeDiplomeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_diplome_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager , TypeDiplomeRepository  $typeDiplomeRepository): Response
    {
        $typeDiplome = new TypeDiplome();
        $form = $this->createForm(TypeDiplomeType::class, $typeDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeDiplome);
            $entityManager->flush();

            return $this->redirectToRoute('type_diplome_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_diplome/new.html.twig', [
            'type_diplome' => $typeDiplome,
            'form' => $form,
            'type_diplome' => $typeDiplomeRepository->findBy([],['libelle' => 'ASC'])
        ]);
    }

    /**
     * @Route("/{id}", name="type_diplome_show", methods={"GET"})
     */
    public function show(TypeDiplome $typeDiplome): Response
    {
        return $this->render('type_diplome/show.html.twig', [
            'type_diplome' => $typeDiplome,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_diplome_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeDiplome $typeDiplome, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeDiplomeType::class, $typeDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('type_diplome_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_diplome/edit.html.twig', [
            'type_diplome' => $typeDiplome,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_diplome_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeDiplome $typeDiplome, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDiplome->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeDiplome);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_diplome_new', [], Response::HTTP_SEE_OTHER);
    }
}
