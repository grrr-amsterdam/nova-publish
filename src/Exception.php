<?php

namespace Publish;

class Exception extends \Exception
{
    public static function failedToSignData(): self
    {
        return new self("Failed to sign the JWT data.");
    }

    public static function gitHubAppNotInstalled(string $owner): self
    {
        return new self(
            "Organisation $owner not found in installations. Install the GitHub app in your organisation.",
            404
        );
    }

    public static function gitHubError(int $code, string $message): self
    {
        return new self("GitHub API error ($code): $message");
    }

    public static function invalidPrivateKey(): self
    {
        return new self(
            "'publish.private_key' contains an invalid private key."
        );
    }

    public static function noFirstRun(string $workflow): self
    {
        return new self(
            "Workflow $workflow hasn't run yet. Run it once manually via GitHub to kickstart nova-publish."
        );
    }
}
