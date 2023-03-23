package models

import (
	"encoding/json"

	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/internal/http"
)

type Client struct {
	httpClient *http.Client
}

func NewClient(httpTransport *http.Client) *Client {
	return &Client{
		httpClient: httpTransport,
	}
}

func (c *Client) List() ([]Model, error) {
	response, err := c.httpClient.Get("/models")
	if err != nil {
		return nil, err
	}

	var models []Model
	if err := json.Unmarshal(response, &models); err != nil {
		return nil, err
	}

	return models, nil
}

func (c *Client) GetByID(id string) (*Model, error) {
	response, err := c.httpClient.Get("/models/" + id)
	if err != nil {
		return nil, err
	}

	var model Model
	if err := json.Unmarshal(response, &model); err != nil {
		return nil, err
	}

	return &model, nil
}
