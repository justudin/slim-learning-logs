<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends BaseController
{
    public function homepage(Response $response): Response
    {
        //$this->logger->info("just access homepage!");

        return $this->render($response, 'homepage.html');
    }

    public function hello(Response $response, $name): Response
    {
        return $this->render($response, 'hello.html', ['name'=> ucfirst($name)]);
    }
}