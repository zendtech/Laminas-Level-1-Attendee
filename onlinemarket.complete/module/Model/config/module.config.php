<?php
namespace Model;
use Model\Table\Factory\{CityCodesTableFactory, ListingsTableFactory};
use Model\Table\{ListingsTable, CityCodesTable};

return [
    'service_manager' => [
        'aliases' => [
            // NOTE: this configuration is overridden in the file /config/autoload/db.local.php
            'model-primary-adapter-config' => 'local-db-config',
        ],
        'factories' => [
            'model-primary-adapter'  => Adapter\Factory\PrimaryFactory::class,
            ListingsTable::class   => ListingsTableFactory::class,
            CityCodesTable::class => CityCodesTableFactory::class,
        ],
    ],
];
