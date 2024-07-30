<?php

namespace PingPong\Deployments;

class Job
{
    public array $files;
    public int $creditsUsed;
    public int $eta;
    public string $status;

    public function __construct(
        ?array $files = null,
        ?int $creditsUsed = null,
        ?int $eta = null,
        ?string $status = null
    ) {
        $this->files = $files ?? [];
        $this->creditsUsed = $creditsUsed ?? 0;
        $this->eta = $eta ?? 0;
        $this->status = $status ?? '';
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function setFiles(array $files)
    {
        $this->files = $files;
    }

    public function getCreditsUsed(): int
    {
        return $this->creditsUsed;
    }

    public function setCreditsUsed(int $creditsUsed)
    {
        $this->creditsUsed = $creditsUsed;
    }

    public function getEta(): int
    {
        return $this->eta;
    }

    public function setEta(int $eta)
    {
        $this->eta = $eta;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }
}