import { Client } from '../client/client.js';
import { Models } from '../models/models.js';
import { Deployment, DeploymentInput, Job } from './model.js';

const COMPLETE = 'complete';
const FAILED = 'failed';
const DOCKER_PULLING = "docker_pulling";
const STARTING = 'starting'

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
            model = await this.modelsClient.getById(deployment.model);
        } catch (e) {
            if (e instanceof Error) {
                throw new Error(`error fetching model: ${e.message}`);
            }
        }
        deployment.model_id = model?.id;
        try {
            let actualResponse = await this.post<DeploymentInputWithIndex, Deployment>(
                '/api/v1/deployments',
                deployment,
            );
            if (actualResponse != undefined) {
                let eta = (actualResponse.job.eta * 3) + 120;
                if (deployment.sync) {
                    while (actualResponse.status !== COMPLETE && actualResponse.status !== FAILED && eta > 0) {
                        await this.sleep(10 * 1000);
                        let job = await this.getJob(actualResponse.job_id)
                        if (job != undefined) {
                            if (job.status !== DOCKER_PULLING && job.status != STARTING) {
                                eta -= 10;
                            }
                            actualResponse.job = job;
                            actualResponse.logs = job.logs;
                            actualResponse.status = job.status;
                        }
                    }
                }
            }
            return actualResponse;
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

    async getJob(id: string): Promise<Job | undefined> {
        try {
            return this.get<Job>(`/api/v1/jobs/${id}`);
        } catch (e: unknown) {
            if (e instanceof Error) {
                throw new Error(`error getting job status: ${e.message}`);
            }
        }
    }
    async sleep(ms: number): Promise<void> {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}

export { Deployments };

