<?php

namespace PingPong\Deployments;

class Job
{
    public $result;
    public $credits_used;

    public function __construct()
    {
        $this->result = [];
        $this->credits_used = 0;
    }
}
