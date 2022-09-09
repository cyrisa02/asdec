<?php

namespace App\Form;

use App\Entity\Price;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adult', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Tarif adulte',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('child', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Tarif enfant',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('year', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Saison',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('isTicket', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input mt-4 ms-4',
                ],
                'required' => false,
                'label' => 'Ce tarif fait-il l\'objet d\'un paiement au ticket?',
                'label_attr' => [
                    'class' => 'form-check-label mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Price::class,
        ]);
    }
}