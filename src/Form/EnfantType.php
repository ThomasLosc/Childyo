<?php

namespace App\Form;

use App\Entity\Enfant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EnfantType extends AbstractType
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
        ->add('dateNaissance', DateType::class, [
            'required' => true,
            'widget' => 'single_text',
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Date de naissance :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ]
        ])
        ->add('medecinTraitant', TextType::class, [
            'required' => true,
            'attr' => [
                'class' => 'form-control',
                'maxlength' => '50'
            ],
            'label' => 'Médecin traitant :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ]
        ])
        ->add('genre', ChoiceType::class, [
            'choices' => [
                'Garçon' => true,
                'Fille' => false,
            ],
            'expanded' => true, // Render as radio buttons
            'required' => true,
            'multiple' => false,
            'label' => 'Genre :',
            'label_attr' => [
                'class' => 'form-label fw-bold'
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enfant::class,
        ]);
    }
}
