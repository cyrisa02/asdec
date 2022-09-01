<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationMemberFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            ->add('birthdate', BirthdayType::class, [
                'placeholder' => [
        'year' => 'Année',  'day' => 'Jour','month' => 'Mois'
    ],
                
                'label' => 'Date de naissance',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                'format' => 'dd-MM-yyyy',
                
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

            ->add('isMedical', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input mt-4',
                ],
                'required' => false,
                'label' => 'Je certifie sur l\'honneur avoir en ma possession un certificat médical de non-contre-indication de l\'activité ou des activités de moins de 3 ans lors de l\'inscription.',
                'label_attr' => [
                    'class' => 'form-check-label mt-4'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Etes-vous d\'accord avec notre RGPD ?',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez être d\'accord avec nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                'class' => 'form-control'                
            ],
             'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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