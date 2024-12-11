import { Deployments } from './lib/deployments/deployments.js';
import { Models } from './lib/models/models.js';
export type { Deployment, DeploymentInput, Job } from './lib/deployments/model.js';
export type { Model } from './lib/models/model.js';
declare class Styley {
    readonly models: Models;
    readonly deployments: Deployments;
    constructor(apiKey?: string);
}
export { Styley };
