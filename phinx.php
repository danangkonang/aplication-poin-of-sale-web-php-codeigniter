<?php

include_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
  'paths' => [
    'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
    'seeds'      => '%%PHINX_CONFIG_DIR%%/db/seeds',
  ],
  'environments' => [
    'default_migration_table' => 'phinxlog',
    'default_environment'     => 'development',
    'production'              => [
      'adapter' => 'mysql',
      'host'    => $_ENV['DB_HOSTNAME'] ?? 'localhost',
      'name'    => $_ENV['DB_DATABASE'] ?? 'mydb',
      'user'    => $_ENV['DB_USERNAME'] ?? 'root',
      'pass'    => $_ENV['DB_PASSWORD'] ?? '',
      'port'    => $_ENV['DB_PORT'] ?? '3306',
      'charset' => 'utf8',
    ],
    'development' => [
      'adapter' => 'mysql',
      'host'    => $_ENV['DB_HOSTNAME'] ?? 'localhost',
      'name'    => $_ENV['DB_DATABASE'] ?? 'mydb',
      'user'    => $_ENV['DB_USERNAME'] ?? 'root',
      'pass'    => $_ENV['DB_PASSWORD'] ?? '',
      'port'    => $_ENV['DB_PORT'] ?? '3306',
      'charset' => 'utf8',
    ],
    'testing' => [
      'adapter' => 'mysql',
      'host'    => $_ENV['DB_HOSTNAME'] ?? 'localhost',
      'name'    => $_ENV['DB_DATABASE'] ?? 'mydb',
      'user'    => $_ENV['DB_USERNAME'] ?? 'root',
      'pass'    => $_ENV['DB_PASSWORD'] ?? '',
      'port'    => $_ENV['DB_PORT'] ?? '3306',
      'charset' => 'utf8',
    ],
  ],
  'version_order' => 'creation',
];
