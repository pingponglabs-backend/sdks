import { Client } from '../client/client.js';
import type { Model } from './model.js';

class Models extends Client {
  
  async getByName(name: string): Promise<Model | undefined> {
    try {
      return this.get<Model>(`/api/v1/models/name/${name}`);
    } catch (e) {
      if (e instanceof Error) {
        throw new Error(`failed to fetch model by alias: ${e.message}`);
      }
    }
  }

  async getById(id: string): Promise<Model | undefined> {
    try {
      return this.get<Model>(`/api/v1/models/${id}`);
    } catch (e) {
      if (e instanceof Error) {
        throw new Error(`failed to fetch model by ID: ${e.message}`);
      }
    }
  }

  async list(): Promise<readonly Model[] | undefined> {
    try {
      return this.get<readonly Model[]>('/api/v1/models');
    } catch (e) {
      if (e instanceof Error) {
        throw new Error(`failed to list models: ${e.message}`);
      }
    }
  }
}

export { Models };
