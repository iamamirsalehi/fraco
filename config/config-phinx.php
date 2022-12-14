<?php

use App\Core\Migration\DBConfig;

return [
    'paths' => [
        'migrations' => 'migrations'
    ],
    'migration_base_class' => 'App\Core\Migration\MigrationBaseClass',
    'environments' => [
        'default_migration_table' => 'migration_log',
        'dev' => [
            'adapter' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS'],
//            'port' => DB_PORT
        ]
    ]
];