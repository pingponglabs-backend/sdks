<?php

namespace PingPong\Deployments;

use \PingPong\HttpClient\Mappable;


class DeploymentInput implements Mappable
{
    public $name;
    public $model_id;
    public $args;

    public function __construct(string $name, string $model_id, array $args)
    {
        $this->name = $name;
        $this->model_id = $model_id;
        $this->args = $args;
    }

    public function toMap(): array
    {
        return [
            'name' => $this->name,
            'model_id' => $this->model_id,
            'args' => $this->args,
        ];
    }
}
