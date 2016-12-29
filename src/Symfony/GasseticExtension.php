<?php

namespace Gassetic\Bridge\Symfony;

use Gassetic\Bridge\Twig\GasseticExtension as TwigExtension;
use Gassetic\Metadata;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GasseticExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $metadataFactoryDef = new Definition(Metadata::class);
        $container->setDefinition('gassetic.metadata_factory', $metadataFactoryDef);

        $metadataDef = new Definition(Metadata::class, array($config['metadata_file'], $config['environment']));
        $metadataDef->setFactory(array($metadataFactoryDef, 'fromYamlFile'));
        $container->setDefinition('gassetic.metadata', $metadataDef);

        $container->setDefinition(
            'gassetic.twig_extension',
            new Definition(TwigExtension::class, array(new Reference('gassetic.metadata')))
        );
    }

    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration($container->getParameter('kernel.debug'));
    }
}
