<?php

namespace PingPong\Deployments;

class Deployment {
    public $name;
    public $model_id;
    public $job;

    public function __construct($name, $model_id, Job $job) {
        $this->name = $name;
        $this->model_id = $model_id;
        $this->job = $job;
    }
}
