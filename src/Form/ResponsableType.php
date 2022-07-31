<?php

namespace App\Form;

use App\Entity\Responsable;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom' ,  TextType::class ,[
                'label' => 'Nom de famille ',
            ])
            ->add('prenom' ,  TextType::class ,[
                'label' => ' Prenom',
            ])
            ->add('tel' , TelType::class ,[
                'label' => 'Telephone portable',
            ])
            ->add('email' , EmailType::class ,[
                'label' => 'Adresse E-mail valide ',
             ])
            ->add('proffession' , TextType::class ,[
                'label' => 'Activté proffessionnelle'])
            ->add('adresse' ,  TextType::class , 
            ['label' => 'Lieu de residence '])
            ->add('lieunaissance' ,  TextType::class ,[
                'label' => 'Lieu de naissance ',
            ])
            ->add('pays' ,  TextType::class ,[
                'label' => 'Pays de naissance  ',
            ])
            ->add('detail' ,  TextareaType::class ,[
                'label' => 'Commentaire  ',
                
            ])
           
           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Responsable::class,
        ]);
    }
}
