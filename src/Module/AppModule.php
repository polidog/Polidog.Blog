<?php
namespace Polidog\Blog\Module;

use BEAR\Package\PackageModule;
use josegonzalez\Dotenv\Loader as Dotenv;
use Koriym\QueryLocator\QueryLocatorModule;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\Di\AbstractModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $rootDir = dirname(dirname(__DIR__));

        Dotenv::load([
            'filepath' => dirname(dirname(__DIR__)) . '/.env',
            'toEnv' => true
        ]);
        $this->install(new PackageModule);


        // Query Locator
        $this->install(new QueryLocatorModule($rootDir . '/var/sql'));

        // Databasde
        $this->install(new AuraSqlModule($_ENV['db_dsn']),$_ENV['db_user'], $_ENV['db_password']);

    }
}
