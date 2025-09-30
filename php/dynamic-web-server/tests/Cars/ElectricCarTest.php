<?php

declare(strict_types=1);

use DynamicWebServer\Cars\ElectricCar;
use DynamicWebServer\Engine\ElectricEngine;
use DynamicWebServer\Logger\Logger;

describe('ElectricCar', function () {
    test('ElectricCarを正常に作成できる', function () {
        $logger = new Logger();
        $engine = new ElectricEngine($logger);
        $car = new ElectricCar('Tesla', $engine, $logger);
        
        expect($car->getMake())->toBe('Tesla');
    });

    test('ElectricCarを運転できる', function () {
        $logger = new Logger();
        $engine = new ElectricEngine($logger);
        $car = new ElectricCar('Nissan', $engine, $logger);
        
        $result = $car->drive();
        
        expect($result)->toBe('Driving the electric car...');
    });

    test('ElectricCarを起動するとログが出力される', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        $engine = new ElectricEngine($logger);
        $car = new ElectricCar('BMW', $engine, $logger);
        
        $car->start();
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('Starting car');
        expect($logContent)->toContain('BMW');
        expect($logContent)->toContain('Electric engine starting...');
        expect($logContent)->toContain('Car started successfully');
        
        // クリーンアップ
        unlink($logFile);
    });
});