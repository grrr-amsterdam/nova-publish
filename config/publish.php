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
    | GitHub workflow
    |--------------------------------------------------------------------------
    |
    | The name of the workflow file. For example: some-workflow.yml
    |
    */
    "workflow" => env("NOVA_PUBLISH_WORKFLOW"),

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
