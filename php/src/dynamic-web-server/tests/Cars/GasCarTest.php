<?php

declare(strict_types=1);

use DynamicWebServer\Cars\GasCar;
use DynamicWebServer\Logger\Logger;

describe('GasCar', function () {
    test('GasCarを正常に作成できる', function () {
        $logger = new Logger();
        $car = new GasCar('Toyota', $logger);
        
        expect($car->getMake())->toBe('Toyota');
    });

    test('GasCarを運転できる', function () {
        $logger = new Logger();
        $car = new GasCar('Honda', $logger);
        
        $result = $car->drive();
        
        expect($result)->toBe('Driving the gas car...');
    });

    test('GasCarを起動するとログが出力される', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        $car = new GasCar('Ford', $logger);
        
        $car->start();
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('Starting car');
        expect($logContent)->toContain('Ford');
        expect($logContent)->toContain('Car started successfully');
        
        // クリーンアップ
        unlink($logFile);
    });
});