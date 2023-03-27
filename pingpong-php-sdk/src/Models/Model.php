<?php

namespace PingPong\Models;

readonly class Model
{
    function __construct(
        public string $id,
        public string $name,
        public string $description,
        public array $args
    ) {}
}