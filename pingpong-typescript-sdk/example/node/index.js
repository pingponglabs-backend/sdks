import { PingPong } from '@pingpongai/typescript-sdk';

const pingpong = new PingPong();

async function main() {
  const deployment = await pingpong.deployments.create({
    model: 'pingpongai/ai-image-scan',
    name: 'test',
    args: {
        input_image_file: "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg"
    },
  })
  console.log(deployment);
}

main().then(console.log).catch(console.error);
