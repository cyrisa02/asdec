<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


/**
 * That is for the new order, I don't want the field Isended
 */
class OrdernewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('customer', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Votre nom et prénom',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('articleNr', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Référence de l\'article',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Dénomination de l\'article et quantité commandée',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('comment', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Observation',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}