<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DictionaryLoaderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('app.wordList')) {
            return;
        }
        $definition = $container->getDefinition('app.wordList');

        $loaders = $container->findTaggedServiceIds('hangman.loader');

        foreach ($loaders as $id => $attributes) {
            $definition->addMethodCall('addLoader', array(
                $attributes[0]['type'],
                new Reference($id)
            ));
        }

        //To call loadDictionaries after les addLoader
        $calls = $definition->getMethodCalls();
        $calls = array_reverse($calls);
        $definition->setMethodCalls($calls);

    }
}