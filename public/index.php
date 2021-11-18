<?php

use DI\Container;
use DI\Bridge\Slim\Bridge as AppFactory;

// Set the absolute path to the root directory.
$rootPath = realpath(__DIR__ . '/..');

require_once $rootPath . '/vendor/autoload.php';

$container =  new Container();

//use container_settings
$container_settings = require $rootPath.'/app/containers.php';
$container_settings($container);

//use logger
$logger = require $rootPath.'/app/logger.php';
$logger($container);

$app = AppFactory::create($container);

//use middleware
$middlewares = require $rootPath.'/app/middlewares.php';
$middlewares($app);

//use routes
$routes = require $rootPath.'/app/routes.php';
$routes($app);

//run this app!
$app->run();