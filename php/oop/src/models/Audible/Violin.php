<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';

/**
 * バイオリンクラス
 *
 * AudibleInterfaceを実装した楽器クラスです。
 * 美しい音色を奏でるバイオリンを表現します。
 */
class Violin implements AudibleInterface
{
    /**
     * バイオリンの音の周波数（Hz）
     * デフォルトは659.3Hz（E5音程）
     *
     * @var float
     */
    private float $soundFrequency = 659.3;

    /**
     * バイオリンの音量レベル（dB）
     *
     * @var float
     */
    private const SOUND_DECIBELS = 95.0;

    /**
     * 文字列表現を返す
     *
     * @return string バイオリンの情報を含む文字列
     */
    public function __toString(): string
    {
        return 'This is a violin that plays music: ';
    }

    /**
     * バイオリンの音を出す（AudibleInterface実装）
     *
     * @return void
     */
    public function makeNoise(): void
    {
        echo 'Beep Beep!!' . PHP_EOL;
    }

    /**
     * 音の周波数を返す（AudibleInterface実装）
     *
     * @return float 周波数（Hz）
     */
    public function soundFrequency(): float
    {
        return $this->soundFrequency;
    }

    /**
     * 音のレベル（音量）を返す（AudibleInterface実装）
     *
     * @return float 音量（dB）
     */
    public function soundLevel(): float
    {
        return self::SOUND_DECIBELS;
    }
}
