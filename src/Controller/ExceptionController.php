<?php

namespace App\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response;

class ExceptionController extends BaseController
{
    public function notFound(Request $request)
    {
        $response = new Response();
        return $this->render($response, 'frontend/404-error.html');
    }
}