<?php

use PHPUnit\Framework\TestCase;
use PingPong\Models\Models;
use PingPong\Models\Model;
use PingPong\HttpClient\HttpClient;

class ModelsTest extends TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testList()
    {
        $httpClient = $this->createMock(HttpClient::class);
        $response = [
            'id' => 'model_id',
            'name' => 'model_name',
            'description' => 'model_description',
            'args' => ['arg1', 'arg2']
        ];

        $httpClient
            ->expects($this->once())
            ->method('get')
            ->with('/api/v1/models')
            ->willReturn($response);

        $models = new Models($httpClient);
        $model = $models->list();

        $this->assertInstanceOf(Model::class, $model);
        $this->assertEquals('model_id', $model->id);
        $this->assertEquals('model_name', $model->name);
        $this->assertEquals('model_description', $model->description);
        $this->assertEquals(['arg1', 'arg2'], $model->args);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $httpClient = $this->createMock(HttpClient::class);
        $modelId = 'model_id';
        $response = [
            'id' => 'model_id',
            'name' => 'model_name',
            'description' => 'model_description',
            'args' => ['arg1', 'arg2']
        ];

        $httpClient
            ->expects($this->once())
            ->method('get')
            ->with('/api/v1/models/' . $modelId)
            ->willReturn($response);

        $models = new Models($httpClient);
        $model = $models->getById($modelId);

        $this->assertInstanceOf(Model::class, $model);
        $this->assertEquals('model_id', $model->id);
        $this->assertEquals('model_name', $model->name);
        $this->assertEquals('model_description', $model->description);
        $this->assertEquals(['arg1', 'arg2'], $model->args);
    }
}