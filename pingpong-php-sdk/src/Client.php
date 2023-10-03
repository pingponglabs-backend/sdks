<?php

namespace PingPong;

use PingPong\Deployments\Deployments;
use PingPong\HttpClient\HttpClient;
use PingPong\Models\Models;

require 'vendor/autoload.php';

class Client
{
    public Deployments $deployments;

    public Models $models;

    private string $apiKey;

    private HttpClient $client;

    public function __construct(string $apiKey = "")
    {
        if ($apiKey === "") {
            $apiKey = getenv('X_PINGPONG_KEY');
        }

        $this->client = new HttpClient($apiKey);

        $this->deployments = new Deployments($this->client);
        $this->models = new Models($this->client);
    }

    public function deployments(): Deployments
    {
        return $this->deployments();
    }

    public function models(): Models
    {
        return $this->models();
    }
}