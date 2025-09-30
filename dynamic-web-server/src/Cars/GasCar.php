<?php

declare(strict_types=1);

namespace DynamicWebServer\Cars;

use DynamicWebServer\Engine\GasolineEngine;

class GasCar extends Car
{
    public function __construct(string $make, \DynamicWebServer\Logger\LoggerInterface $logger)
    {
        parent::__construct($make, new GasolineEngine($logger), $logger);
    }

    public function drive(): string
    {
        return "Driving the gas car...";
    }
}
