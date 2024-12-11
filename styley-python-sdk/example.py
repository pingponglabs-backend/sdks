from styleysdk import Styley
from styleysdk.deployments.model import CreateDeployment

styley = Styley()
deployment = styley.deployments.create(deployment=CreateDeployment(
    name="example-deployment",
    model='844218fa-c5d0-4cee-90ce-0b42d226ac8d',
    args={
        'input': 'https://cdn.mediamagic.dev/media/eb341446-be53-11ed-b4a8-66139910f724.jpg',
    },
))
