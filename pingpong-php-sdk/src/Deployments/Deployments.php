<?php

namespace PingPong\Deployments;

class Deployments
{
    private $client;

    function __construct(\PingPong\HttpClient\HttpClient $client)
    {
        $this->client = $client;
    }

    private function deploymentFactory(array $response): Deployment
    {
        return new Deployment($response['name'], $response['model_id'], $response['job']);
    }

    /**
     * @throws \Exception
     */
    public function createDeployment(DeploymentInput $deployment): \Psr\Http\Message\StreamInterface
    {
        $response = $this->client->post("api/v1/deployments", $deployment);

        return $this->deploymentFactory($response);

    }

    public function getDeploymentById(string $id): \Psr\Http\Message\StreamInterface
    {
        $response = $this->client->get('api/v1/deployments/'+id);

        return $this->deploymentFactory($response);
    }
}
