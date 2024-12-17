# Styley - Golang SDK

## **GO Installaiton guide**

## **📥 1. Install Golang**
**Install Using Official Installer (Recommended)** 

1. Go to the official Golang Download page:

	👉 https://go.dev/doc/install

2. Download the installer for your operating system:

	- Windows: Download .msi file.

	- MacOS: Download .pkg file.

	- Linux: Download .tar.gz file.

3. Run the installer and follow the instructions.


## **⚙️ 2. Verify Installation**
Check if Go is installed and running correctly.

```bash
go version
```
Expected output:

```bash
go version go1.21.1 linux/amd64
```
If you see "command not found", double-check that the Go binary is in your PATH.

## 📁 **3. Setup Go Workspace**
In Go, it’s recommended to use a workspace for organizing your projects.

Create a Go workspace directory:

```bash
mkdir -p $HOME/go/src/github.com/styley/styleygolang-sdk
cd $HOME/go/src/github.com/styley/styleygolang-sdk
```
Initialize the Go module:

```bash
go mod init github.com/styley/styleygolang-sdk
```

The `go.mod` file will be created, which tracks the project dependencies.

## **SDK Installation**
To install the Go styley SDK, use the following command:
```bash
go get github.com/styley-backend/sdks/styley-golang-sdk
```
This will add the SDK to your `go.mod` file.

## **Environment Variables**

To authenticate API requests, you must set the following environment variables in your system.

```
export X_STYLEY_KEY=***************************
```
Or, if you’re using dotenv with Go, you can create a .env file with:
```
X_STYLEY_KEY=***************************
```
<br>

# 🚀 **Usage**

## 🏆 **Create Deployment**

### 📤 **Deployments**

 The **Create Deployment** method allows you to create a new deployment using a model name, arguments, and deployment name.The method returns an output with an job_id which can be used to fetch the final results.


```go
package main

import (
	"github.com/styley-backend/sdks/styley-golang-sdk/sdk"
	"github.com/styley-backend/sdks/styley-golang-sdk/sdk/deployments"
)

func main(){
	client := sdk.NewClient()

	deployment, err := client.Deployments().Create(deployments.CreateDeployment{
			deployment, err := client.Deployments().Create(deployments.CreateDeployment{
			Name: "Gif Maker",
			Args: map[string]interface{}{
				"height":          "384",
				"mp4":             "true",
				"negative_prompt": "blurry",
				"prompt":          "A dog with a stick",
				"scheduler":       "EulerAncestralDiscreteScheduler",
				"seed":            "1",
				"steps":           "30",
				"width":           "672",
			},
			Model: "66a8ccd5-ed5d-4133-b0c8-c3862a575a9e",
		})
	})

	if err:=nil{
		fmt.Println("Error creating deployment:", err)
		return
	}

	fmt.Println("Deployment created successfully:", deployment)
}

```

## 📄 **Get Job**
Fetch a job by its `JobID`.
```go
job, err := client.Deployments().GetJob("<job_id>")

if err != nil {
	fmt.Println("Error fetching job:", err)
	return
}

fmt.Printf("Job details: %+v\n", job)
```
## 📜**List Deployments**
List all `deployments` available in your account.
```go
deployments, err := client.Deployments().List()

if err != nil {
	fmt.Println("Error listing deployments:", err)
	return
}

fmt.Printf("Deployments: %+v\n", deployments)
```
# ⚡**Models**

## 🔍**Get Model by ID**
Retrieve the details of a model using its `ModelID`.
```go
model, err := client.Models().GetByID("<model_id>")

if err != nil {
	fmt.Println("Error fetching model by ID:", err)
	return
}

fmt.Printf("Model details: %+v\n", model)
```

## 🔍**Get Model by Name**
Retrieve the details of a model using its `ModelName`.
```go
model, err := client.Models().GetByName("<model_name>")

if err != nil {
	fmt.Println("Error fetching model by name:", err)
	return
}

fmt.Printf("Model details: %+v\n", model)
```

## 📜**List Models**
Lists all models available.
```go
models, err := client.Models().List()

if err != nil {
	fmt.Println("Error listing models:", err)
	return
}

fmt.Printf("Models: %+v\n", models)
```

📘 Summary of Available Methods
Class	   | Method		   	   | Description
-----------|-------------------|-------------
Deployments|`Create` (payload) |Create a new deployment.
Deployments|`GetByID` (id)	   |Get deployment details by deployment ID.
Deployments|`List()`		   |List all deployments.
Deployments|`GetJob` (jobID)   |Get the status of a deployment job.
Models	   |`List()`		   |List all available models.
Models	   |`GetByID` (id)     |Get model details by model ID.
Models	   |`GetByName` (name) |Get model details by model name.
