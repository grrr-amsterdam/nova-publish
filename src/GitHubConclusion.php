<?php

namespace Publish;

enum GitHubConclusion: string
{
    case success = "success";
    case failure = "failure";
    case cancelled = "cancelled";
    case skipped = "skipped";
    case startup_failure = "startup_failure";
}
