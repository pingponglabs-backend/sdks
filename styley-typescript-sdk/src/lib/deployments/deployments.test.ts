import { describe, expect, it } from "vitest";

import { Models } from '../models/models.js';
import { Deployments } from './deployments.js';

const MM_URL = "https://api-qa.mediamagic.ai"

const X_PINGPONG_KEY = process.env['X_PINGPONG_KEY'];
if (!X_PINGPONG_KEY) {
    throw new Error("X_PINGPONG_KEY is not defined in the environment variables");
}

let MM_BASE_URL = process.env['MM_BASE_URL'] || MM_URL;

describe('Deployments', () => {
    it('can create deployment', async () => {
        const models = new Models(X_PINGPONG_KEY,MM_BASE_URL);
        const client = new Deployments(X_PINGPONG_KEY, models,MM_BASE_URL);
        const deployment = await client.create({
            model: '844218fa-c5d0-4cee-90ce-0b42d226ac8d',
            name: 'test',
            args: {
                input_image_file: "https://cdn.mediamagic.dev/media/c7dbd266-3aa3-11ed-8e27-e679ed67c206.jpeg"
            },
        });
        if (deployment === undefined) {
            throw new Error('deployment is undefined');
        }
        expect(deployment.name === 'test');
    });
    it('can list deployments', async () => {
        const models = new Models(X_PINGPONG_KEY,MM_BASE_URL);
        const client = new Deployments(X_PINGPONG_KEY, models,MM_BASE_URL);
        const deployments = await client.list();
        if (deployments === undefined) {
            throw new Error('deployments is undefined');
        }
        expect(deployments.length > 0).toBe(true);
    });
});
