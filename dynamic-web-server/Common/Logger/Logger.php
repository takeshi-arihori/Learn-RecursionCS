<?php

declare(strict_types=1);

namespace DynamicWebServer\Common\Logger;

use DateTime;

/**
 * ログ出力クラス
 * ファイルベースのシンプルなログ出力機能を提供
 *
 * @package App\Common\Logger
 */
class Logger implements LoggerInterface
{
    private string $logFilePath;

    /**
     * コンストラクタ
     *
     * @param string|null $logFilePath ログファイルのパス（nullの場合はデフォルトパスを使用）
     */
    public function __construct(?string $logFilePath = null)
    {
        $this->logFilePath = $logFilePath ?? $this->getDefaultLogPath();
        $this->ensureLogDirectoryExists();
    }

    /**
     * 任意のレベルでログ出力
     *
     * @param string $level ログレベル
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function log(string $level, string $message, array $context = []): void
    {
        // 空のメッセージは記録しない
        if (empty(trim($message))) {
            return;
        }

        // ログレベルの検証
        if (!LogLevel::isValidLevel($level)) {
            throw new \InvalidArgumentException("Invalid log level: {$level}");
        }

        $formattedMessage = $this->formatLogMessage($level, $message, $context);
        $this->writeToFile($formattedMessage);
    }

    /**
     * DEBUG レベルでログ出力
     *
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function debug(string $message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * INFO レベルでログ出力
     *
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function info(string $message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * WARNING レベルでログ出力
     *
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function warning(string $message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * ERROR レベルでログ出力
     *
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function error(string $message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * CRITICAL レベルでログ出力
     *
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function critical(string $message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * デフォルトのログファイルパスを取得
     *
     * @return string
     */
    private function getDefaultLogPath(): string
    {
        $logDir = dirname(__DIR__, 4) . '/oop/logs';

        // デフォルトのログディレクトリを設定(Timestamp付き, Asia/Tokyo)
        date_default_timezone_set('Asia/Tokyo');
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        // ログファイル名を固定(prefix, 日付)
        $logFileName = 'app_' . date('Ymd') . '.log';
        return $logDir . '/' . $logFileName;
    }

    /**
     * ログディレクトリが存在することを確認（存在しない場合は作成）
     *
     * @return void
     */
    private function ensureLogDirectoryExists(): void
    {
        $logDir = dirname($this->logFilePath);

        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
    }

    /**
     * ログメッセージをフォーマット
     *
     * @param string $level ログレベル
     * @param string $message メッセージ
     * @param array<string, mixed> $context コンテキスト
     * @return string
     */
    private function formatLogMessage(string $level, string $message, array $context = []): string
    {
        $timestamp = (new DateTime())->format('Y-m-d H:i:s');
        $contextString = empty($context) ? '' : ' ' . json_encode($context, JSON_UNESCAPED_UNICODE);

        return "[{$timestamp}] [{$level}] {$message}{$contextString}" . PHP_EOL;
    }

    /**
     * ログファイルに書き込み
     *
     * @param string $message フォーマット済みメッセージ
     * @return void
     */
    private function writeToFile(string $message): void
    {
        file_put_contents($this->logFilePath, $message, FILE_APPEND | LOCK_EX);
    }
}
