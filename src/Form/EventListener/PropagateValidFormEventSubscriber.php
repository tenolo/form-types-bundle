<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormInterface;
use Tenolo\Bundle\FormTypesBundle\Event\ValidFormEvent;

/**
 * Class PropagateValidFormEventSubscriber
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class PropagateValidFormEventSubscriber implements EventSubscriberInterface
{

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            ValidFormEvent::NAME => 'onValidForm',
        ];
    }

    /**
     * @param ValidFormEvent $event
     */
    public function onValidForm(ValidFormEvent $event)
    {
        $form = $event->getForm();

        foreach ($form as $child) {
            /** @var $child FormInterface */
            $childEventDispatcher = $child->getConfig()->getEventDispatcher();

            if ($childEventDispatcher) {
                $childEventDispatcher->dispatch(ValidFormEvent::NAME, new ValidFormEvent($child));
            }
        }
    }
}