import { describe, expect, it } from 'vitest';

import { Models } from './models.js';

const MM_URL = "https://api-qa.mediamagic.ai"

const X_PINGPONG_KEY = process.env['X_PINGPONG_KEY'];
if (!X_PINGPONG_KEY) {
    throw new Error("X_PINGPONG_KEY is not defined in the environment variables");
}

let MM_BASE_URL = process.env['MM_BASE_URL'] || MM_URL;

describe('Models', () => {
  it('can get model by name', async () => {
    const name = 'Model Recommender';
    const modelsClient = new Models(X_PINGPONG_KEY,MM_BASE_URL);
    const model = await modelsClient.getByName(name);
    if (model === undefined) {
      throw new Error('model is undefined');
    }

    expect(model.name === name);
  });

  it('can list models', async () => {
    const modelsClient = new Models(X_PINGPONG_KEY,MM_BASE_URL);
    const list = await modelsClient.list();
    if (list === undefined) {
      throw new Error('list is undefined');
    }

    expect(list.length > 0);
  });

  it('can get model by id', async () => {
    const id = '6db33e45-29cf-4880-8ee0-3d9074c32e5e';
    const modelsClient = new Models(X_PINGPONG_KEY,MM_BASE_URL);
    const model = await modelsClient.getById(id);
    if (model === undefined) {
      throw new Error('model is undefined');
    }

    expect(model.id === id);
  });
});
