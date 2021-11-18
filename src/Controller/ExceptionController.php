<?php

namespace App\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response;

class ExceptionController extends BaseController
{
    public function notFound(Request $request)
    {
        $response = new Response();
        $response = $response->withStatus(404);
        return $this->render($response, '404-error.html');
    }

    public function notAllowed(Request $request)
    {
        $response = new Response();
        $response = $response->withStatus(405);
        return $this->render($response, '405-not-allowed.html');
    }
}