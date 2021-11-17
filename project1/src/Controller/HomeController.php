<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class HomeController extends BaseController
{
    public function homepage(Request $request, Response $response): Response
    {
        return $this->render($response, 'frontend/homepage.html');
    }
}