<?php

use \PingPong\Deployments\Deployments;

require 'vendor/autoload.php';

$client = new Deployments(new \PingPong\HttpClient\HttpClient());
$res = $client->create(
    new \PingPong\Deployments\DeploymentInput(
        "My Deployment",
        "844218fa-c5d0-4cee-90ce-0b42d226ac8d",
        ["input" => "https://cdn.mediamagic.dev/media/799f2adc-384e-11ed-8158-e679ed67c206.jpeg"]
    )
);
print_r($res);