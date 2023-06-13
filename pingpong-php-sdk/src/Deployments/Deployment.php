<?php

namespace PingPong\Deployments;

class Deployment {
    public string $name;
    public string $modelId;
    public Job $job;

    public function __construct(string $name, string $modelId, Job $job)
    {
        $this->name = $name;
        $this->modelId = $modelId;
        $this->job = $job;
    }
}
