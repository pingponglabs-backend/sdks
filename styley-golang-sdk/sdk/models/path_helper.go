package models

import (
	"net/url"
	"path"
	"strings"
)

func splitName(name string) (string, string) {
	parts := strings.Split(name, "/")
	org, model := parts[0], parts[1]
	return org, model
}

func generateNamePath(name string) string {
	org, model := splitName(name)
	return path.Join("/api/v1/models", "name", url.PathEscape(org), url.PathEscape(model))
}
