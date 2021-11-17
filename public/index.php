<?php

use Slim\Factory\AppFactory;
use DI\Container;
require __DIR__ . '/../vendor/autoload.php';

$container =  new Container();

$container->set('template', function (){
    return new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader(
            __DIR__. '/../templates',
            ['extension' => '']
        )
    ]);
});

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', '\App\Controller\HomeController:homepage');
$app->get('/hello/{name}', '\App\Controller\HomeController:hello');
$app->get('/albums', '\App\Controller\SearchController:default');
$app->get('/search', '\App\Controller\SearchController:search');
$app->get('/form', '\App\Controller\SearchController:form');
$app->post('/form', '\App\Controller\SearchController:form');
$app->get('/api', '\App\Controller\ApiController:search');
$app->run();