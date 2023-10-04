# PingPongAI TypeScript SDK

```javascript
import { PingPong } from "@pingpong_ai/typescript-sdk";

const pingpong = new PingPong();

const deployment = await pingpong.deployments.create({
  name: "Background Removal",
  model: "844218fa-c5d0-4cee-90ce-0b42d226ac8d",
  args: {
    input:
      "https://cdn.mediamagic.dev/media/4427dfa9-5aeb-11ed-be7f-063c1f7ecf7a.jpg",
  },
  sync: true,
});
```
