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
            model='pingponai/background-removal',
            args={
                'input': 'https://cdn.mediamagic.dev/media/eb341446-be53-11ed-b4a8-66139910f724.jpg',
            }
        ))

        print(deployment.name)
        print(deployment.job.results)
    except Exception as e:
        print(e)
