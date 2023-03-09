import Client from '../client/client';

import { Deployment, DeploymentInput } from './model';

class Deployments extends Client {
    constructor(apiKey: string) {
        super(apiKey);
    }

    async create(deployment: DeploymentInput): Promise<Deployment> {
        try {
            return this.post<DeploymentInput, Deployment>(
                '/api/v1/deployments',
                deployment
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
