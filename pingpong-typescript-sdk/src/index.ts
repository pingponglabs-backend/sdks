import { Deployments } from './lib/deployments/deployments.js';
import { Models } from './lib/models/models.js';

export type { Deployment, DeploymentInput, Job } from './lib/deployments/model.js';
export type { Model } from './lib/models/model.js'

const { X_PINGPONG_KEY } = process.env;

// PingPong SDK factory
class PingPong {
    public readonly models: Models;
    public readonly deployments: Deployments;
 
    constructor(apiKey = X_PINGPONG_KEY!) {
        this.models = new Models(apiKey);
        this.deployments = new Deployments(apiKey, this.models);
    }
}

export { PingPong };
