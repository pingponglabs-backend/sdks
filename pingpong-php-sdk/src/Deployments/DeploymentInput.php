<?php

namespace PingPong\Deployments;

use \PingPong\HttpClient\Mappable;


class DeploymentInput implements Mappable
{
    public string $name;
    public string $model;
    public array $args;

    public function __construct(string $name, string $model, array $args)
    {
        $this->name = $name;
        $this->model = $model;
        $this->args = $args;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    // This lets us override the model field, which the user defines as an 'alias',
    // We use the alias to fetch the model id, which we will use this to replace.
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function toMap(): array
    {
        return [
            'name' => $this->name,
            'model_id' => $this->model,
            'args' => $this->args,
        ];
    }
}
