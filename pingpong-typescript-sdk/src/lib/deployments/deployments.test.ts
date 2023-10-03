import { describe, expect, it } from "vitest";

import { Models } from '../models/models.js';
import { Deployments } from './deployments.js';

describe('Deployments', () => {
    it('can create deployment', async () => {
        const models = new Models(process.env.X_PINGPONG_KEY!);
        const client = new Deployments(process.env.X_PINGPONG_KEY!, models);
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
        const models = new Models(process.env.X_PINGPONG_KEY!);
        const client = new Deployments(process.env.X_PINGPONG_KEY!, models);
        const deployments = await client.list();
        if (deployments === undefined) {
            throw new Error('deployments is undefined');
        }
        expect(deployments.length > 0).toBe(true);
    });
});
