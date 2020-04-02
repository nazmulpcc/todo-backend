<?php

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/illuminate/support/helpers.php';

use App\Helpers\Config;
use Illuminate\Database\Capsule\Manager as DB;

define('BASEDIR', __DIR__);
define('START', microtime(true));

// Load Environment variables
$env = Dotenv\Dotenv::createImmutable(__DIR__);
$env->load();

Config::load(); // Load config files

// Initialize Eloquent ORM
$capsule = new DB;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => config('db.host'),
    'database'  => config('db.name'),
    'username'  => config('db.user'),
    'password'  => config('db.password'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();