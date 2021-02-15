<?php

namespace Publish\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class PublishController
{
    public function __invoke()
    {
        $appVersion = config('app.version');
        if (!$appVersion) {
            throw new Exception('app.version not set');
        }

        return Http::withToken(config('publish.github_token'))
            ->withHeaders(['Accept' => 'application/vnd.github.v3+json'])
            ->post(
                'https://api.github.com/repos/grrr-amsterdam/tiim/actions/workflows/publish.yml/dispatches',
                [
                    'ref' => $appVersion,
                    'inputs' => ['environment' => App::environment()],
                ]
            )
            ->throw()
            ->json();
    }
}
