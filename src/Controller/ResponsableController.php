<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\ResponsableType;
use App\Repository\ResponsableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/responsable")
 */
class ResponsableController extends AbstractController
{
    

    /**
     * @Route("/new", name="responsable_new", methods={"GET","POST"})
     */
    public function new(ResponsableRepository $responsableRepository , Request $request): Response
    {
        $responsable = new Responsable();
        $responsable->setUser($this->getUser());
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($responsable);
            $entityManager->flush();
            $this->addFlash("success" , "informations responsable  sont bien enregistrées avec success ");
            return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/new.html.twig', [
            'responsable' => $responsable,
            'responsables' => $responsableRepository->findAll(),
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="responsable_show", methods={"GET"})
     */
    public function show(Responsable $responsable): Response
    {
        return $this->render('responsable/show.html.twig', [
            'responsable' => $responsable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="responsable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Responsable $responsable): Response
    {
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/edit.html.twig', [
            'responsable' => $responsable,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="responsable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id): Response
    {
        $responsable = $this->getDoctrine()->getRepository(Responsable::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($responsable);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->render('admin/home_user.html.twig');
    }
}
