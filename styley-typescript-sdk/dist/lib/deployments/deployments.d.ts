import { Client } from '../client/client.js';
import { Models } from '../models/models.js';
import { Deployment, DeploymentInput } from './model.js';
interface DeploymentInputWithIndex extends DeploymentInput {
    [key: string]: unknown;
}
declare class Deployments extends Client {
    private modelsClient;
    constructor(apiKey: string, modelClient: Models);
    create(deployment: DeploymentInputWithIndex): Promise<Deployment | undefined>;
    list(): Promise<Deployment[] | undefined>;
}
export { Deployments };
