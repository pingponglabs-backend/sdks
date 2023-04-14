# pingpong-typescript-sdk

PingPong Typescript SDK

## Example

```typescript 
import PingPong from '@pingpongai/typescript-sdk';

const pingpong = new PingPong();
const deployment = pingpong.deployments.create({
    name: 'test',
    model: 'pingpongai/<model-name>',
    args: {
        'input_image_file': 'image-file.jpg',
    }
});

```
