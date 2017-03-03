<?php

namespace AppBundle;

use AppBundle\DependencyInjection\DictionaryLoaderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $containerBuilder)
    {
        $containerBuilder->addCompilerPass(new DictionaryLoaderPass());
    }
}
