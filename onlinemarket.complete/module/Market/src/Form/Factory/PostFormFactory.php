<?php
namespace Market\Form\Factory;

use Market\Form\ {PostForm, PostFormFilter};
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PostFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PostForm(
            $container->get('application-categories'),
            $container->get('expire-days'),
            $container->get('captcha-options'),
            $container->get(PostFormFilter::class)
        );
    }
}