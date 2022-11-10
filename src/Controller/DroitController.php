<?php

namespace App\Controller;

use App\Entity\Droit;
use App\Form\DroitType;
use App\Repository\DroitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use DateTime;
/**
 * @Route("/droit")
 */
class DroitController extends AbstractController
{
    /**
     * @Route("/", name="app_droit_index", methods={"GET"})
     */
    public function index(DroitRepository $droitRepository): Response
    {
        return $this->render('droit/index.html.twig', [
            'droits' => $droitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_droit_new", methods={"GET", "POST"})
     */
    public function new(FileUploader $fileUploader, Request $request, DroitRepository $droitRepository): Response
    {
        $droit = new Droit();
        $droit->setUser($this->getUser());
        $form = $this->createForm(DroitType::class, $droit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $date = date("Y");
            $code1 = substr($date , -2);
            $rd = rand(1,100);
            $code = "AQD_".$code1."/".$rd;
            $droit->setReference($code);
            $droit->setDatecreate(new DateTime());
            $brochureFile1 = $form->get('inscription')->getData();
            $brochureFile2 = $form->get('hebergement')->getData();
            $brochureFile3= $form->get('diplomes')->getData();
            $brochureFile4= $form->get('releve')->getData();
            $brochureFile5= $form->get('charge')->getData();
            $brochureFile6= $form->get('passport')->getData();
            $brochureFile7= $form->get('visa')->getData();
            if(  $brochureFile1|| $brochureFile2 ||  $brochureFile3 ||  $brochureFile4 || $brochureFile5 || $brochureFile6 || $brochureFile7 ){
                $inscription= $fileUploader->upload($brochureFile1);
                $hebergement= $fileUploader->upload($brochureFile2);
                $diplomes= $fileUploader->upload($brochureFile3);
                $releve= $fileUploader->upload($brochureFile4);
                $charge= $fileUploader->upload($brochureFile5);
                $passport= $fileUploader->upload($brochureFile6);
                $visa= $fileUploader->upload($brochureFile7);

                $droit->setInscription($inscription);
                $droit->setHebergement($hebergement);
                $droit->setDiplomes($releve);
                $droit->setReleve($diplomes);
                $droit->setPassport($passport);
                $droit->setCharge($charge);
                $droit->setVisa($visa);

            }

            $droitRepository->add($droit);
            $this->addFlash("success" , "votre  'A qui de droit' est bien enregistré avec success");
            return $this->redirectToRoute('app_droit_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('droit/new.html.twig', [
            'droit' => $droit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_droit_show", methods={"GET"})
     */
    public function show(Droit $droit): Response
    {
        return $this->render('droit/show.html.twig', [
            'droit' => $droit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_droit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Droit $droit, DroitRepository $droitRepository): Response
    {
        $form = $this->createForm(DroitType::class, $droit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $droitRepository->add($droit);
            return $this->redirectToRoute('app_droit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('droit/edit.html.twig', [
            'droit' => $droit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_droit_delete", methods={"POST"})
     */
    public function delete(Request $request, Droit $droit, DroitRepository $droitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$droit->getId(), $request->request->get('_token'))) {
            $droitRepository->remove($droit);
        }

        return $this->redirectToRoute('app_droit_index', [], Response::HTTP_SEE_OTHER);
    }
}
