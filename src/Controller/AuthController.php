<?php

namespace App\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends BaseController
{
    public function login(Request $request, Response $response)
    {
        return $this->render($response, 'frontend/login.html');
    }

    public function loginAction(Request $request, Response $response)
    {
        $this->ci->get('session')->set('userEmail', $request->getParam('email'));
        return $response->withRedirect('/dashboard');
    }

    public function logoutAction(Request $request, Response $response)
    {
        $this->ci->get('session')->delete('userEmail');
        // Destroy session
        $this->ci->get('session')::destroy();

        return $response->withRedirect('/login');
    }
}