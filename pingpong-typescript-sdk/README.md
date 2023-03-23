# pingpong-typescript-sdk

PingPong Typescript SDK

## Example

```typescript 

import PingPong from '@pingpongai/typescript-sdk';

const pingpong = new PingPong('<your-api-key>');

const models = pingpong.models.list();

const model = pingpong.models.getById('<model-id>');

const deployment = pingpong.deployments.create({
    name: 'test',
    model_id: model.id,
    args: {
        'input_image_file': 'image-file.jpg',
    }
});

```
