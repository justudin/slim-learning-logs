<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SearchController extends BaseController
{
    public function default(Request $request, Response $response): Response
    {
        $albums = json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);
        return $this->render($response, 'frontend/album.html', ['albums' => $albums]);
    }

    public function search(Request $request, Response $response): Response
    {
        $albums = json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);

        $query = strtolower($request->getQueryParam('q'));

        if ($query) {
            $albums = array_values(array_filter($albums, function($album) use ($query) {
                return str_contains(strtolower($album['title']), $query) || str_contains(strtolower($album['artist']), $query) !== false;
            }));
        }

        return $this->render($response, 'frontend/search.html', ['albums' => $albums, 'query' => $query]);
    }
}