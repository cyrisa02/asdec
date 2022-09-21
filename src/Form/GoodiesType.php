<?php

namespace App\Form;

use App\Entity\Goodies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GoodiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Dénomination',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('Price', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Prix de l\'article',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('Color', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Coloris',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('Size', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Taille de l\'article',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ])
            ->add('my_file', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Télécharger votre photo.',
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/*',
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Télécharger une image au bon format',
                    ])
                ],
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
     


            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Goodies::class,
        ]);
    }
}