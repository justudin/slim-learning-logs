<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends BaseController
{
    public function homepage(Request $request, Response $response): Response
    {
        return $this->render($response, 'frontend/homepage.html');
    }

    public function hello(Request $request, Response $response, array $args = []): Response
    {
        return $this->render($response, 'frontend/hello.html', ['name'=> ucfirst($args['name'])]);
    }
}