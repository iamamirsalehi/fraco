<?php

namespace App\Core\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

class MigrationBaseClass extends AbstractMigration
{
    public $capsule;
    public $schema;

    public function init()
    {
        $this->capsule = new Capsule;
/*        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => DB_HOST,
//            'port' => DBConfig::PORT,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);*/

        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => DBConfig::HOST,
//            'port' => DBConfig::PORT,
            'database' => DBConfig::NAME,
            'username' => DBConfig::USER,
            'password' => DBConfig::PASSWORD,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}