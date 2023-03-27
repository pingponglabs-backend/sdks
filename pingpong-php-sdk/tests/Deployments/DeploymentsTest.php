<?php

use PHPUnit\Framework\TestCase;
use PingPong\Deployments\Deployment;
use PingPong\Deployments\Deployments;
use PingPong\Deployments\DeploymentInput;
use PingPong\HttpClient\HttpClient;

class DeploymentsTest extends TestCase
{
    public function testCreate()
    {
        $httpClient = $this->createMock(HttpClient::class);
        $deploymentInput = new DeploymentInput('deployment_name', 'model_id', []);
        $response = [
            'name' => 'deployment_name',
            'model_id' => 'model_id',
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

        $deployments = new Deployments($httpClient);
        $deployment = $deployments->create($deploymentInput);

        $this->assertInstanceOf(Deployment::class, $deployment);
        $this->assertEquals('deployment_name', $deployment->name);
        $this->assertEquals('model_id', $deployment->model_id);
        $this->assertEquals('test.jpg', $deployment->job->files[0]);
        $this->assertEquals(1, $deployment->job->credits_used);
    }

    public function testGetById()
    {
        $httpClient = $this->createMock(HttpClient::class);
        $deploymentId = 'deployment_id';
        $response = [
            'name' => 'deployment_name',
            'model_id' => 'model_id',
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

        $deployments = new Deployments($httpClient);
        $deployment = $deployments->getById($deploymentId);

        $this->assertInstanceOf(Deployment::class, $deployment);
        $this->assertEquals('deployment_name', $deployment->name);
        $this->assertEquals('model_id', $deployment->model_id);
    }
}
