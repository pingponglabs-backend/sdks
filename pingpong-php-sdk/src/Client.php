<?php

namespace PingPong;

use PingPong\Deployments\Deployment;
use PingPong\Deployments\Deployments;
use PingPong\HttpClient\HttpClient;
use PingPong\Models\Model;

require 'vendor/autoload.php';

class Client
{
    public \PingPong\Deployments\Deployments $deployments;

    public \PingPong\Models\Models $models;

    private string $apiKey;

    private \PingPong\HttpClient\HttpClient $client;

    public function __construct(string $apiKey)
    {
        // If the apiKey is empty, check the environment variable
        if (empty($apiKey)) {
            $envApiKey = getenv('X_PINGPONG_KEY');

            // If it's not there either, then we give up 🤷🏻‍♂️
            if (empty($envApiKey)) {
                throw new \Exception('API key is required');
            }

            $this->apiKey = $envApiKey;
        }

        $this->client = new HttpClient();

        $this->models = new Models($this->client);
        $this->deployments = new Deployments($this->client, $this->models);
    }

    public function deployments(): \PingPong\Deployments\Deployments
    {
        return $this->deployments();
    }

    public function models(): \PingPong\Models\Models
    {
        return $this->models();
    }
}
