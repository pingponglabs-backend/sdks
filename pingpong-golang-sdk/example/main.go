package main

import (
	"fmt"
	"os"

	"github.com/pingponglabs-backend/sdks/pingpong-golang-sdk/sdk"
)

func main() {
	client := sdk.NewClient(os.Getenv("X_PINGPONG_KEY"))
	models, err := client.Models().List()
	if err != nil {
		panic(err)
	}
	fmt.Println(models)
}
