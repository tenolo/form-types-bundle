<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;

/**
 * Interface FormErrorSubscriberInterface
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface FormErrorSubscriberInterface extends EventSubscriberInterface
{

    /**
     * @param FormEvent $event
     */
    public function handleErrors(FormEvent $event);
}
