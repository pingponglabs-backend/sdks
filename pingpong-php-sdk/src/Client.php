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
        $this->client = new HttpClient();

        $this->deployments = new Deployments($this->client);
        $this->models = new Models($this->client);
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
