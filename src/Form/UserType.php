<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'
            ])            
            //->add('password')
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Rue',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('zipcode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Code Postal',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Numéro de téléphone',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('Birthdate', BirthdayType::class, [
                'placeholder' => [
        'year' => 'Année',  'day' => 'Jour','month' => 'Mois'
    ],
                
                'label' => 'Date de naissance',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                'format' => 'dd-MM-yyyy',
                
            ])
            ->add('job', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Profession',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            

            ->add('isMedical', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input mt-4',
                ],
                'required' => false,
                'label' => 'Je certifie sur l\'honneur avoir en ma possession un certificat médical récent.',
                'label_attr' => [
                    'class' => 'form-check-label mt-4'
                ]
            ])

            ->add('certificatyear', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Année du certificat médical',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('isRegistered', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input mt-4',
                ],
                'required' => false,
                'label' => 'Ne cliquer sur cette case que pour une ré-inscription, DECLENCHE UN MAIL POUR L\'ASDEC???',
                'label_attr' => [
                    'class' => 'form-check-label mt-4'
                ]
            ])
            ->add('isValid', CheckboxType::class, [
                'attr' => [
                    'class' => 'd-none',
                ],
                'required' => false,
                'label' => '',
                'label_attr' => [
                    'class' => 'form-check-label'
                ]
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