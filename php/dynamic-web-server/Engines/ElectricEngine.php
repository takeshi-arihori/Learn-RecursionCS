<?php

declare(strict_types=1);

namespace Engines;

use Interfaces\Engine;

class ElectricEngine implements Engine {
    public function start(): string {
        return "Starting the electric engine...";
    }
}
