<?php

namespace PingPong\Models;

class Model
{
    public $id;

    public $name;

    public $description;

    public $args;

    function __construct(string $id, string $name, string $description, array $args)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->args = $args;
    }
}
