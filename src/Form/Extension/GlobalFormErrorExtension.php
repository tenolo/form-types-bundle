<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\FormTypesBundle\Form\EventListener\FormErrorSubscriberInterface;

/**
 * Class GlobalFormErrorExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class GlobalFormErrorExtension extends AbstractTypeExtension
{

    /** @var FormErrorSubscriberInterface */
    protected $defaultFormErrorHandler;

    /**
     * @param FormErrorSubscriberInterface $defaultFormErrorHandler
     */
    public function __construct(FormErrorSubscriberInterface $defaultFormErrorHandler)
    {
        $this->defaultFormErrorHandler = $defaultFormErrorHandler;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (isset($options['form_error_handler']) && $options['form_error_handler'] !== false && $options['form_error_handler_enable']) {
            $builder->addEventSubscriber($options['form_error_handler']);
        }
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'form_error_handler_enable' => false,
            'form_error_handler'        => $this->defaultFormErrorHandler
        ]);

        // types
        $resolver->setAllowedTypes('form_error_handler_enable', ['boolean']);
        $resolver->setAllowedTypes('form_error_handler', [
            'null',
            'boolean',
            FormErrorSubscriberInterface::class
        ]);

        // normalizer
        $resolver->setNormalizer('form_error_handler', function (Options $options, $value) {
            if ($value === false || $options['form_error_handler_enable'] === false) {
                return false;
            }

            return $value;
        });
    }

    /**
     * @inheritDoc
     */
    public function getExtendedType()
    {
        return FormType::class;
    }

}
