package http

import (
	"fmt"
	"io"
	"net/http"

	"github.com/pkg/errors"
)

const BasePath = "https://mediamagic.dev"

type Client struct {
	transport *http.Client
}

func New() *Client {
	return &Client{
		transport: http.DefaultClient,
	}
}

func (c *Client) Get(path string) ([]byte, error) {
	response, err := c.transport.Get(fmt.Sprintf("%s%s", BasePath, path))
	if err != nil {
		return nil, errors.Wrap(err, "failed to make GET request")
	}
	defer response.Body.Close()

	if response.StatusCode > 399 {
		return nil, errors.Errorf("failed to make GET request: %s", response.Status)
	}

	body, err := io.ReadAll(response.Body)
	if err != nil {
		return nil, errors.Wrap(err, "failed to read response body")
	}

	return body, nil
}

func (c *Client) Post(path string, body io.Reader) ([]byte, error) {
	response, err := c.transport.Post(fmt.Sprintf("%s%s", BasePath, path), "application/json", body)
	if err != nil {
		return nil, errors.Wrap(err, "failed to make POST request")
	}
	defer response.Body.Close()

	if response.StatusCode > 399 {
		return nil, errors.Errorf("failed to make POST request: %s", response.Status)
	}

	responseBody, err := io.ReadAll(response.Body)
	if err != nil {
		return nil, errors.Wrap(err, "failed to read response body")
	}

	return responseBody, nil
}
