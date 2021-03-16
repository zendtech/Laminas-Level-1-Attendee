<?php
namespace Events;

use Events\Controller\{
    AdminController,
    IndexController,
    SignupController
};
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Filter;
use Events\Model\{
    RegistrationTable,
    AttendeeTable,
    EventTable
};
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * This is an example of an alternate way to factory construct controllers
     * @return array
     */
    public function getControllerConfig()
    {
        return [
            'factories' => [
                IndexController::class => InvokableFactory::class,
                AdminController::class  => function ($container, $requestedName) {
                    return new $requestedName(
                        $container->get(EventTable::class),
                        $container->get(RegistrationTable::class)
                    );
                },
                SignupController::class => function ($container, $requestedName) {
                    return new $requestedName(
                        $container->get(EventTable::class),
                        $container->get(RegistrationTable::class),
                        $container->get(AttendeeTable::class)
                    );
                },
            ],
        ];
    }
    public function getServiceConfig()
    {
        return [
            'aliases' => [
                'events-db-adapter' => 'model-primary-adapter',
            ],
            'factories' => [
                'events-reg-data-filter' => function ($sm) {
                    $filter = new Filter\FilterChain();
                    $filter->attach(new Filter\StringTrim())
                           ->attach(new Filter\StripTags());
                    return $filter;
                },
                Model\EventTable::class => function ($container, $requestedName) {
                    $table = new $requestedName();
                    $table->setTableGateway($container->get('events-db-adapter'));
                    return $table;
                },
                Model\RegistrationTable::class => function ($container, $requestedName) {
                    $table = new $requestedName();
                    $table->setTableGateway($container->get('events-db-adapter'));
                    return $table;
                },
                Model\AttendeeTable::class => function ($container, $requestedName) {
                    $table = new $requestedName();
                    $table->setTableGateway($container->get('events-db-adapter'));
                    return $table;
                },
            ],
        ];
    }
}

