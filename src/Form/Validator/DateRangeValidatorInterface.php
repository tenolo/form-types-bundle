<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Validator;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Interface DateRangeValidatorInterface
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Validator
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface DateRangeValidatorInterface extends EventSubscriberInterface
{

    /**
     * @param array $options
     */
    public function setOptions(array $options);
}
