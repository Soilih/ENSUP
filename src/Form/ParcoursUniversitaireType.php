<?php

namespace App\Form;

use App\Entity\ParcoursUniversitaire;
use App\Entity\Niveau;
use App\Entity\TypeUniversite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ParcoursUniversitaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("typeCursus" , ChoiceType::class , [
                'label'=> "Type de cursus" , 
               'choices'=>[
                'Cursus interne'=>' interne' , 
                ' Cursus externe'=>'externe'
               ] , 
               'attr'=>["class"=>"form-control"]
            ])
            ->add('AnneInscription' , DateType::class , [
                'attr'=>["class"=>"form-control"] , 
                "label"=>"Anneé d'inscription " , 
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ]) 
            ->add('filiere' ,  TextType::class , [
                "label"=> "Votre Filiere d'etude"
            ])
            ->add('mention' ,  ChoiceType::class , [
                'choices'=>[
                    'Très-bien'=>'Tres-bien', 
                    'Exellent'=>'Exellent' , 
                    'Bien'=>'Bien', 
                    'Assez-bien'=>'Assez-bien',
                    'Passable'=>"Passable"
                ] , 
                'attr'=>['class'=>'form-control'] , 
                "label"=> "Mention obtenu"
            ])
            ->add('fichier' , FileType::class , [
                "label"=> "Joindre une justificatif " ,
                 'required' => false,
                 'mapped' => false, 
            ])
            ->add('moyenne' , NumberType::class , [
                "label"=>"Moyenne obtenu"
            ])
            ->add('titreUniveriste' , TextType::class , [
                'label'=>"Nom de l'tablissement"
            ])
            ->add('niveau' , EntityType::class , [
                'class'=>Niveau::class , 
                'choice_label'=>'libelle' , 
                'attr'=>['class'=>'form-control'] ,
                'label'=>"Niveau d'etude"
            ]
            )
            ->add('typeUniversite' , EntityType::class , [
                'class'=>TypeUniversite::class , 
                'choice_label'=>'libelle' , 
                'attr'=>['class'=>'form-control'] , 
                'label'=>"Type d'etablissement"
            ])
            ->add('pays', TextType::class )
            ->add('detail' ,  TextareaType::class)
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ParcoursUniversitaire::class,
        ]);
    }
}
