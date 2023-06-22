package deployments

type CreateDeployment struct {
	Name    string                 `json:"name"`
	Args    map[string]interface{} `json:"args"`
	Model   string                 `json:"-"`
	ModelID string                 `json:"model_id"`
}

type Job struct {
	Files       []string `json:"files"`
	CreditsUsed int      `json:"credits_used"`
}

type Deployment struct {
	ID  string `json:"id"`
	Job Job    `json:"job"`
}
