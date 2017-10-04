<?php

namespace Tenolo\Bundle\FormTypesBundle;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class TenoloFormTypesBundle
 *
 * @package Tenolo\Bundle\FormTypesBundle
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloFormTypesBundle extends Bundle implements DependentBundleInterface
{

    /**
     * @inheritDoc
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            FrameworkBundle::class,
            TwigBundle::class,
            DoctrineBundle::class,
        ];
    }
}
