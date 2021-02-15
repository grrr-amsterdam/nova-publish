<?php

namespace Publish\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LastPublishRunController
{
    public function __invoke()
    {
        $runs = Http::withToken(config('publish.github_token'))
            ->withHeaders(['Accept' => 'application/vnd.github.v3+json'])
            ->get(
                'https://api.github.com/repos/grrr-amsterdam/tiim/actions/workflows/publish.yml/runs',
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
