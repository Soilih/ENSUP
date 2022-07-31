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

class BourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant' , NumberType::class)
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
            ->add('detail' , TextareaType::class)
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bourse::class,
        ]);
    }
}
