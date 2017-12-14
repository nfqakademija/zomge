<?php

namespace AppBundle\Form;

use AppBundle\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BuyNowStepOneForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo', FileType::class, [
                'label' => 'Picture',
                'attr'  => [
                    'accept'  => 'image/*',
                    '@change' => 'onChange'
                ],
                /*'constraints' => [
                    new File([
                        'maxSize' => '2M'
                    ])
                */
            ])
            ->add('backPanel', ChoiceType::class, [
                'choices' => [
                    'Plastic (+0€)' => 'plastic',
                    'Metal (+50€)'  => 'metal',
                    'Glass (+100€)' => 'glass'
                ]
            ])
            ->add('Next', SubmitType::class, [
                'attr' => [
                    'class'          => 'btn-success',
                    'formnovalidate' => 'formnovalide'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Orders::class,
            'validation_groups' => [
                'buy'
            ],
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_buy_now_step_one_form';
    }
}
