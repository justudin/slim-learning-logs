<?php

use DI\Container;
use DI\Bridge\Slim\Bridge as AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container =  new Container();

//use container_settings
$container_settings = require __DIR__.'/../app/containers.php';
$container_settings($container);

//use logger
$logger = require __DIR__.'/../app/logger.php';
$logger($container);

$app = AppFactory::create($container);

//use middleware
$middlewares = require __DIR__ . '/../app/middlewares.php';
$middlewares($app, $container);

//use routes
$routes = require  __DIR__.'/../app/routes.php';
$routes($app);

//run this app!
$app->run();