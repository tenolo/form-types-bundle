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
        /** @var $resolver OptionsResolver */
        $resolver->setDefault('gender_type', 'salutation');
        $resolver->setAllowedTypes('gender_type', ['null', 'string']);
        $resolver->setAllowedValues('gender_type', [null, 'gender', 'salutation']);

        $resolver->setDefaults([
            'value_female'      => 'female',
            'value_male'        => 'male',
            'label_female'      => 'Frau',
            'label_male'        => 'Herr',
            'choices_as_values' => true
        ]);
        $resolver->setAllowedTypes('value_female', 'string');
        $resolver->setAllowedTypes('value_male', 'string');
        $resolver->setAllowedTypes('label_female', 'string');
        $resolver->setAllowedTypes('label_male', 'string');

        $resolver->setDefault('choices', function (Options $options) {
            switch ($options['gender_type']) {
                case 'salutation':
                    return [
                        'Herr' => $options['value_male'],
                        'Frau' => $options['value_female'],
                    ];
                    break;
                case 'gender':
                    return [
                        'männlich' => $options['value_male'],
                        'weiblich' => $options['value_female'],
                    ];
                    break;
            }

            return [
                $options['label_female'] => $options['value_female'],
                $options['label_male']   => $options['value_male'],
            ];
        });

        $resolver->setDefaults([
            'expanded' => true
        ]);
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