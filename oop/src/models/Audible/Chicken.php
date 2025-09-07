<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/EdibleInterface.php';

/**
 * Chickenクラス
 * 
 * ChickenクラスはAudibleInterfaceを実装しており、
 * 音を出す動物としての機能を提供します。
 * 鶏は「コケコッコー」という鳴き声を持つ鳥として表現されます。
 * 
 * @package App\Models\Audible
 * @author Claude Code
 * @version 1.0.0
 */
class Chicken implements EdibleInterface
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
        return "焼くか揚げてください。";
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
}
