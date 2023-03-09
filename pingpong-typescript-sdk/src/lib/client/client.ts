import fetch from 'node-fetch';

const DEFAULT_HEADERS = {
  'Content-Type': 'application/json',
  Accept: 'application/json',
};

const BASE_URL = 'https://mediamagic.dev';

class Client {
  private readonly apiKey: string;

  constructor(apiKey: string) {
    this.apiKey = apiKey;
  }

  async get<T>(path: string): Promise<T> {
    try {
      const response = await fetch(`${BASE_URL}${path}`, {
        method: 'GET',
        headers: this.getHeaders(),
      });
      const json = (await response.json()) as T;
      return json;
    } catch (e) {
      throw new Error(this.errorFmt(e, 'POST', path));
    }
  }

  async post<I, O>(path: string, body: I): Promise<O> {
    try {
      const response = await fetch(`${BASE_URL}${path}`, {
        method: 'POST',
        headers: this.getHeaders(),
        body: JSON.stringify(body),
      });
      const json = (await response.json()) as O;
      return json;
    } catch (e) {
      throw new Error(this.errorFmt(e, 'POST', path));
    }
  }

  private errorFmt(e: Error, method: string, path: string): string {
    return `failed to perform ${method} request to ${path}. Reason: ${e.message}`;
  }

  private getHeaders(): Record<string, string> {
    return { 'x-mediamagic-key': this.apiKey, ...DEFAULT_HEADERS };
  }
}

export default Client;
