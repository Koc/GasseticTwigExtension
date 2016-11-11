<?php

namespace Gassetic\Bridge\Symfony;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    private $debug;

    /**
     * @param bool $debug
     */
    public function __construct($debug)
    {
        $this->debug = $debug;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('gassetic');

        $rootNode
            ->children()
                ->scalarNode('environment')->defaultValue($this->debug ? 'dev' : 'prod')->cannotBeEmpty()->end()
                ->scalarNode('metadata_file')->defaultValue('var/gassetic_metadata.json')->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}
