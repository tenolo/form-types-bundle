<?php

namespace Tenolo\Bundle\FormTypesBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class TenoloFormTypesExtension
 *
 * @package Tenolo\Bundle\FormTypesBundle\DependencyInjection
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloFormTypesExtension extends Extension implements PrependExtensionInterface
{

    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $locator = new FileLocator(__DIR__.'/../Resources/config');
        $loader = new Loader\YamlFileLoader($container, $locator);
        $loader->load('services.yml');
    }

    /**
     * @inheritdoc
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('twig', $this->getTwigConfig());
    }

    /**
     * @return array
     */
    protected function getTwigConfig()
    {
        return [
            'form_themes' => [
                'TenoloFormTypesBundle:Form:fields.html.twig',
            ],
        ];
    }

}
