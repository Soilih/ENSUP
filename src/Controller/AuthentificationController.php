<?php

namespace App\Controller;

use App\Entity\Authentification;
use App\Form\AuthentificationType;
use App\Repository\AuthentificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\FileUploader;
use DateTime;
use DoctrineExtensions\Query\Mysql\Now;

/**
 * @Route("/authentification")
 */
class AuthentificationController extends AbstractController
{
    /**
     * @Route("/", name="app_authentification_index", methods={"GET"})
     */
    public function index(AuthentificationRepository $authentificationRepository): Response
    {
        return $this->render('authentification/index.html.twig', [
            'authentifications' => $authentificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_authentification_new", methods={"GET", "POST"})
     */
    public function new(FileUploader $fileUploader , Request $request, AuthentificationRepository $authentificationRepository): Response
    {
        $authentification = new Authentification();
        $authentification->setUser($this->getUser());
        $form = $this->createForm(AuthentificationType::class, $authentification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = date("Y");
            $code1 = substr($date , -2);
            $rd = rand(1,100);
            $code = "AUT-".$code1."-".$rd;
            $authentification->setReference($code);
            $authentification->setDatecreate(new DateTime());
            $brochureFile1 = $form->get('diplomes')->getData();
            $brochureFile2 = $form->get('releve')->getData();
            $brochureFile3= $form->get('bac')->getData();
            
            
            if($brochureFile1 ||  $brochureFile2 || $brochureFile3  ){
                $brochureFileName = $fileUploader->upload($brochureFile1);
                $brochureFileName2 = $fileUploader->upload($brochureFile2);
                $brochureFileName3 = $fileUploader->upload($brochureFile3);
                $authentification->setDiplomes($brochureFileName);  
                $authentification->setReleve($brochureFileName2);  
                $authentification->setBac($brochureFileName3);  
            }
            $authentificationRepository->add($authentification);
            $this->addFlash("success" , "votre  authentification  est bien enregistré avec success");
            return $this->redirectToRoute('app_authentification_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('authentification/new.html.twig', [
            'authentification' => $authentification,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_authentification_show", methods={"GET"})
     */
    public function show(Authentification $authentification): Response
    {
        return $this->render('authentification/show.html.twig', [
            'authentification' => $authentification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_authentification_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Authentification $authentification, AuthentificationRepository $authentificationRepository): Response
    {
        $form = $this->createForm(AuthentificationType::class, $authentification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $authentificationRepository->add($authentification);
            return $this->redirectToRoute('app_authentification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('authentification/edit.html.twig', [
            'authentification' => $authentification,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_authentification_delete", methods={"POST"})
     */
    public function delete(Request $request, Authentification $authentification, AuthentificationRepository $authentificationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$authentification->getId(), $request->request->get('_token'))) {
            $authentificationRepository->remove($authentification);
        }

        return $this->redirectToRoute('app_authentification_index', [], Response::HTTP_SEE_OTHER);
    }
}
