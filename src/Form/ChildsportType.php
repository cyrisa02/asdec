<?php

namespace App\Form;

use App\Entity\Childsport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChildsportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Nom de l\'activité',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('place', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Lieu',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('day', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Jour',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('start', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Heure du début de l\'activité',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('end', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Heure de fin',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('peopleNbr', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Remarque et nombre de personnes pendant l\'activité',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Childsport::class,
        ]);
    }
}