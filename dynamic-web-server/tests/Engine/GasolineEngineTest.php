<?php

declare(strict_types=1);

use DynamicWebServer\Engine\GasolineEngine;
use DynamicWebServer\Logger\Logger;

describe('GasolineEngine', function () {
    test('エンジンを正常に起動できる', function () {
        $logger = new Logger();
        $engine = new GasolineEngine($logger);
        
        $result = $engine->start();
        
        expect($result)->toBe('Starting the gasoline engine...');
    });

    test('エンジン起動時にログが出力される', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        $engine = new GasolineEngine($logger);
        
        $engine->start();
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('Gasoline engine starting...');
        expect($logContent)->toContain('[INFO]');
        
        // クリーンアップ
        unlink($logFile);
    });
});