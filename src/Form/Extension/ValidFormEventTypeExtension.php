<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Tenolo\Bundle\FormTypesBundle\Form\EventListener\PropagateValidFormEventSubscriber;

/**
 * Class ValidFormEventTypeExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ValidFormEventTypeExtension extends AbstractTypeExtension
{

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new PropagateValidFormEventSubscriber());
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return FormType::class;
    }
}