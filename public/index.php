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
$app->get('/shop', '\App\Controller\ShopController:default');
$app->get('/shop/details/{id:[0-9]+}', '\App\Controller\ShopController:details');
$app->get('/login', '\App\Controller\AuthController:login');
$app->post('/login', '\App\Controller\AuthController:login');
$app->get('/dashboard', '\App\Controller\DashboardController:default');

//development mode:  true, true, true
//production mode: false, true, true
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

//custom error template
$errorMiddleware->setErrorHandler(
    Slim\Exception\HttpNotFoundException::class,
    function(\Psr\Http\Message\ServerRequestInterface $request) use ($container){
        $exceptionController = new App\Controller\ExceptionController($container);
        return $exceptionController->notFound($request);
    }
);

$app->run();