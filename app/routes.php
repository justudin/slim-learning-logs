<?php
declare(strict_types=1);

use Slim\App;
use App\Middleware\AuthMiddleware;

return function (App $app){

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
    $app->post('/login', '\App\Controller\AuthController:loginAction');
    $app->post('/logout', '\App\Controller\AuthController:logoutAction');

    $app->group('/dashboard', function($app){
        $app->get('', '\App\Controller\DashboardController:default');
        $app->get('/membership', '\App\Controller\DashboardController:membership');
    })->add(new AuthMiddleware($app->getContainer()->get('session')));

};