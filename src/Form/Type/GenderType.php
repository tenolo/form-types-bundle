<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GenderType
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Type
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class GenderType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'gender_type'       => 'salutation',
            'divers_enable'     => false,
            'value_divers'      => 'divers',
            'value_female'      => 'female',
            'value_male'        => 'male',
            'label_divers'      => function (Options $options) {
                if ($options['gender_type'] === 'salutation') {
                    return 'Divers';
                }

                return 'divers';
            },
            'label_female'      => function (Options $options) {
                if ($options['gender_type'] === 'salutation') {
                    return 'Frau';
                }

                return 'weiblich';
            },
            'label_male'        => function (Options $options) {
                if ($options['gender_type'] === 'salutation') {
                    return 'Herr';
                }

                return 'männlich';
            },
            'choices_as_values' => true,
            'expanded'          => true,
            'required'          => false,
            'placeholder'       => function (Options $options) {
                if ($options['expanded'] === true) {
                    return 'keine Angabe';
                }

                return '';
            },
        ]);

        $resolver->setDefault('choices', function (Options $options) {
            $choices = [];

            $choices = [
                $options['label_female'] => $options['value_female'],
                $options['label_male']   => $options['value_male'],
            ];

            if ($options['divers_enable']) {
                $choices[$options['label_divers']] = $options['value_divers'];
            }


            return $choices;
        });

        $resolver->setAllowedTypes('divers_enable', 'bool');
        $resolver->setAllowedTypes('value_divers', 'string');
        $resolver->setAllowedTypes('value_female', 'string');
        $resolver->setAllowedTypes('value_male', 'string');
        $resolver->setAllowedTypes('label_divers', 'string');
        $resolver->setAllowedTypes('label_female', 'string');
        $resolver->setAllowedTypes('label_male', 'string');
        $resolver->setAllowedTypes('gender_type', ['null', 'string']);

        $resolver->setAllowedValues('gender_type', [null, 'gender', 'salutation']);

    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return ChoiceType::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'gender';
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix()
    {
        return $this->getName();
    }
} 