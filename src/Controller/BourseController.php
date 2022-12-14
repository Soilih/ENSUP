<?php

namespace App\Controller;

use App\Entity\Bourse;
use App\Form\BourseType;
use App\Repository\BourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bourse")
 */
class BourseController extends AbstractController
{
   

    /**
     * @Route("/new", name="bourse_new", methods={"GET", "POST"})
     */
    public function new(BourseRepository $bourseRepository ,   Request $request, EntityManagerInterface $entityManager): Response
    {
        $bourse = new Bourse();
        $bourse ->setUser($this->getUser());
        $form = $this->createForm(BourseType::class, $bourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bourse);
            $entityManager->flush();
            $this->addFlash("success" , "informations de bourses sont bien enregistrées avec success ");
            return $this->redirectToRoute('bourse_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bourse/new.html.twig', [
            'bourse' => $bourse,
            'form' => $form,
            'bourses'=>$bourseRepository->findAll()
        ]);
    }

    

    /**
     * @Route("/{id}/edit", name="bourse_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Bourse $bourse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BourseType::class, $bourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bourse/edit.html.twig', [
            'bourse' => $bourse,
            'form' => $form,
        ]);
    }

    /** 
     * @Route("/delete/{id}", name="bourse_delete", methods={"DELETE"})
     */
   
    public function delete(Request $request, $id ): Response
    {
        $bourse = $this->getDoctrine()->getRepository(Bourse::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($bourse );
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->render('admin/home_user.html.twig');
    }
}
