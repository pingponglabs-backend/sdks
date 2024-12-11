import os
import sys

sys.path.append(os.path.join(os.path.dirname(__file__), '..'))

from styleysdk.deployments.model import CreateDeployment
from styleysdk import Styley


if __name__ == '__main__':
    styley = Styley()
    try:
        deployment = styley.deployments.create(deployment=CreateDeployment(
        name="Background Removal",
        model="844218fa-c5d0-4cee-90ce-0b42d226ac8d",
        args={              
        "input": "https://cdn.mediamagic.dev/media/799f2adc-384e-11ed-8158-e679ed67c206.jpeg",
            },
        sync=True
        ))

        print(deployment)
    except Exception as e:
        print(e)