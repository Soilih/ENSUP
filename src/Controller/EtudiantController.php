<?php

namespace App\Controller;


use App\Entity\Etudiant;
use App\Service\FileUploader;
use App\Form\EtudiantType;
use App\Form\User;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
/**
 * @Route("/etudiant")
 */
class EtudiantController extends AbstractController
{
    //je declare la variable repo pour recupere la repository 
    private $repo;
    //je declare le constructeur de cette classe 
    public function __construct(EtudiantRepository $repo){
        $this->repo = $repo ;
    }
   

    
    
    /**
     * @Route("/", name="etudiant_index", methods={"GET"})
     */
    public function index(EtudiantRepository $etudiantRepository): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etudiant_new", methods={"GET","POST"})
     */
    public function new(FileUploader $fileUploader , Request $request , EtudiantRepository $etudiantRepository): Response
    {
        $etudiant = new Etudiant();
        $serie = NULL;
        $etudiant->setUser($this->getUser());
       // $etudiant->setCodeDoosier("2022KKLE");
        
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile1 = $form->get('photo')->getData();
            $brochureFile2 = $form->get('Pieceidentite')->getData();
            $brochureFile3 = $form->get('cv')->getData();
            
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
           
            if ($brochureFile1 || $brochureFile2 || $brochureFile3) {
                $brochureFileName1 = $fileUploader->upload($brochureFile1);
                $brochureFileName2 = $fileUploader->upload($brochureFile2);
                $brochureFileName3 = $fileUploader->upload($brochureFile3);

                $etudiant->setPieceidentite($brochureFileName2);
                $etudiant->setPhoto($brochureFileName1);
                $etudiant->setcv($brochureFileName3);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();

            return $this->redirectToRoute('etudiant_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudiant/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form , 
            "serie"=>  $serie , 
            'etudiants' => $etudiantRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_show", methods={"GET"})
     */
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('etudiant/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etudiant_edit", methods={"GET","POST"})
     */
    public function edit(FileUploader $fileUploader ,Request $request, Etudiant $etudiant): Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
   
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile1 = $form->get('photo')->getData();
            $brochureFile2 = $form->get('Pieceidentite')->getData();
            $brochureFile3 = $form->get('cv')->getData();
            
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
           
            if ($brochureFile1 || $brochureFile2 || $brochureFile3 ) {
                $brochureFileName1 = $fileUploader->upload($brochureFile1);
                $brochureFileName2 = $fileUploader->upload($brochureFile2);
                $brochureFileName3 = $fileUploader->upload($brochureFile3);

                $etudiant->setPieceidentite($brochureFileName2);
                $etudiant->setPhoto($brochureFileName1);
                $etudiant->setcv($brochureFileName3);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudiant/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_delete", methods={"POST"})
     */
    public function delete(Request $request, Etudiant $etudiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_accueil', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/reca", name="etudiant_reca", methods={"GET"})
     * @ParamConverter("etudiant" , class="App\Repository\EtudiantRepository")
     */
    public function recap(EtudiantRepository $etudiant): Response
    {
          return $this->render('recap.html.twig',[
              'etudiant'=>$etudiant->findAll()
            
        ]);
        
        
    
    }
}
