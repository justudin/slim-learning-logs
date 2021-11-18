<?php
declare(strict_types=1);

use DI\Container;

return function (Container $container) {
    // settings
    //development mode:  true, true, true
    //production mode: false, true, true
    $container->set('settings', function(){
        return [
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
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