<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Environment;

/**
 * Class FormErrorSubscriber
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class FormErrorSubscriber implements FormErrorSubscriberInterface
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
            FormEvents::POST_SUBMIT => 'handleErrors',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function handleErrors(FormEvent $event)
    {
        $form = $event->getForm();

        // get all errors
        $errorsAll = $form->getErrors(true);

        // show error messages
        if (count($errorsAll)) {
            $this->addFlashBagMessage('error', '@TenoloFormTypes/Error/error.html.twig', [
                'errors' => $errorsAll
            ]);
        }
    }

    /**
     * @param       $type
     * @param       $message
     * @param array $templateVars
     */
    protected function addFlashBagMessage($type, $message, $templateVars = [])
    {
        $message = $this->twig->render($message, $templateVars);

        $this->flashBag->add($type, $message);
    }
}