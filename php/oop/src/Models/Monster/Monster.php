<?php

declare(strict_types=1);

/**
 * Monster.php
 *
 * モンスターを表現するクラス
 * プレイヤーとの戦闘で攻撃を受ける機能を持つ
 *
 * 注意: 身長の単位はセンチメートル（Playerクラスはメートル）
 * この単位の違いがPlayerの攻撃判定で問題を引き起こす
 *
 * @author   Recursion Curriculum
 * @version  1.0.0
 */

class Monster
{
    /**
     * モンスター名
     * @var string
     */
    private string $monster;

    /**
     * モンスターの体力
     * @var int
     */
    private int $health;

    /**
     * モンスターの攻撃力
     * @var int
     */
    private int $attack;

    /**
     * モンスターの防御力
     * @var int
     */
    private int $defense;

    /**
     * モンスターの身長（センチメートル単位）
     * デフォルト値: 300センチメートル
     *
     * 変更された箇所: モンスターの身長はデフォルトで300センチメートルになりました。
     * プレイヤーがメートルで身長を計算していたため、ここでの変更が依存関係に問題を引き起こします。
     *
     * @var float
     */
    private float $height = 300.0;

    /**
     * Monsterコンストラクタ
     *
     * @param string $monster  モンスター名
     * @param int    $health   体力
     * @param int    $attack   攻撃力
     * @param int    $defense  防御力
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
     * モンスターの身長を取得（センチメートル単位）
     *
     * @return float 身長（センチメートル）
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * モンスターの攻撃力を取得
     *
     * @return int 攻撃力
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * モンスターの防御力を取得
     *
     * @return int 防御力
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * 攻撃を受けて体力を減らす
     *
     * 体力が0以下になった場合は0に設定される
     *
     * @param int $hp 受けるダメージ量
     * @return void
     */
    public function attacked(int $hp): void
    {
        $this->health -= $hp;

        // 体力が0未満にならないようにする
        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    /**
     * モンスターの文字列表現を取得
     *
     * @return string モンスターの情報を含む文字列
     */
    public function __toString(): string
    {
        return $this->monster .
            ' - HP:' . $this->health .
            '/Atk:' . $this->attack .
            '/Def:' . $this->defense .
            '/height:' . $this->height . ' centimeters'; // heightはセンチメートル
    }
}
