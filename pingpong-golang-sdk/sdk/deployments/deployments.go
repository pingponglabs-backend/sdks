package deployments

import (
	"bytes"
	"encoding/json"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/internal/http"
	"github.com/pkg/errors"
)

type Client struct {
	httpClient *http.Client
}

func NewClient(httpClient *http.Client) *Client {
	return &Client{
		httpClient: httpClient,
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

func (c *Client) Create(deployment CreateDeployment) ([]byte, error) {
	body, err := deployment.MarshalJSON()
	if err != nil {
		return nil, errors.Wrap(err, "failed to marshal deployment body")
	}
	return c.httpClient.Post("/deployments", bytes.NewReader(body))
}
