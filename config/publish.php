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
    | Replace "vendor", "project" and "some-workflow".
    |
    */
    'workflow_path'=> env('PUBLISH_WORKFLOW_PATH'),

];
