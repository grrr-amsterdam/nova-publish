<?php

namespace Publish;

use Illuminate\Contracts\Support\Arrayable;

class Run implements Arrayable
{
    public ?GitHubConclusion $conclusion;

    public string $created_at;

    public GitHubStatus $status;

    public string $updated_at;

    public static function createFromGithubResponse(array $data): Run
    {
        $run = new self();
        $run->conclusion = $data["conclusion"]
            ? GitHubConclusion::from($data["conclusion"])
            : null;
        $run->created_at = $data["created_at"];
        $run->status = GitHubStatus::from($data["status"]);
        $run->updated_at = $data["updated_at"];
        return $run;
    }

    public function toArray()
    {
        return [
            "conclusion" => $this->conclusion?->value,
            "created_at" => $this->created_at,
            "status" => $this->status->value,
            "updated_at" => $this->updated_at,
        ];
    }
}
