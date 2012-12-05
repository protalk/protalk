<?php

namespace Protalk\MediaBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class MessageFilter implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('protalk.media_type.manager')) {
            return;
        }

        $definition = $container->getDefinition('protalk.media_type.manager');

        foreach ($container->findTaggedServiceIds('protalk.media_type.provider') as $id => $attributes) {
            $definition->addMethodCall('addProvider', array(new Reference($id), $attributes["alias"]));
        }
    }
}
