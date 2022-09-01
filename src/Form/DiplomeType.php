<?php

namespace App\Form;

use App\Entity\Diplome;
use App\Entity\TypeDiplome;
use App\Entity\TypeUniversite;
use App\Entity\Composant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DiplomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle' ,  TextType::class , [
                'label'=>"Intitule de diplome   "
            ])
            ->add('fichier' , FileType::class , [
                'label'=>"Televerser votre diplome" ,
                'mapped' =>  false , 
                'required' => false,
              
            ])
            ->add('universite' , TextType::class , [
                'label'=>"Université etudiée "
            ])
            ->add('pays' , TextType::class , [
                'label'=>"Pays d'etude  "
            ])
            ->add('session' , TextType::class , [
                'label'=>"Anneé d'obtention", 
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 4]
            ])
            ->add('mention' , ChoiceType::class , [
                'choices'  => [
                    'Honorable' => 'Honorable',
                    'Exellent' => 'Exellent',
                    'Tres-bien' => 'Tres-bien',
                    'Bien' => 'Bien',
                    'Assez-bien' => 'Assez-bien',
                    'Passable'=>"Passable"
                ], 
                'label' => "Mention obtenu  ", 
                'attr' => ['class' => 'form-control']
            ])
            ->add('moyenne' , NumberType::class , [
                'label'=>"La moyenne obtenue " , 
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 2] ])
            
            ->add('typediplome' , EntityType::class ,[
                'class'=>TypeDiplome::class , 
                'label'=>"le type de diplome obtenu ",
               'choice_label'=>'libelle', 
               'attr'=>['class'=>'form-control']
            ])
            ->add('typeuniversite' , EntityType::class ,[
                'class'=>TypeUniversite::class , 
                'label'=>"Type d'enseignement",
               'choice_label'=>'libelle', 
               'attr'=>['class'=>'form-control']
            ])
            ->add('composant' , EntityType::class ,[
                'class'=>Composant::class , 
                'label'=>"Domaine d'etude ",
               'choice_label'=>'libelle', 
               'attr'=>['class'=>'form-control']
            ])
            ->add('description' , TextareaType::class , [
                'label'=>"Saisir un commentaire  "
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diplome::class,
        ]);
    }
}
