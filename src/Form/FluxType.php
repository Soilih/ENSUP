<?php

namespace App\Form;

use App\Entity\Composant;
use App\Entity\Universite;
use App\Entity\User;
use App\Entity\Flux;
use App\Entity\Niveau;
use App\Entity\TypeUniversite;
use App\Entity\TypeDiplome;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FluxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('diplome' , TextType::class , [
                'label'=>'Dernier diplome' , 
                'attr'=>['class'=>'form-control']
            ])
            ->add('specialite' , TextType::class , [
                'label'=>'Domaine de specialité' , 
                'attr'=>['class'=>'form-control']
            ])
            ->add('niveauActuel' ,  EntityType::class , [
                'class'=>Niveau::class , 
                'label'=> "Niveau atteint", 
                'choice_label'=>'libelle', 
                'attr'=>['class'=>'form-control']
            ])
            ->add('depart' ,  DateType::class , [
                'label'=>"Date depart pour tes etudes ",
                'attr'=>["class"=>"form-control"] , 
                'widget' => 'single_text',
                
            ])
            ->add('dateArrive' ,  DateType::class , [
                'label'=>"Date d'arrivée au terrritoire " ,
                'attr'=>["class"=>"form-control"] ,
                'widget' => 'single_text', 
               
            ])
            ->add('cycle' , ChoiceType::class  ,[
                'label'=>'selectionner le cycle actuel',
                'choices'=>[
                    'cycle 1'=>'cycle1' , 
                    'cycle 2'=>'cycle2' , 
                    'cycle 3'=>'cycle3'
                ] , 
                'attr'=>['class'=>'form-control']
            ])
            ->add('pays' , TextType::class , [
                'label'=>'Pays' , 
                'attr'=>['class'=>'form-control']
            ])
            ->add('detail' , TextareaType::class  ,[
                'label'=>'Expliquez brievement le deroulement de tes etudes'
            ])
            ->add('probleme' , TextareaType::class,[
                'label'=>'Citez quelles difficultés rencontreés durant tes etudes'

            ])
            
            ->add('projet' , TextareaType::class  ,[
                'label'=>'Avez-vous des projets pour votre pays ? '

            ])
            ->add('etudePoursuite' , TextareaType::class  ,[
                'label'=>'Souhaitez-vous poursuivre les etudes encore  ? si oui pourquoi ?'
            ])
            ->add('suggestion' , TextareaType::class  ,[
                'label'=>'Quelques suggestions pour tes etudes'

            ])
           


            


            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Flux::class,
        ]);
    }
}
