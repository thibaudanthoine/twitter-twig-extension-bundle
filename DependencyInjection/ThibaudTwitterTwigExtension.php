<?php

namespace Thibaud\TwitterTwigExtensionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ThibaudTwitterTwigExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if ($config['enabled']) {
            if (empty($config['buttons'])) {
                throw new \RuntimeException('Unable to find Twitter twig extension bundle configuration');
            }

            $container->setParameter('twitter_twig_extension.lang', $config['lang']);
            $container->setParameter('twitter_twig_extension.large', $config['large']);
            $container->setParameter('twitter_twig_extension.buttons', $config['buttons']);

            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('twig.xml');
        }
    }
}
