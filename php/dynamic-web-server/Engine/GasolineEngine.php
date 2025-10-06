<?php

declare(strict_types=1);

namespace DynamicWebServer\Engine;

use DynamicWebServer\Interfaces\Engine;

class GasolineEngine implements Engine
{
    private \DynamicWebServer\Logger\LoggerInterface $logger;

    public function __construct(\DynamicWebServer\Logger\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function start(): string
    {
        $this->logger->info("Gasoline engine starting...");
        $result = "Starting the gasoline engine...";
        $this->logger->debug("Gasoline engine started successfully");
        return $result;
    }
}
