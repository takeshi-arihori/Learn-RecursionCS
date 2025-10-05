<?php

declare(strict_types=1);

namespace DynamicWebServer\Engine;

use DynamicWebServer\Interfaces\Engine;

class ElectricEngine implements Engine
{
    private \DynamicWebServer\Logger\LoggerInterface $logger;

    public function __construct(\DynamicWebServer\Logger\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function start(): string
    {
        $this->logger->info("Electric engine starting...");
        $result = "Starting the electric engine...";
        $this->logger->debug("Electric engine started successfully");
        return $result;
    }
}
