<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'required' => true,
            'attr' => [
                'class' => 'form-control',
                'maxlength' => '20'
            ],
            'label' => 'Nom :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ]
        ])
        ->add('prenom', TextType::class, [
            'required' => true,
            'attr' => [
                'class' => 'form-control',
                'maxlength' => '20'
            ],
            'label' => 'Prénom :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ]
        ])
        ->add('telephone', IntegerType::class, [
            'required' => true,
            'attr' => [
                'class' => 'form-control',
                'maxlength' => '10'
            ],
            'label' => 'Téléphone :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ],
            'constraints' => [
                new Length([
                    'max' => 10,
                    'minMessage' => 'Le numéro de téléphone doit comporter au moins {{ limit }} chiffres.'
                ])
            ]
        ])
        ->add('email', EmailType::class, [
            'required' => true,
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Email :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ]
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'mapped' => false,
            'invalid_message' => "Les champs du mot de passe doivent correspondre.",
            'constraints' => array(
                new NotBlank(array(
                    'message' => "Le mot de passe ne peut pas être vide.",
                )),
                new Length(array(
                    'min' => 8,
                    'minMessage' => "Le mot de passe doit comporter au moins {{ limit }} caractères."
                )),
                new Regex(array(
                    'pattern' => "/^(?=.*[A-Z])/",
                    'message' => "Le mot de passe doit contenir au moins une lettre majuscule."
                )),
            ),
            'first_options'  => array( 
                'attr' => [
                    'class' => 'form-control mb-3',
                ],
                'label' => 'Mot de passe :',
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
            ),
            'second_options' => array(
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Confirmez votre mot de passe :',
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
            ),
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
