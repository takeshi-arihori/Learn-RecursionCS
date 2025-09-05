<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';
require_once __DIR__ . '/EdibleInterface.php';

/**
 * 牛クラス
 * 
 * AudibleInterfaceとEdibleInterfaceの両方を実装したクラスです。
 * 音を出す動物としての機能と、食べ物としての機能を持ちます。
 */
class Cow implements AudibleInterface, EdibleInterface
{
    /**
     * 牛の重量（kg）
     * 
     * @var float
     */
    private float $weightKg;
    
    /**
     * 牛の鳴き声の周波数（Hz）
     * 
     * @var float
     */
    private float $soundFrequency = 90.0;
    
    /**
     * 牛の鳴き声の音量（dB）
     * 
     * @var float
     */
    private float $soundDecibels = 70.0;

    /**
     * コンストラクタ
     * 
     * @param float $weightKg 牛の重量（kg）
     */
    public function __construct(float $weightKg)
    {
        $this->weightKg = $weightKg;
    }

    /**
     * 文字列表現を返す
     * 
     * @return string 牛の情報を含む文字列
     */
    public function __toString(): string
    {
        return "This is a cow that weights: {$this->weightKg}kg";
    }

    /**
     * 牛の鳴き声を出す（AudibleInterface実装）
     * 
     * @return void
     */
    public function makeNoise(): void
    {
        echo "Moooo!!" . PHP_EOL;
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

    /**
     * 調理方法を返す（EdibleInterface実装）
     * 
     * @return string 調理方法の説明
     */
    public function howToPrepare(): string
    {
        return "Cut the cow with a butchering knife into even pieces, and grill each piece at 220C";
    }

    /**
     * カロリーを計算して返す（EdibleInterface実装）
     * 
     * @return float カロリー値（重量 × 1850）
     */
    public function calories(): float
    {
        return $this->weightKg * 1850;
    }
}
