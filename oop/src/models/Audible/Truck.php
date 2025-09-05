<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';

/**
 * トラッククラス
 * 
 * AudibleInterfaceを実装した車両クラスです。
 * 音を出す機能を持つトラックを表現します。
 */
class Truck implements AudibleInterface
{
    /**
     * トラックの重量（kg）
     * 
     * @var float
     */
    private float $weightKg;

    /**
     * コンストラクタ
     * 
     * @param float $weightKg トラックの重量（kg）
     */
    public function __construct(float $weightKg)
    {
        $this->weightKg = $weightKg;
    }

    /**
     * 文字列表現を返す
     * 
     * @return string トラックの情報を含む文字列
     */
    public function __toString(): string
    {
        return "This is a truck that weights: {$this->weightKg}kg";
    }

    /**
     * トラックの音を出す（AudibleInterface実装）
     * 
     * @return void
     */
    public function makeNoise(): void
    {
        echo "Beep Beep!!" . PHP_EOL;
    }

    /**
     * 音の周波数を返す（AudibleInterface実装）
     * 
     * @return float 周波数（Hz）
     */
    public function soundFrequency(): float
    {
        return 165.0;
    }

    /**
     * 音のレベル（音量）を返す（AudibleInterface実装）
     * 
     * @return float 音量（dB）
     */
    public function soundLevel(): float
    {
        return 120.0;
    }
}
