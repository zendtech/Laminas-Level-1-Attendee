<?php
namespace Market\Form\Factory;

use Market\Form\PostFormFilter;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PostFormFilterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PostFormFilter(
            $container->get('application-categories'),
            $container->get('expire-days')
        );
    }
}
