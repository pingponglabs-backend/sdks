package deployments

import (
	"bytes"
	"encoding/json"

	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/internal/http"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/models"
	"github.com/pkg/errors"
)

type Client struct {
	httpClient   *http.Client
	modelsClient *models.Client
}

func NewClient(httpClient *http.Client, modelsClient *models.Client) *Client {
	return &Client{
		httpClient:   httpClient,
		modelsClient: modelsClient,
	}
}

func (c *Client) List() ([]Deployment, error) {
	response, err := c.httpClient.Get("/deployments")
	if err != nil {
		return nil, errors.Wrap(err, "failed to list deployments")
	}

	var deployments []Deployment
	if err := json.Unmarshal(response, &deployments); err != nil {
		return nil, errors.Wrap(err, "failed to unmarshal deployments")
	}

	return deployments, nil
}

func (c *Client) Create(deployment CreateDeployment) (*Deployment, error) {
	model, err := c.modelsClient.GetByAlias(deployment.Model)
	if err != nil {
		return nil, errors.Wrap(err, "failed to get model by alias name: "+deployment.Model)
	}

	// Replace the model alias with the model ID
	deployment.ModelID = model.ID

	body, err := json.Marshal(deployment)
	if err != nil {
		return nil, errors.Wrap(err, "failed to marshal deployment body")
	}
	response, err := c.httpClient.Post("/deployments", bytes.NewReader(body))
	if err != nil {
		return nil, errors.Wrap(err, "failed to create deployment")
	}

	var deploymentResponse *Deployment
	if err := json.Unmarshal(response, &deploymentResponse); err != nil {
		return nil, errors.Wrap(err, "failed to unmarshal deployment response")
	}

	return deploymentResponse, nil
}
