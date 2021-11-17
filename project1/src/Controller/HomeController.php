<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class HomeController
{
    private $ci;

    public function __construct($ci)
    {
        $this->ci = $ci;
    }

    public function homepage(Request $request, Response $response)
    {
        $html = $this->ci->get('template')->render('homepage.html');
        $response->getBody()->write($html);
        return $response;
    }
}