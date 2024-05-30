<?php

namespace App\Form;

use App\Entity\Enfant;
use App\Entity\RendezVous;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RendezVousType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser(); // Récupérer l'utilisateur passé dans les options

        $builder
            ->add('typeConsultation', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Consultation' => 'Consultation',
                    'Vaccination' => 'Vaccination',
                    'Controle' => 'Controle',
                ],
                'placeholder' => '-- Choisir un type de consultation --',
                'label' => 'Type de consultation',
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('enfant', EntityType::class, [
                'required' => true,
                'class' => Enfant::class,
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'label' => 'Enfant',
                'placeholder' => '-- Choisir un enfant --',
                'attr' => [
                    'class' => 'form-select',
                ],
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('e')
                        ->where('e.user = :user')
                        ->setParameter('user', $user);
                },
            ])
            ->add('motif', ChoiceType::class, [
                'required' => true,
                'label' => 'Motif',
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'choices' => [
                    'Fièvre' => 'Fièvre',
                    'Toux' => 'Toux',
                    'Vomissement' => 'Vomissement',
                    'Diarrhée' => 'Diarrhée',
                    'Douleur' => 'Douleur',
                    'Autre' => 'Autre',
                ],
                'placeholder' => '-- Choisir un motif --',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('date', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Date et heure de consultation',
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
