<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuyNowForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class, [
                'attr' => [
                    'accept' => 'image/*',
                    '@change' => 'onChange'
                ]
            ])
            ->add('name', TextType::class, [
                'data' => $options['user']->getName(),
            ])
            ->add('phone_number', NumberType::class, [
                'data' => $options['user']->getPhoneNumber(),
            ])
            ->add('address', TextType::class, [
                'data' => $options['user']->getAddress(),
            ])
            ->add('city', TextType::class, [
                'data' => $options['user']->getCity(),
            ])
            ->add('postal_code', NumberType::class, [
                'data' => $options['user']->getPostalCode(),
            ])
            ->add('Buy', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-success',
                    'formnovalidate' => 'formnovalite'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user' => null
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_buy_now_form';
    }
}
