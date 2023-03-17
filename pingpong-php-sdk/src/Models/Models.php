<?php

namespace PingPong\Models;

use GuzzleHttp\Exception\GuzzleException;

class Models
{
    private $client;

    function __construct(\PingPong\HttpClient\HttpClient $client)
    {
        $this->client = $client;
    }

    private function modelFactory($response): Model
    {
        return new Model($response['id'], $response['name'], $response['description'], $response['args']);
    }

    /**
     * @throws \Exception
     */
    public function getModels(): Model
    {
        $response = $this->client->get('api/v1/models');

        return $this->modelFactory($response);
    }

    /**
     * @throws GuzzleException
     */
    public function getModelById(string $id): Model
    {
        $response = $this->client->get('api/v1/models/'+$id);

        return $this->modelFactory($response);
    }
}