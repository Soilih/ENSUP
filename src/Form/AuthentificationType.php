<?php

namespace App\Form;

use App\Entity\Authentification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthentificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('diplomes' , FileType::class , [
                "label"=>"Joindre les attestations des diplomes"
            ])
            ->add('releve' , FileType::class , [
                "label"=>"Joindre les relevé de notes"
            ])
            ->add('bac' , FileType::class , [
                "label"=>"Joindre attestation de reussite baccalaureat"
            ])
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Authentification::class,
        ]);
    }
}
