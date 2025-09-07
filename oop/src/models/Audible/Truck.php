<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';
require_once __DIR__ . '/PhysicsObjectInterface.php';

/**
 * Truckクラス - トラックを表現するクラス
 * 
 * AudibleInterfaceとPhysicsObjectInterfaceを実装し、
 * 音を出す車両として、そして物理オブジェクトとしての機能を提供します。
 * トラックの基本的な属性（重量）と、音響特性および物理特性を持ちます。
 * 
 * @package App\Models\Audible
 * @author Claude Code
 * @version 2.0.0
 * @since 2025-01-27
 */
class Truck implements AudibleInterface, PhysicsObjectInterface
{
    /**
     * トラックの重量（kg）
     * 
     * @var float
     */
    private float $weightKg;
    
    /**
     * トラックの摩擦係数（道路との摩擦）
     * タイヤと路面の標準的な摩擦係数
     * 
     * @var float
     */
    private float $frictionCoefficient = 0.7;
    
    /**
     * トラックの密度（kg/m³）
     * 鋼鉄を主材料とする車両の標準密度
     * 
     * @var float
     */
    private float $density = 7850.0;

    /**
     * コンストラクタ - トラックのインスタンスを作成
     * 
     * @param float $weightKg トラックの重量（kg）
     */
    public function __construct(float $weightKg)
    {
        $this->weightKg = $weightKg;
    }

    /**
     * オブジェクトの文字列表現を取得
     * 
     * トラックの基本情報（重量）を含む文字列を返します。
     * 
     * @return string トラック情報の文字列表現
     */
    public function __toString(): string
    {
        return "This is a truck that weights: {$this->weightKg}kg";
    }

    /**
     * トラックの警笛音を出す（AudibleInterface実装）
     * 
     * トラックの警笛として「Beep Beep!!」を出力します。
     * 交通安全のための音響信号を提供します。
     * 
     * @return void
     */
    public function makeNoise(): void
    {
        echo "Beep Beep!!" . PHP_EOL;
    }

    /**
     * トラックの警笛音の周波数を取得（AudibleInterface実装）
     * 
     * トラックの警笛音の基本周波数を返します。
     * 工業車両特有の中低音域（165Hz）の音を発生します。
     * 
     * @return float 警笛音の周波数（Hz）
     */
    public function soundFrequency(): float
    {
        return 165.0;
    }

    /**
     * トラックの警笛音の音量レベルを取得（AudibleInterface実装）
     * 
     * トラックの警笛音の音量レベルを返します。
     * 交通安全のため比較的大きな音量（120dB）を発生します。
     * 
     * @return float 警笛音の音量レベル（dB）
     */
    public function soundLevel(): float
    {
        return 120.0;
    }

    /**
     * 指定距離移動に必要なエネルギーを計算（PhysicsObjectInterface実装）
     * 
     * トラックが指定された距離を移動するのに必要なエネルギー（ジュール）を計算します。
     * 計算式：エネルギー = 力 × 距離 = (質量 × 重力 × 摩擦係数) × 距離
     * 地球の標準重力（9.8 m/s²）と道路摩擦係数（0.7）を使用します。
     * 
     * @param float $meters 移動距離（メートル）
     * @return float 必要エネルギー（ジュール）
     */
    public function workToMove(float $meters): float
    {
        // エネルギー = 力 × 距離
        // 力 = 質量 × 重力 × 摩擦係数
        $gravity = 9.8; // m/s² (地球の標準重力)
        $force = $this->weightKg * $gravity * $this->frictionCoefficient;
        return $force * $meters;
    }

    /**
     * トラックの密度を取得（PhysicsObjectInterface実装）
     * 
     * トラックの材質密度を返します。
     * トラックは主に鋼鉄で構成されているため、鋼鉄の標準密度（7850 kg/m³）を返します。
     * 
     * @return float 密度（kg/m³）
     */
    public function density(): float
    {
        return $this->density;
    }

    /**
     * 指定重力下での重量を計算（PhysicsObjectInterface実装）
     * 
     * 指定された重力加速度の下でのトラックの重量（ニュートン）を計算します。
     * 計算式：重量 = 質量 × 重力加速度
     * 
     * @param float $gravity 重力加速度（m/s²）
     * @return float 重量（ニュートン、kg⋅m/s²）
     */
    public function weight(float $gravity): float
    {
        return $this->weightKg * $gravity;
    }
}
