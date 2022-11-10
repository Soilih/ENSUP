<?php

namespace App\Form;

use App\Entity\Droit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DroitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('inscription' , FileType::class , [
                "label"=>"Attestation d'inscription"
            ])
            ->add('hebergement' , FileType::class , [
                "label"=>"Attestation d'hebergement "
            ])
            ->add('diplomes' , FileType::class , [
                "label"=>" Joindre les diplomes d'etudes "
            ])
            ->add('releve' , FileType::class , [
                "label"=>"joindre les releves de notes"
            ])
            ->add('charge' , FileType::class , [
                "label"=>"Attestation de prise en charge"
            ])
            ->add('passport' , FileType::class , [
                "label"=>"Pasport valide "
            ])
            ->add('visa' , FileType::class , [
                "label"=>"Visa etudiant  "
            ])
            ->add('commentaire' , TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Droit::class,
        ]);
    }
}
