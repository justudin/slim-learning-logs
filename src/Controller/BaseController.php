<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

abstract class BaseController
{
    protected $view;
    protected $logger;
    protected $session;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get('template');
        $this->logger = $container->get('logger');
        $this->session = $container->get('session');
    }

    protected function render(Response $response, $templateFile, array $data = []): Response
    {
        $html = $this->view->render($templateFile, $data);
        $response->getBody()->write($html);
        return $response;
    }
}