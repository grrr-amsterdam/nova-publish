<?php

namespace Tests;

use Publish\ToolServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $loadEnvironmentVariables = true;

    protected function defineEnvironment($app)
    {
        $app["config"]->set("publish.github_username", "username");
        $app["config"]->set(
            "publish.github_personal_access_token",
            "access_token"
        );
        $app["config"]->set(
            "publish.workflow_path",
            "https://api.github.com/repos/grrr-amsterdam/nova-publish/actions/workflows/some-workflow.yml"
        );
    }

    protected function getPackageProviders($app)
    {
        return [ToolServiceProvider::class];
    }
}
