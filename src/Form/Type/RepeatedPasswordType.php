<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RepeatedPasswordType
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Type
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class RepeatedPasswordType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'type'            => PasswordType::class,
            'options'         => [],
            'invalid_message' => 'Die eingegebenen Passwörter müssen übereinstimmen.',
            'constraints'     => [
                new Assert\NotBlank()
            ],
            'first_options'   => [
                'label' => 'Passwort',
                'attr'  => [
                    'help_text' => 'Geben Sie ein Passwort ein.'
                ]
            ],
            'second_options'  => [
                'label' => 'Passwort wiederholen',
                'attr'  => [
                    'help_text' => 'Zur Sicherheit bitten wir Sie, das Passwort nochmal zu wiederholen.'
                ]
            ]
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