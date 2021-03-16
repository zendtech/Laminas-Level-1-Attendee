<?php
namespace Market\Controller\Factory;

use Market\Form\PostForm;
use Model\Table\ListingsTable;
use Market\Controller\PostController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PostControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PostController(
            $container->get(ListingsTable::class),
            $container->get(PostForm::class));
    }
}
