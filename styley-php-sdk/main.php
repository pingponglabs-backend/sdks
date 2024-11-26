<?php
use \PingPong\Client;
use \PingPong\Deployments\DeploymentInput;

require '/home/arunkumar/sdks/styley-php-sdk/vendor/autoload.php';

$client = new Client('89448b74-9084-11ef-9e00-30d042e69440'); 


// $createdeployment = $client->deployments->create(
//     new DeploymentInput(
//         "Property Details and Maps",
//         "6db33e45-29cf-4880-8ee0-3d9074c32e5e",
//         [
//             "City" => "Arlington",
//             "State" => "VA",
//             "Basement" => true,
//             "Number of BathRoom" => 1,
//             "Number of BedRoom" => 1,
//             "Garage" => false,
//             "Stories" => 1,
//             "Pool" => false
//         ]
//     )
// );

// print_r($createdeployment);



// $getdeployment =  $client->deployments->getById("bd8930b9-5662-48c3-be6e-6e81039d7fd1");

// print_r($getdeployment);


// $getjob = $client->deployments->getJob("b581b5a2-5e89-485a-abae-c758e4d383eb");


// print_r($getjob);

// $getmodel = $client->models->list();

// print_r($getmodel);

// $getmodelbyid = $client->models->getById("6db33e45-29cf-4880-8ee0-3d9074c32e5e");

// print_r($getmodelbyid);


$startTime = microtime(true);

$getmodelbyname = $client->models->getByName("Property Details and Maps");
print_r($getmodelbyname);

$error = null;
echo "time since " . (microtime(true) - $startTime) . " seconds\n";
if ($error !== null) {
    echo "error making deployment: " . $error . "\n";
    return;
}


