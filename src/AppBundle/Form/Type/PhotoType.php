<?php

namespace AppBundle\Form;

use AppBundle\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('picture', FileType::class, [
            'attr' => [
                'accept'  => 'image/*',
                '@change' => 'onChange'
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Orders::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_photo_type';
    }
}
