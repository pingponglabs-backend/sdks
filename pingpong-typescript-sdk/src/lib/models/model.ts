type Arg = {
  readonly type: string;
  readonly optional: boolean;
  readonly example: string;
  readonly option_choices: readonly string[];
};

type Args = Record<string, Arg>;

type Example = {
  readonly title: string;
  readonly description: string;
  readonly args: Args;
  readonly outputs: readonly string[];
};

type Examples = readonly Example[];

export type Model = {
  readonly id: string;
  readonly name: string;
  readonly description: string;
  readonly args: readonly Arg[];
  readonly video: string;
  readonly image: string;
  readonly examples: Examples;
};
