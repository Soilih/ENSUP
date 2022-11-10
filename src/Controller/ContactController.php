<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/ ", name="app_contact_new")
     */
    public function new_contact(Request $request ): Response
    {   $contact = new Contact();
        $contact->setDatecreate(new DateTime());
        $form = $this->createFormBuilder( $contact)
        ->add('Nom', TextType::class ,[
            'attr' => ['placeholder' => "Nom et Prenom "]
            ])
        ->add('telephone', TelType::class ,[
            'attr' => ['placeholder' => "Telephone mobile"]
        ])
        ->add('email', EmailType::class  ,[
            'attr' => ['placeholder' => "Adresse E-mail valide "]
        ])
        ->add('objet', TextType::class , [
            'attr' => ['placeholder' => "Objet "]
            ])
        ->add('detail', TextareaType::class , [
            'attr' => ['placeholder' => "Description du message  "]
            ])
        
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $articles = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($articles);
            $em->flush();
            $this->addFlash("message" , "votre message est bien envoyé avec success");

           
        }

        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
   
    /**
     * @Route("/list ", name="app_contact")
     */

    public function list_contact(ContactRepository $contactRepository): Response 
    {
        $contact = $contactRepository->findAll();
        return $this->render("contact/index.html.twig" , [
            "contactes"=> $contact
        ]);
    }
 }

