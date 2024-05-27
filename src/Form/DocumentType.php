<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\Enfant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '30'
                ],
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'form-label lato-bold'
                ]
            ])
            ->add('type', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '30'
                ],
                'label' => 'Type',
                'label_attr' => [
                    'class' => 'form-label lato-bold'
                ]
            ])
            ->add('fichier', FileType::class, [
                'required' => true,
                'label' => 'Fichier (PDF file)',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'class' => 'form-label lato-bold'
                ],
                'data_class' => null,
            ])
            ->add('enfant', EntityType::class, [
                'required' => true,
                'class' => Enfant::class,
                'label' => 'Enfant',
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'choice_label' => function (Enfant $enfant) {
                    return (string) $enfant;
                },
                'placeholder' => 'Choisir un enfant',
                'attr' => [
                    'class' => 'form-select custom-select form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
