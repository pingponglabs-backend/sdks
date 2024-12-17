# Styley Python SDK

## 📥*Install Python*
Install Using Official Installer (Recommended)

1. Go to the Python official download page:

    👉  https://www.python.org/downloads/

2. Download the installer for your operating system:

    - Windows: Download the .exe file.

    - MacOS: Download the .pkg file.

    - Linux: Use the system's package manager (e.g., apt, yum).

3. **Run the installer** and select the following options:
    - **Add Python to PATH** (this is important!).
    - Select Install Now.
4. Restart your terminal after installation.

## ⚙️ **Verify Installation**
Check if Python and pip are installed and running correctly.

```bash
python --version
pip --version
```

Expected output:

```bash
Python 3.10.0  # Example version
pip 23.1.2     # Example pip version
```
If you see "command not found", double-check that Python is installed and is in your PATH.

### 📦**Installation**
Install the Python SDK via pip:
```bash
pip install styleysdk
```
This will install the Styley SDK and all its dependencies.

## **Environment Variables**

To authenticate API requests, you must set the following environment variables in your system.

```
export X_STYLEY_KEY=***************************
```
<br>

# ⚙️ **Usage**
This section covers all the available methods to interact with deployments and models.

## 🏆**Deployments**

### 📤 **Create Deployment**
 The **Create Deployment** method allows you to create a new deployment using a `model name` and `arguments`.The method returns an output with an `job_id` which can be used to fetch the final results.

## Example

```python
from styleysdk import Styley
from styleysdk.deployments.model import CreateDeployment
from styleysdk.deployments.model import Job

styley = Styley()
deployment = styley.deployments.create(deployment=CreateDeployment(
name="Translate Pro",
model="e77a0be0-dedb-4f9d-acf6-9878df149d33",
args={
     "Target_Language": "SL",
     "Text": "what is how",
}
))
print(deployment)
```

## 📄 **Get Deployment By ID**
Fetch details of a specific deployment using its deployment ID.

```python
from styleysdk import Styley
from styleysdk.deployments.model import CreateDeployment
from styleysdk.deployments.model import Job

styley = Styley()
get_deployment_by_id = styley.deployments.get_by_id(deployment_id)
```

## 📜 **List Deployments**
Retrieve a list of all deployments.

```python
from styleysdk import Styley
from styleysdk.deployments.model import CreateDeployment
from styleysdk.deployments.model import Job

styley = Styley()
list_deployments = styley.deployments.list()
```

## 🚀 **Get Deployment Job**
Get the status of a deployment job using its job ID.

```python
from styleysdk import Styley
from styleysdk.deployments.model import CreateDeployment
from styleysdk.deployments.model import Job

styley = Styley()
response_jobs = client.deployments.get_job(job_id)
```

# ⚡**Models**

## 📜**List Models**
Retrieve a list of all models available for deployments.

```python
from styleysdk import Styley
from styleysdk.deployments.model import CreateDeployment
from styleysdk.deployments.model import Job

styley = Styley()
models_list = client.models.list()
```

## 🔍**Get Model By ID**
Fetch a specific model’s details using its model ID.

```python
from styleysdk import Styley
from styleysdk.deployments.model import CreateDeployment
from styleysdk.deployments.model import Job

styley = Styley()
get_model_by_id = client.models.get_by_id(model_id)
```

Class	    | Method	    | Description
------------|---------------|-------------
Deployments	|`create`(payload)|	Create a new deployment.
Deployments	|`get_by_id`(id)	|  Get deployment details by deployment ID.
Deployments	|`list()`	List all| deployments.
Deployments	|`get_job`(job_id)|	Get the status of a deployment job.
Models	    | `list()`	    |List all available models.
Models	    |`get_by_id`(id)	|    Get model details by model ID.
Models	    |`get_by_name`(name)|Get model details by model name.

## 📝 Changelog