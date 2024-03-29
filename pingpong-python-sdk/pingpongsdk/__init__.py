import os

from .deployments.deployments import Deployments
from .models.models import Models


_API_KEY = os.getenv('X_PINGPONG_KEY')


class PingPong():
    """
    PingPong - is a vanity class, which simply
    combined the underlying libraries into one
    object with the api configured for each etc.
    """

    models: Models
    deployments: Deployments

    def __init__(self, api_key=_API_KEY):
        if len(_API_KEY)==0:
            raise ValueError("X_PINGPONG_KEY missing")
        self.models = Models(api_key=api_key)
        self.deployments = Deployments(api_key=api_key, models=self.models)
