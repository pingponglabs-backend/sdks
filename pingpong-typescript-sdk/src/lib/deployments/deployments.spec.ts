import test from 'ava';
import Deployments from './deployments';

test('can list deployments', async (t) => {
    const client = new Deployments(process.env['X_MEDIAMAGIC_KEY']);
    const deployments = await client.list();
    t.assert(deployments.length > 0);
});
