import fetch from 'cross-fetch';

const DEFAULT_HEADERS: Record<string, string> = {
  'Content-Type': 'application/json',
  Accept: 'application/json',
};

class Client {
  private readonly apiKey: string;
  private readonly mmUrl: string;

  constructor(apiKey: string, mmUrl: string) {
    this.apiKey = apiKey;
    this.mmUrl = mmUrl
  }

  async get<T>(path: string): Promise<T | undefined> {
    try {
      if (this.apiKey == "") {
        throw new Error("X_PINGPONG_KEY is missing");
      }
      if (this.mmUrl == "") {
        throw new Error("MM_BASE_URL is missing");
      }

      const response = await fetch(`${this.mmUrl}${path}`, {
        method: 'GET',
        headers: this.getHeaders(),
      });
      if (response.status !== 200) {
        throw new Error("status: " + response.status);
      }
      const json = (await response.json()) as T;
      return json;
    } catch (e) {
      if (e instanceof Error) {
        throw new Error(this.errorFmt(e, 'POST', path));
      }
    }
  }

  async post<I extends Record<string, unknown>, O>(path: string, body: I): Promise<O | undefined> {
    try {
      if (this.apiKey === "") throw new Error("X_PINGPONG_KEY is missing");
      if (this.mmUrl === "") throw new Error("MM_BASE_URL is missing");
  
      const response = await fetch(`${this.mmUrl}${path}`, {
        method: 'POST',
        headers: this.getHeaders(),
        body: JSON.stringify(body),
      });
      if (response.status !== 200) {
        const errorDetails = await response.text();
        throw new Error(`error in response: ${response.statusText}, details: ${errorDetails}`);
      }
      const json = (await response.json()) as O;
      return json;
    } catch (e) {
      if (e instanceof Error) {
        throw new Error(this.errorFmt(e, 'POST', path));
      }
    }
  }

  private errorFmt(e: Error, method: string, path: string): string {
    return `failed to perform ${method} request to ${path}. Reason: ${e.message}`;
  }

  private getHeaders(): Record<string, string> {
    return { 'x-mediamagic-key': this.apiKey, ...DEFAULT_HEADERS };
  }
}

export { Client };
