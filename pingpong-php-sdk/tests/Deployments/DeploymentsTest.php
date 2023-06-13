<?php

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use PingPong\Deployments\Deployment;
use PingPong\Deployments\Deployments;
use PingPong\Deployments\DeploymentInput;
use PingPong\HttpClient\HttpClient;
use PingPong\Models\Models;
use PingPong\Models\Model;

class DeploymentsTest extends TestCase
{
    public function testCreate()
    {
        $httpClient = $this->createMock(HttpClient::class);
        $models = $this->createMock(Models::class);

        $deploymentInput = new DeploymentInput('deployment_name', 'pingpongai/test', []);
        $response = [
            'id' => 'abc123',
            'name' => 'deployment_name',
            'model' => 'model',
            'job' => [
                'files' => ['test.jpg'],
                'credits_used' => 1,
            ],
        ];

        $httpClient
            ->expects($this->once())
            ->method('post')
            ->with('api/v1/deployments', $deploymentInput)
            ->willReturn($response);

        $models
            ->expects($this->once())
            ->method('getByAlias')
            ->with('pingpongai/test')
            ->willReturn(new Model('pingpongai/test', 'model_name', 'model_description', []));

        $deployments = new Deployments($httpClient, $models);
        $deployment = $deployments->create($deploymentInput);

        $this->assertInstanceOf(Deployment::class, $deployment);
        $this->assertEquals('deployment_name', $deployment->name);
        $this->assertEquals('abc123', $deployment->modelId);
        $this->assertEquals('test.jpg', $deployment->job->files[0]);
        $this->assertEquals(1, $deployment->job->creditsUsed);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetById()
    {
        // Mocks
        $httpClient = $this->createMock(HttpClient::class);
        $models = $this->createMock(Models::class);

        // Test data
        $deploymentId = 'deployment_id';
        $response = [
            'name' => 'deployment_name',
            'id' => 'abc123',
            'job' => [
                'files' => ['test.jpg'],
                'credits_used' => 1,
            ],
        ];

        $httpClient
            ->expects($this->once())
            ->method('get')
            ->with('api/v1/deployments/' . $deploymentId)
            ->willReturn($response);

        $deployments = new Deployments($httpClient, $models);
        $deployment = $deployments->getById($deploymentId);

        $this->assertInstanceOf(Deployment::class, $deployment);
        $this->assertEquals('deployment_name', $deployment->name);
        $this->assertEquals('abc123', $deployment->modelId);
    }
}
