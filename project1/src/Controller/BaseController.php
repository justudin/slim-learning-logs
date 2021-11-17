<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

abstract class BaseController
{
    protected ContainerInterface $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    protected function render(Response $response, $templateFile, array $data = []): Response
    {
        $html = $this->ci->get('template')->render($templateFile, $data);
        $response->getBody()->write($html);
        return $response;
    }
}