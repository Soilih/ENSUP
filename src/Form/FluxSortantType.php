<?php

namespace App\Form;

use App\Entity\FluxSortant;
use App\Entity\Flux;
use App\Entity\Niveau;
use App\Entity\TypeUniversite;
use App\Entity\Composant;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FluxSortantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDepart' , DateType::class , [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr'=>["class"=>"form-control"] , 
                'label'=>'Date de depart '
            ])
            ->add('filiere' , TextType::class , [
                'label'=>"Filiere d'etude"
            ] )
            ->add('universite' , TextType::class , [
                'label'=>"Titre de l'universite d'etude"
            ])
            ->add('ville' , TextType::class)
            ->add('pays' , TextType::class)
            ->add('composant' , EntityType::class  ,[
                'label'=>"Domainde detude poursuivis", 
                'class'=> Composant::class , 
                'choice_label'=>'libelle' , 
                 'attr'=>['class' => 'form-control']
            ])
            ->add('niveau' , EntityType::class , [
                'class'=>Niveau::class , 
                 'label'=>"niveau poursuivis",
                'choice_label'=>'libelle', 
                'attr'=>['class'=>'form-control']
            ])
            
            ->add('typeUniversite' , EntityType::class  ,[
                'class'=> TypeUniversite::class , 
                'choice_label'=>'libelle' , 
                 'attr'=>['class' => 'form-control']
            ])
            ->add('type' , ChoiceType::class  ,[
                'label'=>"selectionner le type de flux ",
                'choices'=>[
                'resident'=>'resident' , 
                'sortant'=>'sortant'
            ] , 
            'attr'=>['class'=>'form-control']
            ])
            ->add('typeuniversit' , ChoiceType::class  ,[
                'label'=>"selectionner le type d'universite ",
                'choices'=>[
                'privé'=>'privé' , 
                'public'=>'public'
            ] , 
            'attr'=>['class'=>'form-control']
            ])
            ->add('cycle' , ChoiceType::class  ,[
                'label'=>"selectionner le cycle de poursuiite ",
                'choices'=>[
                'cycle 1'=>'cycle1' , 
                'cycle 2'=>'cycle2' , 
                'cycle 3'=>'cycle3' , 
            ] , 
            'attr'=>['class'=>'form-control']
            ])
            ->add('moyen' , TextareaType::class , [
                'label'=>'moyen de subsistance durant tes etudes si vous ne gagnez pas de bourse'
            ])
            ->add('motivation' , TextareaType::class , [
                'label'=>'projet proffessionnel'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FluxSortant::class,
        ]);
    }
}
