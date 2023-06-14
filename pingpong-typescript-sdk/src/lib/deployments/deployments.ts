import Client from '../client/client';
import Models from '../models/models';

import { Deployment, DeploymentInput, DeploymentRequest } from './model';

class Deployments extends Client {

    private models: Models;

    constructor(apiKey: string, models: Models) {
        super(apiKey);
        this.models = models;
    }

    async create(deployment: DeploymentInput): Promise<Deployment> {
        try {
            // Fetch the full model to get the id, not ideal, but we'll change later
            const model = await this.models.getByAlias(deployment.model);

            const deploymentRequest: DeploymentRequest = {
                name: deployment.name,
                model_id: model.id,
                args: deployment.args
            };

            return this.post<DeploymentRequest, Deployment>(
                '/api/v1/deployments',
                deploymentRequest,
            );
        } catch (e) {
            throw new Error(`error creating deployment: ${e.message}`);
        }
    }

    async list(): Promise<Deployment[]> {
        try {
            return this.get<Deployment[]>("/api/v1/deployments");
        } catch (e) {
            throw new Error(`error listing deployments: ${e.message}`);
        }
    }
}

export default Deployments;
