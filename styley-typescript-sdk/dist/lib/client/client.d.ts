declare class Client {
    private readonly apiKey;
    constructor(apiKey: string);
    get<T>(path: string): Promise<T | undefined>;
    post<I extends Record<string, unknown>, O>(path: string, body: I): Promise<O | undefined>;
    private errorFmt;
    private getHeaders;
}
export { Client };
