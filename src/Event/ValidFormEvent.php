<?php

namespace Tenolo\Bundle\FormTypesBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\FormInterface;

/**
 * Class ValidFormEvent
 *
 * @package Tenolo\Bundle\FormTypesBundle\Event
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ValidFormEvent extends Event
{

    const NAME = 'form.valid';

    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form)
    {
        $this->form = $form;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->getForm()->getData();
    }
}