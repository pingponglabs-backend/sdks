# pingpong-typescript-sdk

PingPong Typescript SDK

## Example

```typescript 

import OneUp from '@pingpong/typescript-sdk';

const oneup = new OneUp('<your-api-key>');

const models = oneup.models.list();

const model = oneup.models.getById('<model-id>');

const deployment = oneup.deployments.create({
    name: 'test',
    model_id: model.id,
    args: {
        'input_image_file': 'image-file.jpg',
    }
});

```
