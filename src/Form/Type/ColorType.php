<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ColorType
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Type
 * @author  Nikita Loges
 * @date    10.12.2014
 */
class ColorType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return TextType::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'color';
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return $this->getName();
    }
} 