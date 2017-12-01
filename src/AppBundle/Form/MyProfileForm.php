<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyProfileForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('phoneNumber', NumberType::class)
            ->add('address', TextType::class)
            ->add('city', TextType::class)
            ->add('postalCode', NumberType::class)
            ->add('Update', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-success',
                    'formnovalidate' => 'formnovalide'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
            'validation_groups' => ['user'],
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_my_profile_form';
    }
}
