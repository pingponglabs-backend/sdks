package sdk

import (
	"os"

	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/internal/http"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/deployments"
	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk/models"
)

type Client struct {
	models      *models.Client
	deployments *deployments.Client
}

type Options struct {
	Key string
}

type Option func(*Options)

func WithKey(key string) Option {
	return func(o *Options) {
		o.Key = key
	}
}

func NewClient(opts ...Option) *Client {
	defaultOptions := Options{
		Key: os.Getenv("X_PINGPONG_KEY"),
	}

	for _, opt := range opts {
		opt(&defaultOptions)
	}

	httpTransport := http.New(defaultOptions.Key)
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
