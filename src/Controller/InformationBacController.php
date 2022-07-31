<?php

namespace App\Controller;
use App\Service\FileUploader;
use App\Entity\InformationBac;
use App\Entity\Serie;
use App\Form\InformationBacType;
use App\Repository\InformationBacRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/information/bac")
 */
class InformationBacController extends AbstractController
{
    /**
     * @Route("/", name="information_bac_index", methods={"GET"})
     */
    public function index(InformationBacRepository $informationBacRepository): Response
    {
        return $this->render('information_bac/index.html.twig', [
            'information_bacs' => $informationBacRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="information_bac_new", methods={"GET", "POST"})
     */
    public function new(FileUploader $fileUploader , Request $request, InformationBacRepository $informationBacRepository ,  EntityManagerInterface $entityManager): Response
    {
        $informationBac = new InformationBac();
        $informationBac ->setUser($this->getUser());
        $form = $this->createForm(InformationBacType::class, $informationBac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile1 = $form->get('attestation')->getData();
            $brochureFile2 = $form->get('releve')->getData();
            
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
           
            if ($brochureFile1 || $brochureFile2 ) {
                $brochureFileName1 = $fileUploader->upload($brochureFile1);
                $brochureFileName2 = $fileUploader->upload($brochureFile2);

                $informationBac->setAttestation($brochureFileName2);
                $informationBac->setReleve($brochureFileName1);
            }


            $entityManager->persist($informationBac);
            $entityManager->flush();

            return $this->redirectToRoute('information_bac_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('information_bac/new.html.twig', [
            'information_bac' => $informationBac,
            'form' => $form,
            'informationBacs' => $informationBacRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="information_bac_show", methods={"GET"})
     */
    public function show(InformationBac $informationBac): Response
    {
        return $this->render('information_bac/show.html.twig', [
            'information_bac' => $informationBac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="information_bac_edit", methods={"GET", "POST"})
     */
    public function edit(FileUploader $fileUploader , Request $request, InformationBac $informationBac, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InformationBacType::class, $informationBac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile1 = $form->get('attestation')->getData();
            $brochureFile2 = $form->get('releve')->getData();
            
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
           
            if ($brochureFile1 || $brochureFile2 ) {
                $brochureFileName1 = $fileUploader->upload($brochureFile1);
                $brochureFileName2 = $fileUploader->upload($brochureFile2);

                $informationBac->setAttestation($brochureFileName2);
                $informationBac->setReleve($brochureFileName1);
            }


            $entityManager->persist($informationBac);
            $entityManager->flush();

            return $this->redirectToRoute('information_bac_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('information_bac/edit.html.twig', [
            'information_bac' => $informationBac,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="information_bac_delete", methods={"POST"})
     */
    public function delete(Request $request, InformationBac $informationBac, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$informationBac->getId(), $request->request->get('_token'))) {
            $entityManager->remove($informationBac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('information_bac_index', [], Response::HTTP_SEE_OTHER);
    }
}
