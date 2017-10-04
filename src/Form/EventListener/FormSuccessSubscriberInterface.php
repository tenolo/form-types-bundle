<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;

/**
 * Interface FormSuccessSubscriberInterface
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface FormSuccessSubscriberInterface extends EventSubscriberInterface
{

    /**
     * @param FormEvent $event
     */
    public function handleSuccess(FormEvent $event);
}
