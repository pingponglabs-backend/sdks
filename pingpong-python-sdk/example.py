from pingpongsdk import PingPong
from pingpongsdk.deployments.model import CreateDeployment

pingpong = PingPong()
deployment = pingpong.deployments.create(deployment=CreateDeployment(
    name="example-deployment",
    model='pingpongai/ai-image-scan',
    args={
        'input_image_file': 'https://cdn.mediamagic.dev/media/eb341446-be53-11ed-b4a8-66139910f724.jpg',
    }
))
