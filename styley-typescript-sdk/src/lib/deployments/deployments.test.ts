import { describe, expect, it } from "vitest";

import { Models } from '../models/models.js';
import { Deployments } from './deployments.js';

const MM_URL = "https://api-qa.mediamagic.ai"

const X_STYLEY_KEY = process.env['X_STYLEY_KEY'];
if (!X_STYLEY_KEY) {
    throw new Error("X_STYLEY_KEY is not defined in the environment variables");
}

let MM_BASE_URL = process.env['MM_BASE_URL'] || MM_URL;

describe('Deployments', () => {
    it('can create deployment', async () => {
        const models = new Models(X_STYLEY_KEY,MM_BASE_URL);
        const client = new Deployments(X_STYLEY_KEY, models,MM_BASE_URL);
        const deployment = await client.create({
            name: 'Model Recommender',
            model: '1bee9b0e-94f4-4552-a4d1-28982f10213f',
            args: {
                'image_path': 'https://cdn.mediamagic.dev/media/efd5bc26-a0ce-11ef-b716-30d042e69440.jpg'
            },
        });
        if (deployment === undefined) {
            throw new Error('deployment is undefined');
        }
        expect(deployment.name === 'Model Recommender');
    });
    it('can list deployments', async () => {
        const models = new Models(X_STYLEY_KEY, MM_BASE_URL);
        const client = new Deployments(X_STYLEY_KEY, models, MM_BASE_URL);
        const deployments = await client.list();
        if (!deployments || deployments.length === 0) {
            throw new Error('No deployments found');
        }
        
    });
    it('can list delpoyment by ID', async () => {
        const models = new Models(X_STYLEY_KEY, MM_BASE_URL);
        const client = new Deployments(X_STYLEY_KEY, models, MM_BASE_URL);
        const jobs = await client.getJob("9f433911-09e1-4f5f-a1c6-a4edfbdfa277")
        if (!jobs) {
            throw new Error('No jobs found with this ID');
        }
    })    
});
