package models

import (
	"os"
	"testing"

	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/internal/http"
)

const (
	BasePath = "https://api-qa.mediamagic.ai"
)

func TestCanGenerateAliasPath(t *testing.T) {
	alias := "pingpongai/recommender"
	path := generateAliasPath(alias)
	if path != "/models/alias/pingpongai/recommender" {
		t.Fatal("path is incorrect")
	}
}

func TestCanGetModelByAlias(t *testing.T) {
	url := os.Getenv("MM_HOST_URL")
	if url == "" {
		url = BasePath
	}
	client := NewClient(http.New(os.Getenv("X_PINGPONG_KEY"),url))
	alias := "pingpongai/ai-image-scan"
	model, err := client.GetByAlias(alias)
	if err != nil {
		t.Fatal(err)
	}

	if model.Alias != alias {
		t.Fatal("model id is incorrect")
	}
}
