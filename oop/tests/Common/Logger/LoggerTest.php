<?php

declare(strict_types=1);

namespace App\Tests\Common\Logger;

use App\Common\Logger\Logger;
use App\Common\Logger\LoggerInterface;
use App\Common\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    private Logger $logger;
    private string $testLogFile;

    protected function setUp(): void
    {
        // テスト用のログファイルパスを設定
        $this->testLogFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $this->logger = new Logger($this->testLogFile);
    }

    protected function tearDown(): void
    {
        // テスト後にログファイルを削除
        if (file_exists($this->testLogFile)) {
            unlink($this->testLogFile);
        }
    }

    public function testLoggerImplementsLoggerInterface(): void
    {
        $this->assertInstanceOf(LoggerInterface::class, $this->logger);
    }

    public function testLoggerCanLogInfoMessage(): void
    {
        // Given: ログメッセージ
        $message = 'Test info message';

        // When: INFOレベルでログ出力
        $this->logger->log(LogLevel::INFO, $message);

        // Then: ログファイルにメッセージが記録される
        $this->assertFileExists($this->testLogFile);
        $logContent = file_get_contents($this->testLogFile);
        $this->assertStringContainsString($message, $logContent);
        $this->assertStringContainsString('[INFO]', $logContent);
    }

    public function testLoggerCanLogErrorMessage(): void
    {
        // Given: エラーメッセージ
        $message = 'Test error message';

        // When: ERRORレベルでログ出力
        $this->logger->log(LogLevel::ERROR, $message);

        // Then: ログファイルにエラーメッセージが記録される
        $logContent = file_get_contents($this->testLogFile);
        $this->assertStringContainsString($message, $logContent);
        $this->assertStringContainsString('[ERROR]', $logContent);
    }

    public function testLoggerCanLogWarningMessage(): void
    {
        // Given: 警告メッセージ
        $message = 'Test warning message';

        // When: WARNINGレベルでログ出力
        $this->logger->log(LogLevel::WARNING, $message);

        // Then: ログファイルに警告メッセージが記録される
        $logContent = file_get_contents($this->testLogFile);
        $this->assertStringContainsString($message, $logContent);
        $this->assertStringContainsString('[WARNING]', $logContent);
    }

    public function testLoggerCanLogDebugMessage(): void
    {
        // Given: デバッグメッセージ
        $message = 'Test debug message';

        // When: DEBUGレベルでログ出力
        $this->logger->log(LogLevel::DEBUG, $message);

        // Then: ログファイルにデバッグメッセージが記録される
        $logContent = file_get_contents($this->testLogFile);
        $this->assertStringContainsString($message, $logContent);
        $this->assertStringContainsString('[DEBUG]', $logContent);
    }

    public function testLoggerIncludesTimestamp(): void
    {
        // Given: ログメッセージ
        $message = 'Test timestamp message';

        // When: ログ出力
        $this->logger->log(LogLevel::INFO, $message);

        // Then: タイムスタンプが含まれる
        $logContent = file_get_contents($this->testLogFile);
        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $logContent);
    }

    public function testLoggerCanLogWithContext(): void
    {
        // Given: コンテキスト付きメッセージ
        $message = 'User action performed';
        $context = ['user_id' => 123, 'action' => 'login'];

        // When: コンテキスト付きでログ出力
        $this->logger->log(LogLevel::INFO, $message, $context);

        // Then: コンテキスト情報も記録される
        $logContent = file_get_contents($this->testLogFile);
        $this->assertStringContainsString($message, $logContent);
        $this->assertStringContainsString('user_id', $logContent);
        $this->assertStringContainsString('123', $logContent);
    }

    public function testLoggerHandlesEmptyMessage(): void
    {
        // Given: 空のメッセージ
        $message = '';

        // When: 空メッセージでログ出力
        $this->logger->log(LogLevel::INFO, $message);

        // Then: 空のメッセージは記録されない（ログファイルも作成されない）
        $this->assertFileDoesNotExist($this->testLogFile);
    }

    public function testLoggerCreatesLogFileIfNotExists(): void
    {
        // Given: 存在しないログファイルパス
        $newLogFile = sys_get_temp_dir() . '/new_test_' . uniqid() . '.log';
        $newLogger = new Logger($newLogFile);

        // When: ログ出力
        $newLogger->log(LogLevel::INFO, 'Test message');

        // Then: ログファイルが作成される
        $this->assertFileExists($newLogFile);

        // Clean up
        if (file_exists($newLogFile)) {
            unlink($newLogFile);
        }
    }
}
