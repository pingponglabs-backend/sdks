import { describe, expect, it } from 'vitest';

import { Models } from './models.js';

describe('Models', () => {
  it('can get model by alias', async () => {
    const alias = 'pingpongai/ai-image-scan';
    const modelsClient = new Models(process.env.X_PINGPONG_KEY!);
    const model = await modelsClient.getByAlias(alias);
    if (model === undefined) {
      throw new Error('model is undefined');
    }

    expect(model.alias === alias);
  });

  it('can list models', async () => {
    const modelsClient = new Models(process.env.X_PINGPONG_KEY!);
    const list = await modelsClient.list();
    if (list === undefined) {
      throw new Error('list is undefined');
    }

    expect(list.length > 0);
  });

  it('can get model by id', async () => {
    const id = '4954c9fd-7fc2-4d4c-a036-f23f7605fa69';
    const modelsClient = new Models(process.env.X_PINGPONG_KEY!);
    const model = await modelsClient.getById(id);
    if (model === undefined) {
      throw new Error('model is undefined');
    }

    expect(model.id === id);
  });
});
