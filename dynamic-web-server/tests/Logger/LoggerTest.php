<?php

declare(strict_types=1);

use DynamicWebServer\Logger\Logger;
use DynamicWebServer\Logger\LogLevel;

describe('Logger', function () {
    test('INFOレベルでログ出力できる', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        
        $logger->info('テストメッセージ');
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('テストメッセージ');
        expect($logContent)->toContain('[INFO]');
        
        unlink($logFile);
    });

    test('DEBUGレベルでログ出力できる', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        
        $logger->debug('デバッグ情報');
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('デバッグ情報');
        expect($logContent)->toContain('[DEBUG]');
        
        unlink($logFile);
    });

    test('WARNINGレベルでログ出力できる', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        
        $logger->warning('警告メッセージ');
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('警告メッセージ');
        expect($logContent)->toContain('[WARNING]');
        
        unlink($logFile);
    });

    test('ERRORレベルでログ出力できる', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        
        $logger->error('エラーメッセージ');
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('エラーメッセージ');
        expect($logContent)->toContain('[ERROR]');
        
        unlink($logFile);
    });

    test('CRITICALレベルでログ出力できる', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        
        $logger->critical('致命的エラー');
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('致命的エラー');
        expect($logContent)->toContain('[CRITICAL]');
        
        unlink($logFile);
    });

    test('コンテキスト情報を含むログ出力ができる', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        
        $logger->info('ユーザーログイン', ['user_id' => 123, 'ip' => '192.168.1.1']);
        
        $logContent = file_get_contents($logFile);
        expect($logContent)->toContain('ユーザーログイン');
        expect($logContent)->toContain('user_id');
        expect($logContent)->toContain('123');
        expect($logContent)->toContain('192.168.1.1');
        
        unlink($logFile);
    });

    test('空のメッセージは記録されない', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);
        
        $logger->info('');
        $logger->info('   ');
        
        expect(file_exists($logFile))->toBeFalse();
    });

    test('無効なログレベルでは例外が発生する', function () {
        $logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $logger = new Logger($logFile);

        expect(fn() => $logger->log('INVALID_LEVEL', 'メッセージ'))
            ->toThrow(InvalidArgumentException::class);
    });
});