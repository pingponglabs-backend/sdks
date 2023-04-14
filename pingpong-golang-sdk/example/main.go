package main

import (
	"fmt"
	"log"
	"os"

	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/deployments"
)

func main() {
	client := sdk.NewClient(os.Getenv("X_PINGPONG_KEY"))
	models, err := client.Models().List()
	if err != nil {
		panic(err)
	}

	for _, model := range models {
		fmt.Println(model.ID + " - " + model.Name)
	}

	deployment, err := client.Deployments().Create(deployments.CreateDeployment{
		Name: "test",
		Args: map[string]interface{}{
			"input_image_file": "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg",
		},
		Model: "pingpongai/recommender",
	})
	if err != nil {
		panic(err)
	}
	log.Println(deployment)
}
