<?php

namespace DynamicWebServer\Common\Logger\Engine;

declare(strict_types=1);

use DynamicWebServer\Common\Logger\Interfaces\Engine;

class ElectoricEngine implements Engine
{
    // implementation of Engine interface methods
    public function start(): string
    {
        return "Starting the electric engine...";
    }
}
