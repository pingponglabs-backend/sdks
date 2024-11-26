import pytest

from pingpongsdk.deployments.model import CreateDeployment
from pingpongsdk import PingPong


@pytest.mark.parametrize(
    "name,deployment_req,expect_err,apikey",
    [
        (
            "Success API response with valid deployment request",
            CreateDeployment(
                name="Background Removal",
                args={"input": "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg"},
                model="844218fa-c5d0-4cee-90ce-0b42d226ac8d",
                sync=True,
            ),
            False,
            "xxxx-xxx-xxxx-xxx", # Replace with valid APIKey
        ),
        (
            "Error: Missing Model ID",
            CreateDeployment(
                name="Background Removal",
                args={"input": "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg"},
                model=None,  # Missing model ID
                sync=True,
            ),
            True,
            "xxxx-xxx-xxxx-xxx",# Replace with valid APIKey
        ),
        (
            "Error: Invalid input args",
            CreateDeployment(
                name="Background Removal",
                args={"test": "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg"},  # Invalid args
                model="844218fa-c5d0-4cee-90ce-0b42d226ac8d",
                sync=True,
            ),
            True,
            "xxxx-xxx-xxxx-xxx",# Replace with valid APIKey
        ),
        (
            "Error: Unauthorized user",
            CreateDeployment(
                name="Background Removal",
                model="844218fa-c5d0-4cee-90ce-0b42d226ac8d",
                args={
                    'input': 'https://cdn.mediamagic.dev/media/eb341446-be53-11ed-b4a8-66139910f724.jpg',
                },
                sync=True,
            ),
            True,
            "xxxx-xxx-xxxx-xxx",  # Invalid API key
        ),
    ],
)

def test_create_deployment(name, deployment_req, expect_err, apikey):
    """
    Test PingPong deployment creation with various scenarios.
    """
   
    pingpong = PingPong(api_key=apikey)

    if expect_err:
        with pytest.raises(Exception):
            pingpong.deployments.create(deployment=deployment_req)
    else:
        deployment = pingpong.deployments.create(deployment=deployment_req)
        
        assert deployment is not None, "Deployment response should not be None"
        assert deployment.job["status"] == "complete", "Deployment job status should be 'completed'"
        assert len(deployment.job["files"]) > 0, "Deployment job should contain files"


@pytest.mark.parametrize(
    "name,expect_err,apikey",
    [
        ("Success API response", False, "xxxx-xxx-xxxx-xxx"),# Replace with valid APIKey
        ("Error: Invalid API Key", True, "xxxx-xxx-xxxx-xxx"),
        ("Error: Missing API Key", True, ""),
    ],
)
def test_get_deployment(name, expect_err, apikey):
    """
    Test PingPong deployment listing with various scenarios.
    """
    if not apikey:
        with pytest.raises(ValueError, match="X_PINGPONG_KEY missing"):
            PingPong(api_key=apikey)
        return

    pingpong = PingPong(api_key=apikey)

    if expect_err:
        response = pingpong.deployments.list()

        assert "error" in response, "Error response expected but not found"
    else:
        response = pingpong.deployments.list()
        assert response is not None, "Response should not be None"

        assert response is not None, "Response should not be None"
        assert isinstance(response, dict), "Response should be a dictionary"


        deployments = response.get("deployments")
        assert len(deployments) > 0, "Deployments list should not be empty"


        first_deployment = deployments[0]
        assert "id" in first_deployment, "Deployment should contain 'id'"
        assert "name" in first_deployment, "Deployment should contain 'name'"
        assert "status" in first_deployment, "Deployment should contain 'status'"
        deployments = pingpong.deployments.list()
        

        assert deployments is not None, "Deployments response should not be None"
        assert len(deployments) > 0, "Deployments list should not be empty"
        
        
@pytest.mark.parametrize(
    "name, job_id, expect_err, apikey",
    [
        ("Success API response", "95f94401-0e02-47d6-9c7d-1b28418f11cc", False, "xxxx-xxx-xxxx-xxx"),# Replace with valid APIKey
        ("Error: Invalid Job ID", "invalid-job-id", True, "xxxx-xxx-xxxx-xxx"),# Replace with valid APIKey
        ("Error: Unauthorized User", "95f94401-0e02-47d6-9c7d-1b28418f11cc", True, "xxxx-xxx-xxxx-xxx"),
    ],
)
def test_get_job(name, job_id, expect_err, apikey):
    """
    Test PingPong GetJob API call with various scenarios.
    """
    if not apikey:
        with pytest.raises(ValueError, match="X_PINGPONG_KEY missing"):
            PingPong(api_key=apikey)
        return

    pingpong = PingPong(api_key=apikey)

    try:

        job = pingpong.deployments.get_job(job_id)


        if expect_err:
            assert job is not None, "Job response should not be None"
            assert isinstance(job, str), "Error response should be a string"
            assert "error" in job, "Error response expected but not found in the response"
            assert "message" not in job, "Expected error message in response"
            assert "HTTP error" in job, f"Expected error message, but got: {job}"
        
        else:
    
            assert job is not None, "Job response should not be None"
            assert isinstance(job, dict), "Job response should be a dictionary"
            assert job["id"] == job_id, f"Expected job ID to be {job_id}, got {job['id']}"

    except Exception as e:

        if not expect_err:
            pytest.fail(f"Unexpected error occurred: {e}")
        else:
    
            assert isinstance(e, ValueError) or isinstance(e, RuntimeError), (
                f"Expected a ValueError or RuntimeError, got {type(e)}: {str(e)}"
            )


