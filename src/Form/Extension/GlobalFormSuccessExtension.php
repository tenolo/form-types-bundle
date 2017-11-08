<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\FormTypesBundle\Form\EventListener\FormSuccessSubscriberInterface;

/**
 * Class FormSuccessExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class GlobalFormSuccessExtension extends AbstractTypeExtension
{

    /** @var FormSuccessSubscriberInterface */
    protected $defaultHandler;

    /**
     * @param FormSuccessSubscriberInterface $defaultHandler
     */
    public function __construct(FormSuccessSubscriberInterface $defaultHandler)
    {
        $this->defaultHandler = $defaultHandler;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (isset($options['form_success_handler']) && $options['form_success_handler'] !== false && $options['form_success_handler_enable']) {
            $builder->addEventSubscriber($options['form_success_handler']);
        }
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'form_success_handler_enable' => false,
            'form_success_template'       => false,
            'form_success_message'        => 'Die Daten wurden erfolgreich gespeichert.',
            'form_success_handler'        => $this->defaultHandler
        ]);

        // types
        $resolver->setAllowedTypes('form_success_message', ['string']);
        $resolver->setAllowedTypes('form_success_template', ['boolean', 'string']);
        $resolver->setAllowedTypes('form_success_handler_enable', ['boolean']);
        $resolver->setAllowedTypes('form_success_handler', [
            'null',
            'boolean',
            FormSuccessSubscriberInterface::class
        ]);

        // normalizer
        $resolver->setNormalizer('form_success_handler', function (Options $options, $value) {
            if ($value === false || $options['form_success_handler_enable'] === false) {
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
