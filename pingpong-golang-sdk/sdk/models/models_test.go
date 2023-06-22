package models

import (
	"os"
	"testing"

	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/internal/http"
)

func TestCanGenerateAliasPath(t *testing.T) {
	alias := "pingpongai/recommender"
	path := generateAliasPath(alias)
	if path != "/models/alias/pingpongai/recommender" {
		t.Fatal("path is incorrect")
	}
}

func TestCanGetModelByAlias(t *testing.T) {
	client := NewClient(http.New(os.Getenv("X_PINGPONG_KEY")))
	alias := "pingpongai/ai-image-scan"
	model, err := client.GetByAlias(alias)
	if err != nil {
		t.Fatal(err)
	}

	if model.Alias != alias {
		t.Fatal("model id is incorrect")
	}
}
