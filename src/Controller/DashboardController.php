<?php

namespace App\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DashboardController extends BaseController
{
    public function default(Request $request, Response $response)
    {
        $userEmail = $this->ci->get('session')->get('userEmail');
        return $this->render($response, 'frontend/dashboard.html', ['userEmail' => $userEmail]);
    }

    public function membership(Request $request, Response $response)
    {
        $userEmail = $this->ci->get('session')->get('userEmail');
        return $this->render($response, 'frontend/status.html', ['userEmail' => $userEmail]);
    }
}