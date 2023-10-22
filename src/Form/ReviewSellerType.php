<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewSellerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class , [
                'label' => 'Votre avis',
                'attr' => [
                    'placeholder' => 'Votre avis nous intéresse !',
                    'class' => 'form form-control rounded',
                ],
                'required' => true
            ])
            ->add('stars', HiddenType::class, [
                'label' => 'Votre note',
                'required' => true,
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'step' => 1
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer mon avis',
                'attr' => [
                    'class' => 'gtm-vendre btn btn-square btn-green text-uppercase mt-2'
                ]
            ])
            ->setAction('/')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
