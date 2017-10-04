<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Environment;

/**
 * Class FormSuccessSubscriber
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class FormSuccessSubscriber implements FormSuccessSubscriberInterface
{

    /** @var Environment */
    protected $twig;

    /** @var FlashBagInterface */
    protected $flashBag;

    /**
     * @param Environment $twig
     * @param             $flashBag
     */
    public function __construct(Environment $twig, FlashBagInterface $flashBag)
    {
        $this->twig = $twig;
        $this->flashBag = $flashBag;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SUBMIT => 'handleSuccess',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function handleSuccess(FormEvent $event)
    {
        $form = $event->getForm();

        $builder = $form->getConfig();
        $options = $builder->getOptions();

        // get all errors
        $errorsAll = $form->getErrors(true);

        // show error messages
        if (!count($errorsAll)) {
            if ($options['form_success_template'] !== false) {
                $this->addFlashBagMessage('success', $options['form_success_template'], [
                    'message' => $options['form_success_message'],
                    'data'    => $event->getData()
                ]);
            } else {
                $this->flashBag->add('success', $options['form_success_message']);
            }
        }
    }

    /**
     * @param       $type
     * @param       $message
     * @param array $templateVars
     */
    protected function addFlashBagMessage($type, $message, $templateVars = [])
    {
        // render flash message, using twig
        $message = $this->twig->render($message, $templateVars);

        // add to flashbag
        $this->flashBag->add($type, $message);
    }
}