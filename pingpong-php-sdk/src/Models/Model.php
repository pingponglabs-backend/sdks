<?php

namespace PingPong\Models;

class Model
{
    public string $id;
    public string $name;
    public string $description;
    public array $args;

    function __construct(string $id, string $name, string $description, array $args)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->args = $args;
    }
}
