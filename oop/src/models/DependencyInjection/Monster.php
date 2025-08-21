<?php

namespace App\Models\DependencyInjection;

/**
 * モンスタークラス
 * 各種モンスター情報とアクションを管理します
 */
class Monster
{
    /** @var string モンスター名 */
    private string $monster;

    /** @var int 体力 */
    private int $health;

    /** @var int 攻撃力 */
    private int $attack;

    /** @var int 防御力 */
    private int $defense;

    /** @var float 身長（メートル） */
    private float $height = 300.0;

    /**
     * モンスターを初期化
     * 
     * @param string $monster モンスター名
     * @param int $health 体力
     * @param int $attack 攻撃力
     * @param int $defense 防御力
     */
    public function __construct(string $monster, int $health, int $attack, int $defense)
    {
        $this->monster = $monster;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
    }

    /**
     * モンスター名を取得
     * 
     * @return string モンスター名
     */
    public function getName(): string
    {
        return $this->monster;
    }

    /**
     * 身長を取得
     * 
     * @return float 身長（メートル）
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * 攻撃力を取得
     * 
     * @return int 攻撃力
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * 防御力を取得
     * 
     * @return int 防御力
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * 攻撃を受けてダメージを受ける
     * 体力が0を下回った場合は0に設定
     * 
     * @param int $hp 受けるダメージ量
     */
    public function attacked(int $hp): void
    {
        $this->health -= $hp;
        // 体力は0を下回らない
        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    /**
     * モンスター情報を文字列として表現
     * 
     * @return string モンスターの詳細情報
     */
    public function __toString(): string
    {
        return $this->monster . " - HP:" . $this->health . "/Atk:" . $this->attack . "/Def:" . $this->defense . "/height:" . $this->height . " meters";
    }
}
