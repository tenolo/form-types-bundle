<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Interface DateRangeViewTransformerInterface
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\DataTransformer
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface DateRangeViewTransformerInterface extends DataTransformerInterface
{

    /**
     * @param array $options
     */
    public function setOptions(array $options);
}
