<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\DataTransformer;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\FormTypesBundle\Form\Model\DateRange;

/**
 * Class DateRangeViewTransformer
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\DataTransformer
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DateRangeViewTransformer implements DateRangeViewTransformerInterface
{

    /** @var array */
    protected $options = [];

    /** @var OptionsResolver */
    protected $resolver;

    /**
     *
     */
    public function __construct()
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->resolver = $resolver;
    }

    /**
     * @inheritdoc
     */
    public function setOptions(array $options)
    {
        $this->options = $this->resolver->resolve($options);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'include_end' => true,
        ]);

        $resolver->setAllowedTypes('include_end', ['boolean']);
    }

    /**
     * @inheritdoc
     */
    public function transform($value)
    {
        if (!$value) {
            return null;
        }

        if (!$value instanceof DateRange) {
            throw new UnexpectedTypeException($value, DateRange::class);
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return null;
        }

        if (!$value instanceof DateRange) {
            throw new UnexpectedTypeException($value, DateRange::class);
        }

        if ($this->options['include_end'] && $value->getEnd()) {
            $value->getEnd()->setTime(23, 59, 59);
        }

        return $value;
    }
} 