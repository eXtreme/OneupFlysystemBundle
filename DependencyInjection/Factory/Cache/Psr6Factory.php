<?php

namespace Oneup\FlysystemBundle\DependencyInjection\Factory\Cache;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Oneup\FlysystemBundle\DependencyInjection\Factory\CacheFactoryInterface;

class Psr6Factory implements CacheFactoryInterface
{
    public function getKey()
    {
        return 'psr6';
    }

    public function create(ContainerBuilder $container, $id, array $config)
    {
        $container
            ->setDefinition($id, new DefinitionDecorator('oneup_flysystem.cache.psr6'))
            ->replaceArgument(0, new Reference($config['pool']))
            ->replaceArgument(1, $config['key'])
            ->replaceArgument(2, $config['expires'])
        ;
    }

    public function addConfiguration(NodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('pool')->isRequired()->end()
                ->scalarNode('key')->defaultValue('flysystem')->end()
                ->scalarNode('expires')->defaultValue(300)->end()
            ->end()
        ;
    }
}
