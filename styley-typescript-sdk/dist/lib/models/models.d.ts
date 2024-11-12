import { Client } from '../client/client.js';
import type { Model } from './model.js';
declare class Models extends Client {
    getByAlias(alias: string): Promise<Model | undefined>;
    getById(id: string): Promise<Model | undefined>;
    list(): Promise<readonly Model[] | undefined>;
}
export { Models };
