<?php

namespace Publish\Events;

class PublicationWasStarted
{
    public function __construct(public string $ref)
    {
    }
}
