<?php

namespace App\Form;

use App\Entity\Kategoria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('nazwa_included', EntityType::class, [
                'multiple' => true,
                'expanded' => true,
                'class' => Kategoria::class,
                'label' => 'Kategoria Zawiera'
            ])
            ->add('nazwa_exclude', EntityType::class, [
                'multiple' => true,
                'expanded' => true,
                'class' => Kategoria::class,
                'label' => 'Kategoria Nie Zawiera'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}
