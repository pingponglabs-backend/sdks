import os
import sys

from pingpongsdk.deployments.model import CreateDeployment
from pingpongsdk import PingPong


def test_can_create_deployment():
    pingpong = PingPong()
    deployment = pingpong.deployments.create(deployment=CreateDeployment(
        name="Background Removal",
        model="844218fa-c5d0-4cee-90ce-0b42d226ac8d",
        args={
            'input': 'https://cdn.mediamagic.dev/media/eb341446-be53-11ed-b4a8-66139910f724.jpg',
        },
        sync=True,
    ))
    assert deployment is not None
    assert deployment.job_id is not None
    assert deployment.job['files'] is not None
    print("passed")
    
    
def test_can_get_job():
    pingpong = PingPong()
    job = pingpong.deployments.get_job('a5fb31a6-6c32-4ba5-9445-addce2788bb5')
    
    assert job is not None
    assert job['files'] is not None
    print(job)
    print("passed")
    
if __name__ == '__main__':
    test_can_get_job()

