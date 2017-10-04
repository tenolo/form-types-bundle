<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\FormTypesBundle\Form\DataTransformer\DateRangeViewTransformer;
use Tenolo\Bundle\FormTypesBundle\Form\DataTransformer\DateRangeViewTransformerInterface;
use Tenolo\Bundle\FormTypesBundle\Form\Model\DateRange;
use Tenolo\Bundle\FormTypesBundle\Form\Model\DateRangeInterface;
use Tenolo\Bundle\FormTypesBundle\Form\Validator\DateRangeValidatorInterface;

/**
 * Class DateRangeType
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Type
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DateRangeType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('start_date', DateTimeType::class, $options['start_options']);
        $builder->add('end_date', DateTimeType::class, $options['end_options']);

        if (!is_null($options['transformer'])) {
            $builder->addViewTransformer($options['transformer']);
        }

        if (!is_null($options['validator'])) {
            $builder->addEventSubscriber($options['validator']);
        }
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class'          => DateRange::class,
            'start_options'       => [],
            'end_options'         => [],
            'transformer_options' => [],
            'validator_options'   => [],
            'transformer'         => new DateRangeViewTransformer(),
            'validator'           => null,
        ]);

        $resolver->setAllowedTypes('data_class', [DateRangeInterface::class]);
        $resolver->setAllowedTypes('transformer', [DateRangeViewTransformerInterface::class, 'null']);
        $resolver->setAllowedTypes('validator', [DateRangeValidatorInterface::class, 'null']);
        $resolver->setAllowedTypes('start_options', ['array']);
        $resolver->setAllowedTypes('end_options', ['array']);
        $resolver->setAllowedTypes('transformer_options', ['array']);
        $resolver->setAllowedTypes('validator_options', ['array']);

        $resolver->setNormalizer('transformer', function (Options $options, $value) {
            /** @var DateRangeViewTransformerInterface|null $value */
            if (!is_null($value)) {
                $value->setOptions($options['transformer_options']);
            }

            return $value;
        });

        $resolver->setNormalizer('validator', function (Options $options, $value) {
            /** @var DateRangeValidatorInterface|null $value */
            if (!is_null($value)) {
                $value->setOptions($options['validator_options']);
            }

            return $value;
        });

        $resolver->setNormalizer('start_options', function (Options $options, $value) {
            $value = array_merge_recursive([
                'label'          => 'Anfangsdatum',
                'property_path'  => 'start',
                'widget'         => 'single_text',
                'format'         => 'yyyy-MM-dd',
                'model_timezone' => 'UTC',
                'view_timezone'  => 'UTC',
                'attr'           => [
                    'data-type' => 'start',
                ],
            ], $value);

            return $value;
        });

        $resolver->setNormalizer('end_options', function (Options $options, $value) {
            $value = array_merge_recursive([
                'label'          => 'Enddatum',
                'property_path'  => 'end',
                'widget'         => 'single_text',
                'format'         => 'yyyy-MM-dd',
                'model_timezone' => 'UTC',
                'view_timezone'  => 'UTC',
                'attr'           => [
                    'data-type' => 'end',
                ],
            ], $value);

            return $value;
        });
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'date_range';
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return $this->getName();
    }
} 