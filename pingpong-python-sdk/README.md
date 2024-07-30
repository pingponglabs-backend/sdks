# PingPong Python SDK

## Example


```python

from pingpongsdk import PingPong
from pingpongsdk.deployments.model import CreateDeployment

pingpong = PingPong()
deployment = pingpong.deployments.create(deployment=CreateDeployment(
    name="example-deployment",
    model='844218fa-c5d0-4cee-90ce-0b42d226ac8d',
    args={
        'input': 'https://cdn.mediamagic.dev/media/eb341446-be53-11ed-b4a8-66139910f724.jpg',
    },
    sync=True
))

```
