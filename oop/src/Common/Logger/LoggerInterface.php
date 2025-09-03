<?php

declare(strict_types=1);

namespace App\Common\Logger;

/**
 * ログ出力インターフェース
 * PSR-3 LoggerInterfaceに類似した簡易版
 * 
 * @package App\Common\Logger
 */
interface LoggerInterface
{
    /**
     * 任意のレベルでログ出力
     * 
     * @param string $level ログレベル
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function log(string $level, string $message, array $context = []): void;

    /**
     * DEBUG レベルでログ出力
     * 
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function debug(string $message, array $context = []): void;

    /**
     * INFO レベルでログ出力
     * 
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function info(string $message, array $context = []): void;

    /**
     * WARNING レベルでログ出力
     * 
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function warning(string $message, array $context = []): void;

    /**
     * ERROR レベルでログ出力
     * 
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function error(string $message, array $context = []): void;

    /**
     * CRITICAL レベルでログ出力
     * 
     * @param string $message ログメッセージ
     * @param array<string, mixed> $context コンテキスト情報
     * @return void
     */
    public function critical(string $message, array $context = []): void;
}