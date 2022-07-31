<?php

namespace App\Controller;

use App\Entity\Diplome;
use App\Entity\User;
use App\Form\DiplomeType;
use App\Repository\DiplomeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Service\FileUploader;
/**
 * @Route("/diplome")
 */
class DiplomeController extends AbstractController
{
   

    /**
     * @Route("/new", name="diplome_new", methods={"GET", "POST"})
     */
    public function new(FileUploader $fileUploader , DiplomeRepository $diplomeRepository , Request $request, EntityManagerInterface $entityManager): Response
    {
        $diplome = new Diplome();
        $diplome->setUser($this->getUser());
        $form = $this->createForm(DiplomeType::class, $diplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('fichier')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $diplome->setFichier($brochureFileName);
            }
            $entityManager->persist($diplome);
            $entityManager->flush();
            return $this->redirectToRoute('diplome_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diplome/new.html.twig', [
            'diplome' => $diplome,
            'form' => $form,
            'diplomes' => $diplomeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="diplome_show", methods={"GET"})
     */
    public function show(Diplome $diplome): Response
    {
        return $this->render('diplome/show.html.twig', [
            'diplome' => $diplome,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="diplome_edit", methods={"GET", "POST"})
     */
    public function edit(FileUploader $fileUploader , Request $request, Diplome $diplome, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DiplomeType::class, $diplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('fichier')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $diplome->setFichier($brochureFileName);
            }
            $entityManager->persist($diplome);
            $entityManager->flush();

            return $this->redirectToRoute('diplome_new', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('diplome/edit.html.twig', [
            'diplome' => $diplome,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="diplome_delete", methods={"POST"})
     */
    public function delete(Request $request, Diplome $diplome, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diplome->getId(), $request->request->get('_token'))) {
            $entityManager->remove($diplome);
            $entityManager->flush();
        }

        return $this->redirectToRoute('diplome_new', [], Response::HTTP_SEE_OTHER);
    }
}
