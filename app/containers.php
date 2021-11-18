<?php
declare(strict_types=1);

use DI\Container;
use Monolog\Logger;
use Slim\Views\Twig;

return function (Container $container) {
    // settings
    $container->set('settings', function(){

        //development mode:  true, true, true
        //production mode: false, false, true
        return [
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'logger' => [
                'name' => 'app-logger',
                'path' => __DIR__.'/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
        ];
    });

    //template engine twig
    $container->set('template_twig', function (){
        return Twig::create(
            __DIR__. '/../templates/frontend/twig',[
            'cache' => __DIR__ . '/../cache/templates/twig',
            'debug' => true,
            'auto_reload' => true
            ]);
    });

    //session
    $container->set('session', function (){
        return new \SlimSession\Helper();
    });

};