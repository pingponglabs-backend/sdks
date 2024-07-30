<?php

namespace PingPong\Models;

use GuzzleHttp\Exception\GuzzleException;
use PingPong\HttpClient\HttpClient;

require '../vendor/autoload.php';

class Models
{
    private HttpClient $client;

    function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    private function modelFactory($response): Model
    {
        return new Model($response['id'], $response['name'], $response['description'], $response['args']);
    }

    /**
     * @throws Exception
     * @throws GuzzleException
     */
    public function list(): Model
    {
        $response = $this->client->get('/api/v1/models');

        return $this->modelFactory($response);
    }

    /**
     * @throws GuzzleException
     */
    public function getById(string $id): Model
    {
        $response = $this->client->get('/api/v1/models/' . $id);

        return $this->modelFactory($response);
    }
}
