<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminSetOrderStatusForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Accepted'  => 1,
                    'Shipped'   => 2,
                    'Fulfilled' => 3
                ]
            ])
            ->add('Change', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-success',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => 'AppBundle\Entity\Orders',
            'validation_groups' => ['set_status']
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_admin_set_order_status_form';
    }
}
