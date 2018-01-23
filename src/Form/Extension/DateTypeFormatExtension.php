<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * Class DateTypeFormatExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DateTypeFormatExtension extends AbstractTypeExtension
{

    /**
     * @inheritDoc
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['format'] = $options['format'];
    }

    /**
     * @inheritDoc
     */
    public function getExtendedType()
    {
        return DateType::class;
    }

}
