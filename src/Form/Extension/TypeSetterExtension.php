<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class TypeSetterExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TypeSetterExtension extends AbstractTypeExtension
{
    /**
     * @inheritdoc
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (Kernel::VERSION_ID >= 30000) {
            $view->vars['original_type'] = $form->getConfig()->getType()->getBlockPrefix();
        } else {
            $view->vars['original_type'] = $form->getConfig()->getType()->getName();
        }
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return FormType::class;
    }
}
