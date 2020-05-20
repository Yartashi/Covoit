<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        ->add('description', TextareaType::class,['constraints'=>[new NotBlank(),new Length(['max'=>255]),]])
        ->add('villeDep', TextType::class,['constraints'=>[new NotBlank(),new Length(['max'=>255]),]])
        ->add('villeDest', TextType::class,['constraints'=>[new NotBlank(),new Length(['max'=>255]),]])
        ->add('dateDep', DateType::class,['constraints'=>[new NotBlank(),]])
        ->add('nombrePlacesMax', IntegerType::class,['constraints'=>[new NotBlank(),]])
        ->add('statut', ChoiceType::class,['constraints'=>[new NotBlank(),],
        'choices' => [
            'Disponible' => 1,
            'Terminé' => 2,
            ]
        ]);


        //->add('conducteur_id_id', TextareaType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
