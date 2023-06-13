<?php

namespace PingPong\Deployments;

class Job
{
    public array $files;
    public int $creditsUsed;
    
    public function __construct(array $files = [], int $creditsUsed = 0)
    {
        $this->files = $files;
        $this->creditsUsed = $creditsUsed;
    }
}
