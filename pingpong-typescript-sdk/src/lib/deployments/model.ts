type InputArgs = Record<string, unknown>;

export interface Job {
  readonly result: string[];
  readonly credits_used: number;
}

export interface Deployment {
  readonly name: string;
  readonly model_id: string;
  readonly job: Job;
}

export interface DeploymentInput {
  name: string;
  model_id?: string;
  args: InputArgs;
  model: string;
}
