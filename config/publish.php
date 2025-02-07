<?php

return [
    /*
    |--------------------------------------------------------------------------
    | GitHub App credentials
    |--------------------------------------------------------------------------
    |
    | Publish uses these credentials to connect to the GitHub API. The token
    | needs the "repo" and "workflow" scope.
    |
    */

    "application_id" => env("NOVA_PUBLISH_APPLICATION_ID"),
    "private_key" => env("NOVA_PUBLISH_PRIVATE_KEY"),

    /*
    |--------------------------------------------------------------------------
    | GitHub repository information
    |--------------------------------------------------------------------------
    |
    */

    "owner" => env("NOVA_PUBLISH_OWNER", "norday-agency"),
    "repository" => env("NOVA_PUBLISH_REPOSITORY"),

    /*
    |--------------------------------------------------------------------------
    | GitHub workflow path
    |--------------------------------------------------------------------------
    |
    | The endpoint of the workflow used by the GitHub API calls. For example:
    | https://api.github.com/repos/vendor/project/actions/workflows/some-workflow.yml
    |
    | Replace "vendor", "project" and "some-workflow":
    | https://api.github.com/repos/grrr-amsterdam/nova-publish/actions/workflows/my-workflow_dispatch-workflow.yml
    |
    */
    "workflow" => env("NOVA_PUBLISH_WORKFLOW"),

    /*
    |--------------------------------------------------------------------------
    | Workflow inputs
    |--------------------------------------------------------------------------
    |
    | Inputs for the workflow. The inputs must be defined in the workflow file:
    | https://docs.github.com/en/actions/reference/workflow-syntax-for-github-actions#onworkflow_dispatchinputs
    |
    | An example:
    | ['environment' => env('APP_ENV')]
    |
    */
    "workflow_inputs" => [],

    /*
    |--------------------------------------------------------------------------
    | Git ref to publish
    |--------------------------------------------------------------------------
    |
    | A Git reference e.g. v1.2.3 or some-branch. It's probably not a fixed
    | value but a env var set by your CI pipeline.
    |
    */
    "git_ref" => env("PUBLISH_GIT_REF"),
];
