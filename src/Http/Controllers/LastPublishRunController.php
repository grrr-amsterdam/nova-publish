<?php

namespace Publish\Http\Controllers;

use Publish\PublishManager;

class LastPublishRunController
{
    public function __invoke(PublishManager $manager)
    {
        return $manager->getLastRun();
    }
}
