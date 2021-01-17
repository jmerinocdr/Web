<?php

namespace App\Form;

use App\Entity\Photo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Description')
            ->add('DateTime')
            ->add('Device')
            ->add('Opening')
            ->add('Speed')
            ->add('ISO')
            ->add('Latitude')
            ->add('Longitude')
            ->add('Favourite')
            ->add('Hidden')
            ->add('Archive')
            ->add('Keywords')
            ->add('albums')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
