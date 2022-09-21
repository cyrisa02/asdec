<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Sport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserEditSportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('sports', EntityType::class, [
                'class' => Sport::class,                
                'label' => 'Merci de sélectionner vos activités',
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

            ->add('isYoga', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input mt-4 ms-4',
                ],
                'required' => false,
                'label' => 'L\'adhérent(e) pratique le Yoga?',
                'label_attr' => [
                    'class' => 'form-check-label mt-4'
                ]
            ])
            ->add('isPilate', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input mt-4 ms-4',
                ],
                'required' => false,
                'label' => 'L\'adhérent(e) pratique le Pilates?',
                'label_attr' => [
                    'class' => 'form-check-label mt-4'
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