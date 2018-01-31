<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RepeatedEmailType
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Type
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class RepeatedEmailType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'type'           => EmailType::class,
            'options'        => [],
            'first_options'  => [
                'label' => 'E-Mail',
                'attr'  => [
                    'help_text' => 'Ihre aktuelle E-Mail-Adresse.'
                ]
            ],
            'second_options' => [
                'label' => 'E-Mail wiederholen',
                'attr'  => [
                    'help_text' => 'Um sicher zu gehen, dass die E-Mail-Adresse korrekt ist, bestätigen Sie diese bitte.'
                ]
            ],
            'constraints'    => [
                new Assert\NotBlank(),
                new Assert\Email()
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return RepeatedType::class;
    }
}
