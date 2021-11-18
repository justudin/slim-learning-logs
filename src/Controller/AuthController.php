<?php

namespace App\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends BaseController
{
    public function login(Request $request, Response $response)
    {
        return $this->render($response, 'login.html');
    }

    public function loginAction(Request $request, Response $response)
    {
        $this->session->set('userEmail', $request->getParam('email'));
        return $response->withRedirect('/dashboard');
    }

    public function logoutAction(Request $request, Response $response)
    {
        $this->session->delete('userEmail');
        // Destroy session
        $this->session::destroy();

        return $response->withRedirect('/login');
    }
}