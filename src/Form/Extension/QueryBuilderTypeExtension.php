<?php

namespace Tenolo\Bundle\FormTypesBundle\Form\Extension;

use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class QueryBuilderTypeExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\Form\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class QueryBuilderTypeExtension extends AbstractTypeExtension
{

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setNormalizer('query_builder', function (Options $options, $queryBuilder) {
            if (is_callable($queryBuilder)) {
                $queryBuilder = call_user_func($queryBuilder, $options['em']->getRepository($options['class']), $options);

                if (null !== $queryBuilder && !$queryBuilder instanceof QueryBuilder) {
                    throw new UnexpectedTypeException($queryBuilder, QueryBuilder::class);
                }
            }

            return $queryBuilder;
        });
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return EntityType::class;
    }
}
