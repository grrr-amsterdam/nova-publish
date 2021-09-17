<?php

namespace Tests;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Publish\Exception;
use Publish\PublishManager;

class TestPublishManager extends TestCase
{
    public function testLastRunThrowsException(): void
    {
        $this->expectException(Exception::class);
        Http::fake([
            'github.com/*' => Http::response(['workflow_runs' => []]),
        ]);

        $manager = new PublishManager();
        $manager->getLastRun();
    }

    public function testGetLastRun(): void
    {
        Carbon::setTestNow(now());

        Http::fake([
            'github.com/*' => Http::response(
                [
                    'workflow_runs' => [
                        [
                            'conclusion' => null,
                            'created_at' => now()->format(DATE_ATOM),
                            'updated_at' => '123',
                            'status' => 'asdf',
                        ],
                        [
                            'conclusion' => null,
                            'created_at' => now()
                                ->subMinute()
                                ->format(DATE_ATOM),
                            'updated_at' => '123',
                            'status' => 'asdf',
                        ],
                    ],
                ],
                200,
                []
            ),
        ]);

        $manager = new PublishManager();
        $actual = $manager->getLastRun();

        $this->assertSame(now()->format(DATE_ATOM), $actual->created_at);
        Carbon::setTestNow();
    }
}
