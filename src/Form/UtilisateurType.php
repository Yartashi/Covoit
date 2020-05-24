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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UtilisateurType extends AbstractType
{
    protected $auth;

    public function __construct(AuthorizationCheckerInterface $auth) {
        $this->auth = $auth;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,['constraints'=>[new NotBlank(),new Length(['max'=>255]),]])
            ->add('nom', TextType::class,['constraints'=>[new Length(['max'=>255]),]])
            ->add('prenom', TextType::class,['constraints'=>[new Length(['max'=>255]),]])
            ->add('password', PasswordType::class,['constraints'=>[new NotBlank(),new Length(['max'=>255]),]])
            ->add('mail', EmailType::class,['constraints'=>[new NotBlank(),new Length(['max'=>255]),]])
            ->add('adresse', TextType::class,['constraints'=>[new Length(['max'=>255]),]])
            ->add('numTel', TextType::class,['constraints'=>[new Length(['max'=>255]),]])
            ->add('dateNaiss', DateType::class)
            ->add('styleChoix', ChoiceType::class, ['constraints'=>[new NotBlank()],
                'choices' => [
                    'Clair' => 1,
                    'Sombre' => 2,
                ]
            ])
            ->add('langueChoix', ChoiceType::class, ['constraints'=>[new NotBlank()],
                'choices' => [
                    'Français' => 'fr',
                    'Anglais' => 'en',
                ]
            ]);
            if ($this->auth->isGranted('ROLE_ADMIN')){
                $builder->add('roles', ChoiceType::class, ['constraints'=>[new NotBlank()],
                    'multiple' => true,
                    'choices' => [
                        'Administrateur' => 'ROLE_ADMIN',
                        'Utilisateur' => 'ROLE_USER',
                    ]
                ]);
            }
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
