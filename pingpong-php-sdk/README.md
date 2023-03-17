## PingPong PHP SDK

### Example

```php

use \PingPong\Client;

$client = new Client();

$models = $client->models->list();

$model = $client->models->getById($id);

$deployment = $client->deployments->create(new \PingPong\Deployments\DeploymentInput(
    'my-deployment',
    $model->getId(),
    'input_image_file' => '<url>/my-file.jpg'
));

print($deployment->getJob()->getCreditsUsed());

```