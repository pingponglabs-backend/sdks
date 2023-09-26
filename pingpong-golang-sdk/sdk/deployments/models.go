package deployments

type CreateDeployment struct {
	Name    string                 `json:"name"`
	Args    map[string]interface{} `json:"args"`
	Model   string                 `json:"-"`
	ModelID string                 `json:"model_id"`
}

type Job struct {
	Id          string   `json:"id"`
	Files       []string `json:"files"`
	CreditsUsed int      `json:"credits_used"`
	Status      string   `json:"status"`
}

type Deployment struct {
	ID     string `json:"id"`
	Job    Job    `json:"job"`
	Status string `json:"status"`
}
