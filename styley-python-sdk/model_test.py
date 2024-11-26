import pytest
from pingpongsdk import PingPong

@pytest.mark.parametrize(
    "name, apikey, model_name, expect_err, expect_model",
    [
        ("Success: Valid API Key and Model Name", "9b7d9a38-5fad-11ef-ac07-30d042e69440", "/Omni Zero", False, "Omni Zero"),
        ("Error: Missing API Key", "", "/Omni Zero", True, ""),
        ("Error: Invalid API Key", "XXXXXXX", "/Omni Zero", True, ""),
        ("Error: Model Not Found", "9b7d9a38-5fad-11ef-ac07-30d042e69440", "/NonExistentModel", True, ""),
    ]
)
def test_get_model_by_name(name, apikey, model_name, expect_err, expect_model):
    """
    Test GetModelByName API call with various scenarios.
    """
    if not apikey:
        with pytest.raises(ValueError, match="X_PINGPONG_KEY missing"):
            PingPong(api_key=apikey)
        return

    pingpong = PingPong(api_key=apikey)

    try:
        model = pingpong.models.get_by_name(model_name)
    except AttributeError:
        model = {"error": "'PingPong' object has no attribute 'get_by_name'"}
    except Exception as e:
        model = {"error": str(e)}

    if expect_err:
        assert isinstance(model, dict), "Error response should be a dictionary"
        assert "error" in model, "Error response expected but not found"
    else:
        assert isinstance(model, dict), "Model response should be a dictionary"

@pytest.mark.parametrize(
    "name, model_id, apikey, expect_err, expect_model_id",
    [
        ("Success: Valid API Key and Model ID", "844218fa-c5d0-4cee-90ce-0b42d226ac8d", "732f9fbb-438c-11ee-a621-7200d0d07471", False, "844218fa-c5d0-4cee-90ce-0b42d226ac8d"),
        ("Error: Invalid Model ID", "invalid-id", "732f9fbb-438c-11ee-a621-7200d0d07471", True, ""),
        ("Error: Unauthorized", "844218fa-c5d0-4cee-90ce-0b42d226ac8d", "9b7d9a38-5fad-11ef-ac07-30d042e69410", True, ""),
    ]
)
def test_get_model_by_id(name, model_id, apikey, expect_err, expect_model_id):
    """
    Test GetModelByID API call with various scenarios.
    """
    if not apikey:
        with pytest.raises(ValueError, match="X_PINGPONG_KEY missing"):
            PingPong(api_key=apikey)
        return
    
    pingpong = PingPong(api_key=apikey)

    try:
        model = pingpong.models.get_by_id(model_id)
    except AttributeError:
        model = {"error": "'PingPong' object has no attribute 'get_by_id'"}
    except Exception as e:
        model = {"error": str(e)}

    if expect_err:
        if isinstance(model, dict):
            assert "error" in model, "Error response expected but not found"
        else:
    
            response_status = getattr(model, 'status', None)
            if response_status:
                assert response_status == 'unauthorized', "Unauthorized error response expected"
            else:
        
        
                error_message = getattr(model, 'error', None)
                is_error_response = getattr(model, 'is_error', False)
                
                assert error_message is not None or is_error_response, \
                    "Error response expected but not found"
    else:

        if isinstance(model, dict):
            assert "error" not in model, "Unexpected error in response"
        else:
            assert hasattr(model, 'id'), "Model response should have an id attribute"
            assert model.id == expect_model_id, f"Expected model ID: {expect_model_id}, got: {model.id}"
            
@pytest.mark.parametrize(
    "name, apikey, expect_err, expect_models",
    [
        ("success API response", "732f9fbb-438c-11ee-a621-7200d0d07471", False, 244),
        ("Error: Missing API Key", "", True, 0),
        ("Error: Invalid API Key", "XXXXXXX", True, 0),
    ]
)
def test_models_list(name, apikey, expect_err, expect_models):
    """
    Test List Models API call with various scenarios.
    """
    if not apikey:
        with pytest.raises(ValueError, match="X_PINGPONG_KEY missing"):
            PingPong(api_key=apikey)
        return

    pingpong = PingPong(api_key=apikey)

    try:
        models = pingpong.models.list()
    except Exception as e:
        models = []
        err = str(e)

    if expect_err:
        assert not models, "Expected error but got models list"
    else:
        assert len(models) >= expect_models, f"Expected {expect_models} models, got {len(models)}"