<?php

namespace App\Form;

use App\Entity\Child;
use App\Entity\Childsport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('cardnr', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Demander un numéro de carte à votre responsable ASDEC',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],

            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail du responsable de l\'enfant'
            ])   
            ->add('parentname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Nom du réprésentant légal de l\'enfant',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])  
            ->add('parentfirstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Prénom du réprésentant légal de l\'enfant',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])       

            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],
                'label' => 'Nom de l\'enfant',
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
                'label' => 'Prénom de l\'enfant',
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
           
            
            ->add('isMedical', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input ms-4 mt-4',
                ],
                'required' => false,
                'label' => 'En tant qu\'adulte, je déclare être responsable de cet(te) enfant et certifie sur l\'honneur avoir en ma possession son certificat médical récent.',
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
                'label' => 'Année de son certificat médical',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                
            ])
            ->add('my_file', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Télécharger une photo de l\'enfant.',
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

            ])

            ->add('sports', EntityType::class, [
                'class' => Childsport::class,                
                'label' => 'Les activités',
                'label_attr' => [
                    'class' => 'form-label mt-4 '
                ],
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'd-flex justify-content-between',
                ],
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
            'data_class' => Child::class,
        ]);
    }
}