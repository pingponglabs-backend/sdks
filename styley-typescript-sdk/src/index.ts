import { Deployments } from './lib/deployments/deployments.js';
import { Models } from './lib/models/models.js';
import dotenv from 'dotenv';
dotenv.config();

export type { Deployment, DeploymentInput, Job } from './lib/deployments/model.js';
export type { Model } from './lib/models/model.js';

const MM_URL = "https://api-qa.mediamagic.ai"

const X_STYLEY_KEY = process.env['X_STYLEY_KEY'];
if (!X_STYLEY_KEY) {
    throw new Error("X_STYLEY_KEY is not defined in the environment variables");
}

let MM_BASE_URL = process.env['MM_HOST_URL'] || MM_URL;
class PingPong {
    public readonly models: Models;
    public readonly deployments: Deployments;

    constructor(apiKey: string = X_STYLEY_KEY || "", mm_url: string = MM_BASE_URL) {
        this.models = new Models(apiKey, mm_url);
        this.deployments = new Deployments(apiKey, this.models, mm_url);
    }
}

export { PingPong };
