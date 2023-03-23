package sdk

import (
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/internal/http"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/deployments"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/models"
)

type Client struct {
	models      *models.Client
	deployments *deployments.Client
}

func NewClient() *Client {
	httpTransport := http.New()
	return &Client{
		models:      models.NewClient(httpTransport),
		deployments: deployments.NewClient(httpTransport),
	}
}

func (c *Client) Models() *models.Client {
	return c.models
}

func (c *Client) Deployments() *deployments.Client {
	return c.deployments
}
