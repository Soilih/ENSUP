<?php

namespace App\Form;

use App\Entity\Langue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LangueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle' ,  TextType::class , [
                'label'=> 'saisir une langue ..... '
            ])
            ->add('niveau' ,  ChoiceType::class , [
                'choices'  => [
                    'debutant' => 'debutant',
                    'maternelle' => 'maternelle',
                    'Intermediaire' => 'intermediaire',
                    'bien' => 'bien',
                    'exellent' => 'exellent',
                ], 
                'label' => 'selectionner votre niveau', 
                'attr' => ['class' => 'form-control'],
                 
                ])

                ->add('detail' ,  TextareaType::class , [
                    'label'=> 'Description de votre niveau en langue  '
                ])
            
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Langue::class,
        ]);
    }
}
