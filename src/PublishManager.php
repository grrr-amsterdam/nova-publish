<?php

namespace Publish;

use DateTime;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;
use Publish\Events\PublicationWasStarted;

class PublishManager
{
    public function __construct(
        private GitHubApi $gitHubApi,
        private Repository $cache,
        private string $workflow
    ) {
    }

    public function getRuns(): Collection
    {
        $runs = $this->gitHubApi->getRuns(
            $this->getGitHubAccessToken(),
            $this->workflow
        );

        return collect($runs)
            ->sortByDesc("created_at")
            ->whenEmpty(function () {
                throw Exception::noFirstRun($this->workflow);
            })
            ->map(fn($response) => Run::createFromGithubResponse($response));
    }

    public function getLastRun(): Run
    {
        return $this->getRuns()
            ->where("conclusion", "!=", GitHubConclusion::cancelled->value)
            ->first();
    }

    public function publish(string $ref): void
    {
        /** @var Run $run */
        $run = $this->getRuns()->first();

        if ($run->status !== GitHubStatus::completed) {
            return;
        }

        event(new PublicationWasStarted($ref));

        $this->gitHubApi->dispatchWorkflow(
            $this->getGitHubAccessToken(),
            $this->workflow,
            $ref
        );
    }

    protected function getGitHubAccessToken(): string
    {
        $cacheKey = "nova-publish-github-access-token";

        /** @var string|null $accessToken */
        $accessToken = $this->cache->get($cacheKey);

        if ($accessToken) {
            return $accessToken;
        }

        $installation = $this->gitHubApi->getInstallation();

        /** @var array{token: string, expires_at: int} $accessToken */
        $accessToken = $this->gitHubApi->getAccessToken(
            $installation["access_tokens_url"]
        );

        $this->cache->set(
            $cacheKey,
            $accessToken["token"],
            (new DateTime($accessToken["expires_at"]))->getTimestamp() -
                (new DateTime())->getTimestamp()
        );

        return $accessToken["token"];
    }
}
