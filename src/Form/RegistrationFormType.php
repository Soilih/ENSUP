<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email' , EmailType::class , [
                "label"=>"Adresse électronique"
            ])
            ->add('nom' , TextType::class , [
                "label"=>"nom"
            ])
            ->add('Prenom' , TextType::class , [
                "label"=>"Prenom"
            ])
            ->add('nin' , TextType::class , [
                "label"=>"Numero de piece d'identite  "
            ])
            ->add('numerocarte' , TextType::class , [
                "label"=>"Numero de Carte" , 
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'anné de session ",
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => "Le numero de carte n'est pas valide ",
                        // max length allowed by Symfony for security reasons
                        'max' => 7,
                    ]),
                ],
            ])
            ->add('session' , NumberType::class , [
                "label"=>"Année de session " , 
                "attr"=>["class"=>"form-control"] , 
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'anné de session ",
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => "l'année de session est invalide",
                        // max length allowed by Symfony for security reasons
                        'max' => 4,
                    ]),
                ],
                
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label'=>'mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 10,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add("Inscription" , SubmitType::class , [
                'attr'=>['class'=>'btn btn-primary btn-block']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
