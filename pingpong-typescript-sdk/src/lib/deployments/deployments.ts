import { Client } from '../client/client.js';
import { Models } from '../models/models.js';
import { Deployment, DeploymentInput } from './model.js';

interface DeploymentInputWithIndex extends DeploymentInput {
    [key: string]: unknown;
}

class Deployments extends Client {
    private modelsClient: Models;

    constructor(apiKey: string, modelClient: Models) {
        super(apiKey);
        this.modelsClient = modelClient;
    }

    async create(deployment: DeploymentInputWithIndex): Promise<Deployment | undefined> {
        let model;
        try {
            model = await this.modelsClient.getByAlias(deployment.model);
        } catch (e) {
            if (e instanceof Error) {
                throw new Error(`error fetching model: ${e.message}`);
            }
        }

        // Replace model alias with model ID
        deployment.model_id = model?.id;
        try {
            return this.post<DeploymentInputWithIndex, Deployment>(
                '/api/v1/deployments',
                deployment,
            );
        } catch (e) {
            if (e instanceof Error) {
                throw new Error(`error creating deployment: ${e.message}`);
            }
        }
    }

    async list(): Promise<Deployment[] | undefined> {
        try {
            return this.get<Deployment[]>("/api/v1/deployments");
        } catch (e: unknown) {
            if (e instanceof Error) {
                throw new Error(`error listing deployments: ${e.message}`);
            }
        }
    }
}

export { Deployments };
