<?php

namespace Publish;

enum GitHubStatus: string
{
    case completed = "completed";
    case queued = "queued";
    case in_progress = "in_progress";
}
