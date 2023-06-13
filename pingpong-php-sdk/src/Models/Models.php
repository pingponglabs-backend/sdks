<?php

namespace PingPong\Models;

use GuzzleHttp\Exception\GuzzleException;

class Models
{
    private \PingPong\HttpClient\HttpClient $client;

    function __construct(\PingPong\HttpClient\HttpClient $client)
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
        $response = $this->client->get('api/v1/models');

        return $this->modelFactory($response);
    }

    /**
     * @throws GuzzleException
     */
    public function getById(string $id): Model
    {
        $response = $this->client->get('api/v1/models/' . $id);

        return $this->modelFactory($response);
    }

    private function splitOrgRepo(string $alias): array
    {
        $split = explode('/', $alias);

        if (count($split) !== 2) {
            throw new Exception('Invalid alias');
        }

        return $split;
    }

    /**
     * @throws GuzzleException
     */
    public function getByAlias(string $alias): Model
    {
        $split = $this->splitOrgRepo($alias);

        $response = $this->client->get('api/v1/models/alias/' . $split[0] . '/' . $split[1]);

        return $this->modelFactory($response);
    }
}