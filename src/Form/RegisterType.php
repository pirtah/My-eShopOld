<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email :',
/*                 'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'Votre email ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new Email([
                        'message' => 'Vous devez entrer un email valide',
                    ]),
                ], */
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide'
                    ]),
                    new Length([
                        'min' => 8,
                        'max' => 255,
                        'minMessage' => 'Votre mot de passe doit avoir au minimum {{ limit }} caractères.',
                        'maxMessage' => 'Votre mot de passe ne peut pas dépasser {{ limit }} caractères.',
                    ]),

                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                    new Length([
                       'max' => 50,
                       'min' => 2,
                       'maxMessage' => 'Votre prénom ne peut dépasser {{ limit }} caractères.',
                       'minMessage' => 'Votre prénom doit avoir au minimum {{ limit }} caractères.' 
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide'
                    ]),
                    new Length([
                        'max' => 50,
                        'min' => 2,
                        'maxMessage' => 'Votre nom ne peut dépasser {{ limit }} caractères.',
                        'minMessage' => 'Votre nom doit avoir au minimum {{ limit }} caractères.' 
                     ]),
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => "Civilité :",
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'Homme' => 'h',
                    'Femme' => 'f',
                    'Autre' => 'x',
                ], 
                'attr' => [
                    'class' => 'd-flex gap-3',
                ],
/*                 new NotBlank([
                    'message' => 'Veuillez choisir un genre'
                ]), */
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx-auto col-2 btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            //Permet de désactiver le validator en front
            'validate' => false,
        ]);
    }
}
