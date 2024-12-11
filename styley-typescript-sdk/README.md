# PingPongAI TypeScript SDK

```javascript
import { Styley } from '@pingpongai/typescript-sdk';

const styley = new Styley();

const deployment = await styley.deployments.create({
  model: 'pingpongai/ai-image-scan',
  name: 'test',
  args: {
    input_image_file: "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg"
  },
});
```
