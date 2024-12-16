<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Continent;
use App\Entity\Famille;
use App\Entity\Zoo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('imageUrl')
            ->add('isDangerous')
            ->add('continent', EntityType::class, [
                'class' => Continent::class,
                'choice_label' => 'id',
            ])
            ->add('famille', EntityType::class, [
                'class' => Famille::class,
                'choice_label' => 'id',
            ])
            ->add('zoo', EntityType::class, [
                'class' => Zoo::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
