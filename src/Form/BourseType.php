<?php

namespace App\Form;

use App\Entity\Bourse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datecreate' , DateType::class , [
                "label"=>"Date d'obtention de bourse " , 
                "attr"=>["class"=>"form-control"] , 
                'widget' => 'single_text',
                 'format' => 'yyyy-MM-dd',
            ])
            ->add('montant' , NumberType::class , [
                "label"=>"Montant de bourse/mois " , 
                "attr"=>[
                    "class"=>"form-control"  ]
               ])
            ->add('Nature' , ChoiceType::class  ,[
                'label'=>"Nature de bourse",
                'choices'=>[
                'partiel'=>'partiel' , 
                'complete'=>'complete' , 
                'specifique'=>'specifique'
            ] , 
            'attr'=>['class'=>'form-control']
            ])
            ->add('pays' , TextType::class)
            ->add('detail' , TextareaType::class , [
                "label"=>"Decrire brievement les modalités de la bourse "
            ])
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bourse::class,
        ]);
    }
}
