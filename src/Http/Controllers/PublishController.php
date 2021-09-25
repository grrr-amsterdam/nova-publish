<?php

namespace Publish\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Publish\PublishManager;

class PublishController
{
    public function __invoke(PublishManager $manager)
    {
        $ref = config('publish.git_ref');
        if (!$ref) {
            throw new Exception('publish.git_ref not set');
        }

        $manager->publish($ref);
    }
}
