<?php
namespace Market;

use Market\Controller\{Factory\IndexControllerFactory,
    Factory\PostControllerFactory,
    Factory\ViewControllerFactory,
    IndexController,
    PostController,
    ViewController
};
use Market\Listener\{
    CacheAggregate,
    Factory\CacheAggregateFactory
};
use Market\Form\Factory\{PostFormFilterFactory, PostFormFactory};
use Market\Form\{DeleteForm, DeleteFormFilter, PostFormFilter, PostForm};
use Market\Helper\{LeftLinks, UnescapedLabel};
use Laminas\Router\Http\{Literal, Segment};
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'market' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/market',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'post' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/post[/]',
                            'defaults' => [
                                'controller' => PostController::class,
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'lookup' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/lookup[/]',
                                    'defaults' => [
                                        'action'     => 'lookup',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'view' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/view',
                            'defaults' => [
                                'controller' => ViewController::class,
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'slash' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/',
                                ],
                            ],
                            'category' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/category[/:category]',
                                    'constraints' => [
                                        'category' => '[A-Za-z0-9]*',
                                    ],
                                    'defaults' => [
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                            'item' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/item[/:itemId]',
                                    'constraints' => [
                                        'itemId' => '[0-9]*',
                                    ],
                                    'defaults' => [
                                        'action'     => 'item',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'services' => [],
        'factories' => [
            PostForm::class => PostFormFactory::class,
            PostFormFilter::class => PostFormFilterFactory::class,
            DeleteForm::class => InvokableFactory::class,
            DeleteFormFilter::class => InvokableFactory::class
        ],
        'listeners' => [
            CacheAggregate::class => CacheAggregateFactory::class
        ]
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class,
            ViewController::class => ViewControllerFactory::class,
            PostController::class => PostControllerFactory::class,
        ],
    ],
    'view_manager' => [
      'template_path_stack' => [__DIR__ . '/../view'],
    ],
    'view_helpers' => [
        'factories' => [
            LeftLinks::class => InvokableFactory::class,
            UnescapedLabel::class => InvokableFactory::class,
        ],
        'aliases' => [
            'leftLinks' => LeftLinks::class,
            'unescapedLabel' => UnescapedLabel::class,
        ],
    ],
];
