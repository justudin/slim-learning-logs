<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthMiddleware
{
    private \SlimSession\Helper $session;

    public function __construct(\SlimSession\Helper $session)
    {
        $this->session = $session;
    }

    public function __invoke(Request $request, RequestHandler $requestHandler): \Psr\Http\Message\ResponseInterface
    {
        if($this->session->exists('userEmail')){
            return $requestHandler->handle($request);
        }

        return $requestHandler->handle($request)->withRedirect('/login');
    }
}