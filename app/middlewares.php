<?php
declare(strict_types=1);

use Slim\App;
use Slim\Middleware\Session;
use DI\Container;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use App\Controller\ExceptionController;

return function (App $app, Container $container){

    $app->add(new Session);

    $settings = $app->getContainer()->get('settings');
    $errorMiddleware = $app->addErrorMiddleware($settings['displayErrorDetails'], $settings['logErrorDetails'], $settings['logErrors']);

    //custom error template
    $errorMiddleware->setErrorHandler(
        HttpNotFoundException::class,
        function(ServerRequestInterface $request) use ($container){
            $exceptionController = new ExceptionController($container);
            return $exceptionController->notFound($request);
        }
    );
};