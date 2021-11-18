<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ShopController extends BaseController
{
    public function default(Request $request, Response $response): Response
    {
        $bikes = json_decode(file_get_contents(__DIR__ . '/../../data/bikes.json'), true);
        return $this->render($response, 'frontend/eshop.html', ['bikes' => $bikes]);
    }

    public function details(Request $request, Response $response, array $args = []): Response
    {
        $bikes = json_decode(file_get_contents(__DIR__ . '/../../data/bikes.json'), true);

        $bike_id = (int) $args['id'];

        $key_data = array_search($bike_id, array_column($bikes, 'id'));

        return $this->render($response, 'frontend/eshop-detail.html', ['bike' => $bikes[$key_data]]);
    }
}