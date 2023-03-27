<?php

namespace PingPong\Deployments;

readonly class Job
{
    public function __construct(
        public array $files = [],
        public int $creditsUsed = 0,
    ) {}
}
