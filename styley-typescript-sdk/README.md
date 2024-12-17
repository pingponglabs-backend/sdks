# **Styley Typescript SDK**

## 📥 Install Node.js & npm
## **Install Using Official Installer (Recommended)**
1. Go to the Node.js official download page:

    👉 https://nodejs.org/

2. Download the installer for your operating system:

    - Windows: Download the `.msi` file.

    - MacOS: Download the `.pkg` file.

    - Linux: Use the pre-built binary or use the package manager for your OS.

3. Run the installer and follow the instructions.

    **Verify Installation**
    <br>
    Check if Node.js and npm are installed and running correctly.

    ```bash
    node -v  # Check Node.js version
    npm -v   # Check npm version
    ```
    **Expected output:**

    ```bash
    v20.5.1  # Example node version
    8.5.0    # Example npm version
    ```
    If you see "command not found", double-check that Node.js is installed and is in your PATH.


### 📦**Setup Project Workspace**
 
1. Create a project directory:

    ```bash
    mkdir typescript-sdk-project
    cd typescript-sdk-project
    ```
2. Initialize a new npm project (this creates package.json):

    ```bash
    npm init -y
    ```
    This will create a `package.json` file with default values.

## **Install TypeScript & SDK Dependencies**

1. Install TypeScript globally (optional, but useful for running tsc command globally):
  
    ```
    npm install -g typescript
    ```
  
2. Install Styley TypeScript and the SDK locally in your project:

    ```
    npm install --save-dev typescript
    npm install --save @styley/typescript-sdk
    ```
3. Initialize TypeScript configuration:
    ```
    npx tsc --init
    ```
This creates a tsconfig.json file in the root of your project, which configures how TypeScript compiles your code.

**To run a TypeScript SDK, you’ll need a file with TypeScript code.**

**Create a file called `index.ts` in your project directory.**

## **Environment Variables**

To authenticate API requests, you must set the following environment variables in your system.

```
export X_STYLEY_KEY=***************************
```
<br>

# 🏆 **Deployments**
## 📤 Create Deployment
This method creates a new deployment using the specified model ID, name, and arguments.

```javascript
import { Styley } from '@styley/typescript-sdk';

const pingpong = new PingPong();

async function main() {
const deployment = await styley.deployments.create({
    model: '6db33e45-29cf-4880-8ee0-3d9074c32e5e',
    name: 'Property Details and Maps',
    args: {
      "Basement": "false",
      "City": "Arlington",
      "Garage": "false",
      "Pool": "true",
      "State": "NY",
    },
    sync: false,
  });
  console.log("deployment: ", deployment); 
}
```

## 📄**List Deployments**
Retrieve a list of all deployments.
```javascript
import { Styley } from '@styley/typescript-sdk';

const styley = new Styley();  
const deployments = await styley.deployments.list();
```

## 📜 **Get Deployment Job**
Get the status of a deployment job using its job ID.

```javascript
import { Styley } from '@styley/typescript-sdk';

const styley = new Styley(); 
const jobStatus = await styley.deployments.getJob("job_id");
```
# ⚡**Models**

## 📜**List Models**
Retrieve a list of all models available for deployments.
```javascript
import { Styley } from '@styley/typescript-sdk';

const styley = new Styley();
const models = await styley.models.list();
```

## 🔍**Get Model By ID**
Fetch a specific model’s details using its model ID.

```javascript
import { Styley } from '@styley/typescript-sdk';

const styley = new Styley();
const model = await styley.models.getById("model_id");
```

## 🔍 **Get Model By Name**
Fetch model details using its name.

```javascript
import { Styley } from '@styley/typescript-sdk';

const styley = new Styley();
const model = await styley.models.getByName("model_name");
```

📘 Summary of Available Methods
Class      |	Method	       | Description
-----------|-----------------|-------------
Deployments|`create`(payload)| Create a new deployment.
Deployments|`list()`	       | List all deployments.
Deployments|`getJob`(jobID)  | Get the status of a deployment job.
Models	   |`list()`	       | List all available models.
Models	   |`getById`(id)	   | Get model details by model ID.
Models	   |`getByName`(name)| Get model details by model name.