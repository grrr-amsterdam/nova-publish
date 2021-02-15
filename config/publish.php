<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Github credentials
    |--------------------------------------------------------------------------
    |
    | Publish uses these credentials to connect to the Github API. The token
    | needs the "repo" and "workflow" scope.
    |
    */

    'github_username' => env('PUBLISH_GITHUB_USERNAME'),
    'github_personal_access_token' => env(
        'PUBLISH_GITHUB_PERSONAL_ACCESS_TOKEN'
    ),

    /*
    |--------------------------------------------------------------------------
    | Github workflow path
    |--------------------------------------------------------------------------
    |
    | The endpoint of the workflow used by the Github API calls. For example:
    | https://api.github.com/repos/vendor/project/actions/workflows/some-workflow.yml
    |
    | Replace "vendor", "project" and "some-workflow":
    | https://api.github.com/repos/grrr-amsterdam/nova-publish/actions/workflows/my-workflow_dispatch-workflow.yml
    |
    */
    'workflow_path'=> 'https://api.github.com/path/to/workflow.yml',

    /*
    |--------------------------------------------------------------------------
    | Git ref to publish
    |--------------------------------------------------------------------------
    |
    | A Git reference e.g. v1.2.3 or some-branch. It's probably not a fixed
    | value but a env var set by your CI pipeline.
    |
    */
    'git_ref' => env('PUBLISH_GIT_REF'),
];
