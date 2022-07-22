<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Director;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Titre du film'
                ]
            ])
            ->add('releasedAt', DateType::class,[
                'widget' => 'single_text',
                'label' => 'Date de sortie',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Date de sortie'
                ]
            ])
            
            ->add('duration', IntegerType::class, [
                'label' => 'Durée',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Durée du film en minutes'
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Description du film'
                ]
            ])
            ->add('imageUrl', TextType::class, [
                'label' => 'Url de l\'image',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Url de l\'image'
                ]
            ])
            ->add('director', EntityType::class, [
                'class' => Director::class,
                'choice_label' => 'lastName',
                'label' => 'Réalisateur',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Choisir un réalisateur'
                ]
            ])
            ->add('actors' , EntityType::class, [
                'class' => Actor::class,
                'choice_label' => 'lastName',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Acteurs',
                'required' => true,
                'by_reference' => false,
                'attr' => [
                    'placeholder' => 'Choisir un ou plusieurs acteurs'
                ]

            ])
            ->add('categories' , EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
                'placeholder' => 'Choisir un genre',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
