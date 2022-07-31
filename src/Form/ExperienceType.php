<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateExperience' , DateType::class  , [
                'label'=>'date de debut' , 
                'attr'=>[
                    'class'=>'form-control'
                ], 
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('datefin' , DateType::class  , [
                'label'=>'date de Fin' , 
                'attr'=>[
                    'class'=>'form-control'
                ] , 
                'widget' => 'single_text',
            ])
            ->add('poste' ,  TextType::class , [
                'label'=>"Quelle poste occupez-vous ? "
            ])
            ->add('entreprise' ,  TextType::class , [
                "label"=>"Intitulé de l'entreprise "
            ])
            ->add('pays' , TextType::class , [
                'attr'=>[
                    'class'=>'form-control'
                ] , 
                "label"=>"Dans quel pays avez-vous exercé ce travail ? "
            ])
            ->add('detail' ,  TextareaType::class  , [
                'label'=>"Description "
            ])
            
            
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
