<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BuyNowStepTwoForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('phoneNumber', TextType::class)
            ->add('address', TextType::class)
            ->add('city', TextType::class)
            ->add('postalCode', TextType::class)
            ->add('Place order', SubmitType::class, [
                'attr' => [
                    'class'          => 'btn-success',
                    'formnovalidate' => 'formnovalide'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => User::class,
            'validation_groups' => [
                'user'
            ],
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_buy_now_step_two_form';
    }
}
