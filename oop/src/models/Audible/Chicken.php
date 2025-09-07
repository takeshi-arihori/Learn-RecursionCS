<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';
require_once __DIR__ . '/EdibleInterface.php';

/**
 * Chickenクラス - 鶏を表現するクラス
 *
 * AudibleInterfaceとEdibleInterfaceの両方を実装し、
 * 音を出す動物として、そして食べ物としての機能を提供します。
 * 鶏は「コケコッコー」という鳴き声を持つ鳥として表現されます。
 *
 * @package App\Models\Audible
 * @author Claude Code
 * @version 2.0.0
 * @since 2025-01-27
 */
class Chicken implements AudibleInterface, EdibleInterface
{
    /**
     * 鶏の重量（kg）
     *
     * @var float
     */
    private float $weightKg;

    /**
     * 鶏の鳴き声の周波数（Hz）
     *
     * @var float
     */
    private float $soundFrequency = 500.0;

    /**
     * 鶏の鳴き声の音量（dB）
     *
     * @var float
     */
    private float $soundDecibels = 60.0;

    /**
     * コンストラクタ
     *
     * @param float $weightKg 鶏の重量（kg）
     */
    public function __construct(float $weightKg)
    {
        $this->weightKg = $weightKg;
    }

    /**
     * 文字列表現を返す
     *
     * @return string 鶏の情報を含む文字列
     */
    public function __toString(): string
    {
        return "This is a chicken that weights: {$this->weightKg}kg";
    }

    /**
     * 調理方法を返す（EdibleInterface実装）
     *
     * @return string 鶏の調理方法
     */
    public function howToPrepare(): string
    {
        return '焼くか揚げてください。';
    }

    /**
     * カロリーを返す（EdibleInterface実装）
     *
     * @return float 鶏のカロリー（kcal）
     */
    public function calories(): float
    {
        return $this->weightKg * 239.0; // 1kgあたり約239kcalと仮定
    }

    /**
     * 鶏の鳴き声を出す（AudibleInterface実装）
     *
     * 鶏の特徴的な「コケコッコー！」という鳴き声を出力します。
     * 早朝の鳴き声として知られる、家禽の代表的な音を表現します。
     *
     * @return void
     */
    public function makeNoise(): void
    {
        echo 'コケコッコー！' . PHP_EOL;
    }

    /**
     * 鶏の鳴き声の周波数を取得（AudibleInterface実装）
     *
     * 鶏の鳴き声の基本周波数を返します。
     * 鶏の鳴き声は比較的高めの周波数（500Hz）を持ちます。
     *
     * @return float 鳴き声の基本周波数（Hz）
     */
    public function soundFrequency(): float
    {
        return $this->soundFrequency;
    }

    /**
     * 鶏の鳴き声の音量レベルを取得（AudibleInterface実装）
     *
     * 鶏の鳴き声の音量レベルを返します。
     * 家禽としては中程度の音量（60dB）を発します。
     *
     * @return float 鳴き声の音量レベル（dB）
     */
    public function soundLevel(): float
    {
        return $this->soundDecibels;
    }
}
