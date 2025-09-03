<?php

declare(strict_types=1);

namespace App\Common\Logger;

/**
 * ログレベルの定数クラス
 * 
 * @package App\Common\Logger
 */
class LogLevel
{
    public const DEBUG = 'DEBUG';
    public const INFO = 'INFO';
    public const WARNING = 'WARNING';
    public const ERROR = 'ERROR';
    public const CRITICAL = 'CRITICAL';

    /**
     * 有効なログレベルの配列を返す
     * 
     * @return array<string>
     */
    public static function getValidLevels(): array
    {
        return [
            self::DEBUG,
            self::INFO,
            self::WARNING,
            self::ERROR,
            self::CRITICAL,
        ];
    }

    /**
     * 指定されたログレベルが有効かどうかを判定
     * 
     * @param string $level
     * @return bool
     */
    public static function isValidLevel(string $level): bool
    {
        return in_array($level, self::getValidLevels(), true);
    }
}
