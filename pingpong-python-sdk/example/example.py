import os
import sys

sys.path.append(os.path.join(os.path.dirname(__file__), '..'))

from pingpongsdk.deployments.model import CreateDeployment
from pingpongsdk import PingPong

if __name__ == '__main__':
    pingpong = PingPong()
    try:
        deployment = pingpong.deployments.create(deployment=CreateDeployment(
            name="example-deployment",
            model='844218fa-c5d0-4cee-90ce-0b42d226ac8d',
            args={
                'input': 'https://cdn.mediamagic.dev/media/eb341446-be53-11ed-b4a8-66139910f724.jpg',
            }
        ))

        print(deployment.job)
    except Exception as e:
        print(e)
