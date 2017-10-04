<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Validator;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\FormTypesBundle\Form\Model\DateRange;

/**
 * Class DateRangeValidator
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Validator
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DateRangeValidator implements DateRangeValidatorInterface
{

    /** @var array */
    protected $options = [];

    /** @var OptionsResolver */
    protected $resolver;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
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
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_end_in_past' => true,
            'allow_single_day'  => true,
        ]);

        $resolver->setAllowedTypes('allow_end_in_past', ['boolean']);
        $resolver->setAllowedTypes('allow_single_day', ['boolean']);
    }

    /**
     * @param FormEvent $event
     */
    public function onPostSubmit(FormEvent $event)
    {
        $form = $event->getForm();

        /* @var $dateRange DateRange */
        $dateRange = $form->getNormData();

        if (!$dateRange->getStart() || !$dateRange->getEnd()) {
            return;
        }

        if ($dateRange->getStart() > $dateRange->getEnd()) {
            $form->addError(new FormError('date_range.invalid.end_before_start'));
        }

        if (!$this->options['allow_single_day'] and ($dateRange->getStart()->format('Y-m-d') === $dateRange->getEnd()->format('Y-m-d'))) {
            $form->addError(new FormError('date_range.invalid.single_day'));
        }

        if (!$this->options['allow_end_in_past'] and ($dateRange->getEnd() < new \DateTime())) {
            $form->addError(new FormError('date_range.invalid.end_in_past'));
        }
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SUBMIT => 'onPostSubmit',
        ];
    }
} 