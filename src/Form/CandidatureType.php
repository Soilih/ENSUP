<?php

namespace App\Form;

use App\Entity\Candidature;
use App\Entity\Niveau;
use App\Entity\TypeDiplome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('flux' , ChoiceType::class  ,[
                'label'=>"selectionner le type de flux ",
                'choices'=>[
                'resident'=>'resident' , 
                'sortant'=>'sortant' , 
                'entrant'=>'entrant' , 
            ] , 
            'attr'=>['class'=>'form-control']
            ])
            ->add('niveau' , EntityType::class , [
                'class'=>Niveau::class , 
                 'label'=>"niveau d'etude actuel ",
                'choice_label'=>'libelle', 
                'attr'=>['class'=>'form-control']
            ])
            ->add('typediplome' , EntityType::class , [
                'class'=>TypeDiplome::class , 
                 'label'=>"Dernier Diplome obtenu",
                'choice_label'=>'libelle', 
                'attr'=>['class'=>'form-control']
            ])
            ->add('bourse' , ChoiceType::class  ,[
                'label'=>"Beneficiez-vous de bourse ",
                'choices'=>[
                'oui'=>'oui' , 
                'non'=>'non' , 
                
            ] , 
            'attr'=>['class'=>'form-control']
            ])
            ->add('cursus' , ChoiceType::class  ,[
                'label'=>"Selectionner votre cursus universitaire  ",
                'choices'=>[
                'interne'=>'interne' , 
                'externe'=>'externe' , 
                "les deux "=> "deux" , 
                "j'ai pas fait de cursus universitaire"=>"autre"
                
            ] , 
            'attr'=>['class'=>'form-control']
            ])
            ->add('type', ChoiceType::class , [
                'choices'  => [
                    'etudiant' => 'etudiant',
                    'employ??' => 'employ??',
                    
                ], 
                'label' => 'votre statut actuel  ', 
                'attr' => ['class' => 'form-control']
            ])
            ->add('stage' , ChoiceType::class  ,[
                'label'=>"Avez-vous une experience proffessionnelle ou un stage ?",
                'choices'=>[
                'oui'=>'oui' , 
                'non'=>'non' , 
                
            ] , 
            'attr'=>['class'=>'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidature::class,
        ]);
    }
}
