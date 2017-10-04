<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Extension;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ResolveTargetEntityExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ResolveTargetEntityExtension extends AbstractTypeExtension
{

    /** @var ManagerRegistry */
    protected $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'empty_data' => function (Options $options) {
                $class = $options['data_class'];

                if (null !== $class) {
                    return function (FormInterface $form) use ($class) {
                        $repo = $this->registry->getRepository($class);
                        $class = $repo->getClassName();

                        return $form->isEmpty() && !$form->isRequired() ? null : new $class();
                    };
                }

                return function (FormInterface $form) {
                    return $form->getConfig()->getCompound() ? [] : '';
                };
            }
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return FormType::class;
    }
}
