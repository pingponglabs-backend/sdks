import express from 'express'
import { PingPong } from '@pingpongai/typescript-sdk'

const app = express()
const client = new PingPong()

app.get('/', function (req: express.Request, res: express.Response) {
    (async () => {
        const deployment = await client.deployments.create({
            model: 'pingpongai/ai-image-scan',
            name: 'test',
            args: {
                input_image_file: "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg"
            },
        })
        console.log('deployment: ', deployment)
    })
})

app.listen(3000)
