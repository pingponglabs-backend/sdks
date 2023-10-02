package test

import (
	"fmt"
	"os"
	"testing"

	"github.com/go-playground/assert"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/deployments"
)

func TestCreateDeployment(t *testing.T) {
	//add valid api_key
	os.Setenv("X_PINGPONG_KEY", "XXXXXXXXXXXXXXXXXXXXXX")
	client := sdk.NewClient(sdk.WithKey(os.Getenv("X_PINGPONG_KEY")))

	deploymentRequest := deployments.CreateDeployment{
		Name: "Background Removal",
		Args: map[string]interface{}{
			"input": "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg",
		},
		Model: "844218fa-c5d0-4cee-90ce-0b42d226ac8d",
		Sync:  true,
	}

	resp, err := client.Deployments().Create(deploymentRequest)
	assert.Equal(t, nil, err)
	assert.NotEqual(t, len(resp.Job.Files), 0)

}
func TestGetJob(t *testing.T) {
	//add valid api_key
	os.Setenv("X_PINGPONG_KEY", "XXXXXXXXXXXXXXXXXXXXXXXX")
	client := sdk.NewClient(sdk.WithKey(os.Getenv("X_PINGPONG_KEY")))
	job_id := "0aa4af67-a34c-4019-a74b-a0a186238251"
	job, err := client.Deployments().GetJob(job_id)

	fmt.Println(job)
	assert.Equal(t, nil, err)
}
