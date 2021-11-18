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
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app){

    $app->get('/', [HomeController::class, 'homepage'])->setName('homepage');
    $app->get('/hello/{name}', [HomeController::class,'hello'])->setName('hello');
    $app->get('/albums', [SearchController::class,'default'])->setName('albums');
    $app->get('/search', [SearchController::class,'search'])->setName('search');;
    $app->get('/form', [SearchController::class,'form'])->setName('form');;
    $app->post('/form', [SearchController::class,'form'])->setName('form');;
    $app->get('/api', [ApiController::class, 'search'])->setName('apisearch');
    $app->get('/shop', [ShopController::class, 'default'])->setName('shop');
    $app->get('/shop/details/{id:[0-9]+}', [ShopController::class, 'details'])->setName('shopdetails');
    $app->get('/login', [AuthController::class, 'login'])->setName('login');
    $app->post('/login', [AuthController::class, 'loginAction'])->setName('loginAction');;
    $app->post('/logout', [AuthController::class, 'logoutAction'])->setName('logout');

    $app->group('/dashboard', function(Group $group){
        $group->get('', [DashboardController::class, 'default'])->setName('dashboard');
        $group->get('/membership', [DashboardController::class, 'membership'])->setName('membership');
    })->add(new AuthMiddleware($app->getContainer()->get('session')));

};