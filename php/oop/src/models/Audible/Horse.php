<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';

/**
 * 馬クラス
 *
 * AudibleInterfaceを実装した動物クラスです。
 * 音を出す動物としての機能を持つ馬を表現します。
 */
class Horse implements AudibleInterface
{
    /**
     * 馬の重量（kg）
     *
     * @var float
     */
    private float $weightKg;

    /**
     * 馬のいななきの周波数（Hz）
     *
     * @var float
     */
    private float $soundFrequency = 120.0;

    /**
     * 馬のいななきの音量（dB）
     *
     * @var float
     */
    private float $soundDecibels = 75.0;

    /**
     * コンストラクタ
     *
     * @param float $weightKg 馬の重量（kg）
     */
    public function __construct(float $weightKg)
    {
        $this->weightKg = $weightKg;
    }

    /**
     * 文字列表現を返す
     *
     * @return string 馬の情報を含む文字列
     */
    public function __toString(): string
    {
        return "This is a horse that weighs: {$this->weightKg}kg";
    }

    /**
     * 馬のいななきを出す（AudibleInterface実装）
     *
     * @return void
     */
    public function makeNoise(): void
    {
        echo 'Neeighh!!' . PHP_EOL;
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
        return $this->soundDecibels;
    }
}
