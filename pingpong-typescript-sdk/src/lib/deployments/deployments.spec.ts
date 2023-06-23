import test from 'ava';
import Deployments from './deployments';
import Models from '../models/models';

test('can list deployments', async (t) => {
    const models = new Models(process.env['X_MEDIAMAGIC_KEY']);
    const client = new Deployments(process.env['X_MEDIAMAGIC_KEY'], models);
    const deployments = await client.list();
    t.assert(deployments.length > 0);
});
