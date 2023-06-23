import test from 'ava';

import Models from './models';

test('can list models', async (t) => {
  const modelsClient = new Models(process.env['X_PINGPONG_KEY']);
  const list = await modelsClient.list();
  t.true(list.length > 0);
});

test('can get model by id', async (t) => {
  const id = '';
  const modelsClient = new Models(process.env['X_PINGPONG_KEY']);
  const model = await modelsClient.getById(id);
  t.assert(model.id === id);
});

test('can get by alias', async (t) => {
  const alias = 'pingpongai/background-removal';
  const modelsClient = new Models(process.env['X_PINGPONG_KEY']);
  const model = await modelsClient.getByAlias(alias);
  t.assert(model.alias === alias);
});