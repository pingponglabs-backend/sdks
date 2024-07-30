import { PingPong } from "../build/index.js";

const pingpong = new PingPong();

async function main() {
  const deployment = await pingpong.deployments.create({
    name: "Background Removal",
    model: "844218fa-c5d0-4cee-90ce-0b42d226ac8d",
    args: {
      input:
        "https://cdn.mediamagic.dev/media/799f2adc-384e-11ed-8158-e679ed67c206.jpeg",
    },
    sync: true,
  });
  console.log("deployment: ", deployment);
}

main().then(console.log).catch(console.error);
