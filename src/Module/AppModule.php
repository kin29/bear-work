<?php
namespace MyVendor\WellSaid\Module;

use BEAR\Package\PackageModule;
use josegonzalez\Dotenv\Loader as Dotenv;
use Ray\Di\AbstractModule;
use Ray\CakeDbModule\CakeDbModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = dirname(__DIR__, 2);
        Dotenv::load([
            'filepath' => $appDir . '/.env',
            'toEnv' => true
        ]);
        $this->install(new PackageModule);
        $dbConfig = [
            'driver' => 'Cake\Database\Driver\Sqlite',
            'database' => $appDir . '/db/said.sqlite3'
        ];
        $this->install(new CakeDbModule($dbConfig));

    }
}
