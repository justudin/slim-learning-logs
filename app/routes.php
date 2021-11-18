<?php
declare(strict_types=1);

use Slim\App;
use App\Middleware\AuthMiddleware;
use App\Controller\HomeController;
use App\Controller\SearchController;
use App\Controller\ApiController;
use App\Controller\ShopController;
use App\Controller\AuthController;
use App\Controller\DashboardController;

return function (App $app){

    $app->get('/', [HomeController::class, 'homepage']);
    $app->get('/hello/{name}', [HomeController::class,'hello']);
    $app->get('/albums', [SearchController::class,'default']);
    $app->get('/search', [SearchController::class,'search']);
    $app->get('/form', [SearchController::class,'form']);
    $app->post('/form', [SearchController::class,'form']);
    $app->get('/api', [ApiController::class, 'search']);
    $app->get('/shop', [ShopController::class, 'default']);
    $app->get('/shop/details/{id:[0-9]+}', [ShopController::class, 'details']);
    $app->get('/login', [AuthController::class, 'login']);
    $app->post('/login', [AuthController::class, 'loginAction']);
    $app->post('/logout', [AuthController::class, 'logoutAction']);

    $app->group('/dashboard', function($app){
        $app->get('', [DashboardController::class, 'default']);
        $app->get('/membership', [DashboardController::class, 'membership']);
    })->add(new AuthMiddleware($app->getContainer()->get('session')));

};