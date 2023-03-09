import Client from '../client/client';

import { Model } from './model';

class Models extends Client {
  constructor(apiKey: string) {
    super(apiKey);
  }

  async getById(id: string): Promise<Model> {
    try {
      return this.get<Model>(`/api/v1/models/${id}`);
    } catch (e) {
      throw new Error(`failed to fetch model by ID: ${e.message}`);
    }
  }

  async list(): Promise<readonly Model[]> {
    try {
      return this.get<readonly Model[]>('/api/v1/models');
    } catch (e) {
      throw new Error(`failed to list models: ${e.message}`);
    }
  }
}

export default Models;
