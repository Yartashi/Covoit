<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('password', PasswordType::class)
            ->add('mail', EmailType::class)
            ->add('adresse', TextType::class)
            ->add('numTel', TextType::class)
            ->add('dateNaiss', DateType::class)
            ->add('styleChoix', ChoiceType::class, [
                'choices' => [
                    'Clair' => 1,
                    'Sombre' => 2,
                ]
            ])
            ->add('langueChoix', ChoiceType::class, [
                'choices' => [
                    'Français' => 'FR',
                    'Anglais' => 'EN',
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Utilisateur' => 'ROLE_USER',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
