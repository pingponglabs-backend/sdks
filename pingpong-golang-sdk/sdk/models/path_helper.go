package models

import (
	"net/url"
	"path"
	"strings"
)

func splitAlias(alias string) (string, string) {
	parts := strings.Split(alias, "/")
	org, model := parts[0], parts[1]
	return org, model
}

func generateAliasPath(alias string) string {
	org, model := splitAlias(alias)
	return path.Join("/models", "alias", url.PathEscape(org), url.PathEscape(model))
}
