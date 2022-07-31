<?php

namespace App\Form;

use App\Entity\InformationBac;
use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InformationBacType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('serie' ,  EntityType::class , [
            'class'=>Serie::class , 
            'choice_label'=>'libelle',
            'label'=>'serie au bac' , 
            'attr'=>['class'=>'form-control']
           ])
        ->add('mention' ,  ChoiceType::class  ,[
            'label'=>"Mention obtenue",
            'choices'=>[
            'Honorable'=>'Honorable' , 
            'Exellent'=>'Exellent' , 
            'Tres-bien'=>'Tres-bien' , 
            'Bien'=>'Bien',
            'Assez-Bien'=>'Assez-Bien',
            'Passable'=>"Passable"
        ] , 
        'attr'=>['class'=>'form-control']
        ])
        ->add('moyenne' , NumberType::class , [
            "label"=>"Moyenne obtenue au baccalaureat"
        ])
        ->add('session' ,  ChoiceType::class  ,[
            'label'=>"Type de session",
            'choices'=>[
            'session 1'=>'session 1' , 
            'session 2'=>'session 2' , 
            
        ] , 
        'attr'=>['class'=>'form-control']
        ])
         ->add('ecole' , TextType::class , [
                "label"=>"Etablissement frequenté"
            ])
            
            
        ->add('attestation' , FileType::class , [
                'label'=>"Attesation du bac ou diplome" ,
                'mapped' =>  false , 
                'required' => true,
            ])
        ->add('releve' , FileType::class , [
                'label'=>"Televerser votre rélevé de note  " ,
                'mapped' =>  false , 
                'required' => true,
            ])
            
            
        ->add('cursus' , TextareaType::class , [
                "label"=>"Expliquez brievement votre cursus scolaire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InformationBac::class,
        ]);
    }
}
