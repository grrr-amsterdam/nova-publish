<?php

namespace Publish;

class Exception extends \Exception
{
    public static function noFirstRun(string $workflow_path)
    {
        return new self(
            "Workflow $workflow_path hasn't run yet. Run it one time manually via GitHub to kickstart nova-publish."
        );
    }
}
