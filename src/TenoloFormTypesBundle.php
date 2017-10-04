<?php

namespace Tenolo\Bundle\FormTypesBundle;

use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
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
        ];
    }
}
