<?php

namespace App\Form;

use App\Entity\Sport;
use App\Entity\Timecard1;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Timecard1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('responsable', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Vos nom et prénom',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            
            ->add('sports', EntityType::class, [
                'class' => Sport::class,                
                'label' => 'Merci de sélectionner une activité',
                'label_attr' => [
                    'class' => 'form-label mt-4 '
                ],
                'choice_label' => 'title',
                'multiple' => false,
                'expanded' => true,
                'attr' => [
                    'class' => 'd-flex justify-content-between',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Timecard1::class,
        ]);
    }
}