<?php
use josegonzalez\Dotenv\Loader as Dotenv;
Dotenv::load([
    'filepath' => dirname(dirname(__DIR__)) . '/.env',
    'toEnv' => true
]);

preg_match("/(.*?):(.*)/", $_ENV['db_dsn'], $parts);
$type = $parts[1];
preg_match("/host=([^;]+)/",  $_ENV['db_dsn'], $parts);
$host = $parts[1];
preg_match("/dbname=([^;]+)/",  $_ENV['db_dsn'], $parts);
$dbName = $parts[1];

$default = [
    "adapter" => $type,
    "host" => $host,
    "name" => $dbName,
    "user" => $_ENV['db_user'],
    "pass" => $_ENV['db_password']
];
return [
    "paths" => [
        "migrations" => __DIR__
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "default",
        "default" => $default,
        "test" => [
                "name" => $dbName . '_test'
            ] + $default
    ]
];
