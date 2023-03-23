package deployments

import "encoding/json"

type CreateDeployment struct {
	Name    string                 `json:"name"`
	Args    map[string]interface{} `json:"args"`
	ModelID string                 `json:"model_id"`
}

func (c *CreateDeployment) MarshalJSON() ([]byte, error) {
	return json.Marshal(c)
}

type Job struct{}

type Deployment struct{}
