<?php

namespace Publish;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PublishManager
{
    private $github;

    public function __construct()
    {
        $this->github = Http::withBasicAuth(
            config('publish.github_username'),
            config('publish.github_personal_access_token')
        )->withHeaders(['Accept' => 'application/vnd.github.v3+json']);
    }

    public function getRuns(): Collection
    {
        $workflowPath = config('publish.workflow_path');

        $runs = $this->github
            ->get("$workflowPath/runs")
            ->throw()
            ->json('workflow_runs');

        return collect($runs)
            ->sortByDesc('created_at')
            ->whenEmpty(function () use ($workflowPath) {
                throw Exception::noFirstRun($workflowPath);
            })
            ->map(fn($response) => Run::createFromGithubResponse($response));
    }

    public function getLastRun(): Run
    {
        return $this->getRuns()
            ->where('conclusion', '!=', Run::CONCLUSION_CANCELLED)
            ->first();
    }

    public function publish(string $ref): void
    {
        /** @var Run $run */
        $run = $this->getRuns()->first();

        if ($run->status !== Run::STATUS_COMPLETED) {
            return;
        }

        $this->github
            ->post(config('publish.workflow_path') . '/dispatches', [
                'ref' => $ref,
                'inputs' =>
                    config('publish.workflow_inputs') ?: new \stdClass(),
            ])
            ->throw()
            ->json();
    }
}
