<?php

namespace PingPong\Deployments;

readonly class Deployment {

    public function __construct(
        public string $name,
        public string $modelId,
        public Job $job) {}
}
