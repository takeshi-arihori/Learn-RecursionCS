<?php

declare(strict_types=1);

namespace DynamicWebServer\Cars;

use DynamicWebServer\Interfaces\Engine;

use DynamicWebServer\Logger\LoggerInterface;

abstract class Car
{
    protected string $make;
    protected Engine $engine;
    protected LoggerInterface $logger;

    public function __construct(string $make, Engine $engine, LoggerInterface $logger)
    {
        $this->make = $make;
        $this->engine = $engine;
        $this->logger = $logger;
    }

    abstract public function drive(): string;

    public function start(): string
    {
        $this->logger->info("Starting car", ['make' => $this->make]);
        $result = $this->engine->start();
        $this->logger->info("Car started successfully", ['make' => $this->make]);
        return $result;
    }

    public function getMake(): string
    {
        return $this->make;
    }
}
