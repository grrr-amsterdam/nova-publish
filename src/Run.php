<?php

namespace Publish;

use Illuminate\Contracts\Support\Arrayable;

class Run implements Arrayable
{

    public ?string $conclusion;

    public string $created_at;

    public string $status;

    public string $updated_at;

    public static function createFromGithubResponse(array $data) {
        $run = new self();
        $run->conclusion = $data['conclusion'];
        $run->created_at = $data['created_at'];
        $run->status = $data['status'];
        $run->updated_at = $data['updated_at'];
        return $run;
    }

    public function toArray()
    {
        return [
            'conclusion' => $this->conclusion,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
        ];
    }
}
