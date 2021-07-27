<?php

namespace Publish\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class PublishController
{
    public function __invoke()
    {
        $ref = config('publish.git_ref');
        if (!$ref) {
            throw new Exception('publish.git_ref not set');
        }

        return Http::withBasicAuth(
            config('publish.github_username'),
            config('publish.github_personal_access_token')
        )
            ->withHeaders(['Accept' => 'application/vnd.github.v3+json'])
            ->post(
                config('publish.workflow_path') . '/dispatches',
                [
                    'ref' => $ref,
                    'inputs' => config('publish.workflow_inputs') ?: new \stdClass(),
                ]
            )
            ->throw()
            ->json();
    }
}
