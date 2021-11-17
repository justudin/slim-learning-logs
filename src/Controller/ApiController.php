<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ApiController extends BaseController
{
    public function search(Request $request, Response $response): Response
    {
        $albums = json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);

        $query = strtolower($request->getQueryParam('q'));

        if($query){
            $albums = $this->getAlbumByQuery($query, $albums);
            return $response->withJson($albums);
        }

        return $response->withStatus(400)->withJson(['error' => 'invalid request']);
    }

    private function getAlbumByQuery(string $query, $albums)
    {
        if ($query) {
            $albums = array_values(array_filter($albums, function($album) use ($query) {
                return str_contains(strtolower($album['title']), $query) || str_contains(strtolower($album['artist']), $query) !== false;
            }));
        }
        return $albums;
    }
}