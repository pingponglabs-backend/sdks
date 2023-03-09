import Deployments from './lib/deployments/deployments';
import Models from './lib/models/models';

const _X_MEDIAMAGIC_KEY = process.env['X_MEDIAMAGIC_KEY'];

// OneUp SDK factory
class OneUp {

    public models: Models;

    public deployments: Deployments;

    constructor(apiKey = _X_MEDIAMAGIC_KEY) {
        this.models = new Models(apiKey);
        this.deployments = new Deployments(apiKey);
    }
}

export default OneUp;
