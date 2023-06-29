<?php

namespace PingPong\Deployments;

class Job
{
    public function __construct(
        public array $files = [],
        public int $creditsUsed = 0,
    ) {}
}
