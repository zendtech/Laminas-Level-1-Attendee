<?php
namespace Model\Adapter\Factory;

use Laminas\Db\Adapter\Adapter;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PrimaryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Adapter($container->get('model-primary-adapter-config'));
    }
}
