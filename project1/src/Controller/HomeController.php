<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class HomeController
{
    private ContainerInterface $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function homepage(Request $request, Response $response): Response
    {
        $html = $this->ci->get('template')->render('frontend/homepage.html');
        $response->getBody()->write($html);
        return $response;
    }
}