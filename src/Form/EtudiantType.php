<?php

namespace App\Form;

use App\Entity\Etudiant;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;



class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sexe' , ChoiceType::class , [
                'choices'  => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ], 
                'label' => 'Genre ', 
                'attr' => ['class' => 'form-control']
            ])
            ->add('lieuNaissance' ,  TextType::class , [
                'label'=>'Lieu de naissance' ])
            ->add('dateNaissance' , DateType::class ,[
                'attr'=>["class"=>"form-control"] , 
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
             
            ->add('telephone' , TextType::class , [
                "label"=>"Telephone mobile"
            ])
            ->add('photo' , FileType::class , [
                'label'=>"Photo d'identité" ,
                'mapped' =>  false , 
                'required' => false,
               
            ])
            ->add('etatcivile', ChoiceType::class , [
                'choices'  => [
                    'celibataire' => 'celibataire',
                    'Marié(e)' => 'marié',
                    'Séparé(e)' => 'marié',
                    'Divorcé(e)' => 'Divorcé',
                    'Veuf(ve)' =>  'Veuf'
                ], 
                'label' => 'Situation familiale et maritale', 
                 'attr' => ['class' => 'form-control']
            ])
            ->add('nationalite' ,  TextType::class , [
                'label'=>'Nationalité'
            ])
            ->add('ile' , ChoiceType::class , [
                'choices'  => [
                    'Ngazidja' => 'Ngazidja',
                    'Anjuan' => 'Anjuan',
                    'Moheli' => 'Moh',
                ], 
                'label' => 'selectionner votre ile de residence ', 
                'attr' => ['class' => 'form-control']
            ])
            ->add('telUrgence' ,  TextareaType::class , 
            ['label'=>"Telephone, adresse de residence  et nom - prenom  de la personne à contacter en cas d'urgence ",
             'attr'=>["placeholder"=>"Exemple : 3251366 , SOILIH-MOHAMED , FASSI MITSAMIOULI "]
              
            ])
             ->add('typeIdentite' , ChoiceType::class , [
                'choices'  => [
                    'Passport' => 'Passport',
                    'Titre de sejour' => 'Titre de sejour',
                    'Carte identité' => 'Carte identité',
                ], 
                'label' => "Type de pièce d'identité ", 
                'attr' => ['class' => 'form-control']
            ])
            ->add('NumCarteidentite' , TextType::class , [
                "label"=>"Numero de carte d'identite"
            ])
            ->add('dateExpiration' , DateType::class , [
                "label"=>"Date de validite " , 
                'widget' => 'single_text',
            ])
            ->add('dateDelivrance' , DateType::class , [
                "label"=>"Date de delivrance"  , 
                'widget' => 'single_text',
            ])
            ->add('Pieceidentite' , FileType::class , [
                'label'=>"Piece d'identite validé " ,
                'mapped' =>  false , 
                'required' => true,
               
            ])
            ->add('adresse' , TextType::class , [
                "label"=>"Lieu de residence"
            ])
            ->add('pays' , TextType::class , [
                "label"=>"Pays de naissance"
            ])
            
              
            
              
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
