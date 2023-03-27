<?php

namespace PingPong\Deployments;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class Deployments
{
    private \PingPong\HttpClient\HttpClient $client;

    function __construct(\PingPong\HttpClient\HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws Exception
     */
    private function deploymentFactory(array $response): Deployment
    {
        $j = $response['job'];

        if (empty($j)) {
            throw new Exception('Job is empty');
        }

        $job = new Job($j['files'], $j['credits_used']);
        return new Deployment($response['name'], $response['model_id'], $job);
    }

    /**
     * @throws Exception|GuzzleException
     */
    public function create(DeploymentInput $deployment): Deployment
    {
        $response = $this->client->post("api/v1/deployments", $deployment);

        return $this->deploymentFactory($response);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getById(string $id): Deployment
    {
        $response = $this->client->get('api/v1/deployments/' . $id);

        return $this->deploymentFactory($response);
    }
}
