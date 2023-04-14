# PingPongAI - Golang SDK


## Create Deployment

```golang

import (
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/deployments"
)

...

deployment, err := client.Deployments().Create(deployments.CreateDeployment{
    Name: "test",
    Args: map[string]interface{}{
        "input_image_file": "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg",
    },
    Model: "pingpongai/<model-name>",
})

```
