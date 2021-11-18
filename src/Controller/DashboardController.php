<?php

namespace App\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DashboardController extends BaseController
{
    public function default(Request $request, Response $response)
    {
        return $this->render($response, 'frontend/dashboard.html');
    }
}