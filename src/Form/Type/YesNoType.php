<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class YesNoType
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Type
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class YesNoType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices_as_values' => true,
            'choices'           => [
                'yes' => true,
                'no'  => false,
            ],
            'multiple'          => false,
            'expanded'          => true,
            'placeholder'       => false,
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
        return 'yes_no_choice';
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return $this->getName();
    }
}
