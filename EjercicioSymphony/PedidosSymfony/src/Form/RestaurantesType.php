<?php

namespace App\Form;

use App\Entity\Restaurantes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CodRes')
            ->add('Correo')
            ->add('Clave')
            ->add('CP')
            ->add('Ciudad')
            ->add('Direccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurantes::class,
        ]);
    }
}
