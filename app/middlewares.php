<?php
declare(strict_types=1);

use Slim\App;
use Slim\Middleware\Session;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use App\Controller\ExceptionController;
use Slim\Views\TwigMiddleware;
use Slim\Exception\HttpMethodNotAllowedException;

return function (App $app){
    $container = $app->getContainer();

    $app->add(new Session);

    // Add Twig-View Middleware
    $twig_settings = $container->get('template_twig');
    $app->add(TwigMiddleware::create($app, $twig_settings));

    $settings = $container->get('settings');
    $errorMiddleware = $app->addErrorMiddleware($settings['displayErrorDetails'], $settings['logErrorDetails'], $settings['logErrors']);

    //custom 404 error template
    $errorMiddleware->setErrorHandler(
        HttpNotFoundException::class,
        function(ServerRequestInterface $request) use ($container){
            $exceptionController = new ExceptionController($container);
            return $exceptionController->notFound($request);
        }
    );

    //custom 405 error template
    $errorMiddleware->setErrorHandler(
        HttpMethodNotAllowedException::class,
        function(ServerRequestInterface $request) use ($container){
            $exceptionController = new ExceptionController($container);
            return $exceptionController->notAllowed($request);
        }
    );
};