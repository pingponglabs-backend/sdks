type InputArgs = Record<string, any>;

type Job = {
  result: string[];
  credits_used: number;
};

export type Deployment = {
  name: string;
  model_id: string;
  job: Job;
};

export type DeploymentInput = {
  name: string;
  model_id: string;
  args: InputArgs;
};
