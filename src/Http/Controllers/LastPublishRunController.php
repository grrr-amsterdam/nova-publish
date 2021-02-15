<?php

namespace Publish\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LastPublishRunController
{
    public function __invoke()
    {
        $runs = Http::withBasicAuth(
            config('publish.github_username'),
            config('publish.github_personal_access_token')
        )
            ->withHeaders(['Accept' => 'application/vnd.github.v3+json'])
            ->get(
                config('publish.workflow_path') . '/runs',
                [
                    'event' => 'workflow_dispatch',
                ]
            )
            ->throw()
            ->json('workflow_runs');

        return collect($runs)
            ->sortByDesc('created_at')
            ->first();
    }
}
