<?php
declare(strict_types=1);

use Slim\App;
use Slim\Middleware\Session;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use App\Controller\ExceptionController;
use Slim\Views\TwigMiddleware;

return function (App $app){
    $container = $app->getContainer();

    $app->add(new Session);

    // Add Twig-View Middleware
    $twig_settings = $container->get('template_twig');
    $app->add(TwigMiddleware::create($app, $twig_settings));

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