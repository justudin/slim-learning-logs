<?php
declare(strict_types=1);

use DI\Container;
use Monolog\Logger;

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

    //template engine
    $container->set('template', function (){
        return new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(
                __DIR__. '/../templates',
                ['extension' => '']
            )
        ]);
    });

    //session
    $container->set('session', function (){
        return new \SlimSession\Helper();
    });

};