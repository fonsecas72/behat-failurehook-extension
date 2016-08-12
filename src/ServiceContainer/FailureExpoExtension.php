<?php

namespace Fonsecas72\FailureExpoExtension\ServiceContainer;

use Behat\Testwork\EventDispatcher\ServiceContainer\EventDispatcherExtension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Behat\Testwork\ServiceContainer\Extension;
use Symfony\Component\DependencyInjection\Reference;
use Behat\MinkExtension\ServiceContainer\MinkExtension;

class FailureExpoExtension implements Extension
{

    public function load(ContainerBuilder $container, array $config)
    {
        $definition = new Definition('Fonsecas72\FailureExpoExtension\FailureExpoListener', array(
            new Reference(MinkExtension::MINK_ID),
            '%failure_expo.expounds%',
        ));
        $definition->addTag(EventDispatcherExtension::SUBSCRIBER_TAG, array('priority' => 0));
        $container->setDefinition('mink.listener.failure_expo', $definition);
        $container->setParameter('failure_expo.expounds', $config);
    }

    public function getConfigKey()
    {
        return 'failure_expo';
    }

    public function configure(ArrayNodeDefinition $builder)
    {
        $builder
            ->children()
                ->arrayNode('expounds')
                    ->defaultValue(array())
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ;
    }

    public function initialize(ExtensionManager $extensionManager){}
    public function process(ContainerBuilder $container){}
}
