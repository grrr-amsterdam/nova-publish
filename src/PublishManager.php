<?php

namespace Publish;

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

    public function getLastRun()
    {
        $runs = $this->github
            ->get(config('publish.workflow_path') . '/runs', [
                'event' => 'workflow_dispatch',
            ])
            ->throw()
            ->json('workflow_runs');

        return collect($runs)
            ->where('conclusion', '!=', 'cancelled')
            ->sortByDesc('created_at')
            ->map(fn($response) => Run::createFromGithubResponse($response))
            ->first();
    }

    public function publish(string $ref)
    {
        return $this->github
            ->post(config('publish.workflow_path') . '/dispatches', [
                'ref' => $ref,
                'inputs' =>
                    config('publish.workflow_inputs') ?: new \stdClass(),
            ])
            ->throw()
            ->json();
    }
}