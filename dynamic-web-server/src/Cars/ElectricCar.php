<?php

declare(strict_types=1);

namespace DynamicWebServer\Cars;

use DynamicWebServer\Engine\ElectricEngine;

class ElectricCar extends Car
{
    public function __construct(string $make, ElectricEngine $engine, \DynamicWebServer\Logger\LoggerInterface $logger)
    {
        parent::__construct($make, $engine, $logger);
    }

    public function drive(): string
    {
        return "Driving the electric car...";
    }
}
