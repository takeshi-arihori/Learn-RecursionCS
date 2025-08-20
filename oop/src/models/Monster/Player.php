<?php

/**
 * Player.php
 * 
 * プレイヤーキャラクターを表現するクラス
 * モンスターと戦闘を行う機能を持つ
 * 
 * 注意: 身長の単位はメートル（Monsterクラスはセンチメートル）
 * この単位の違いが攻撃判定で問題を引き起こす
 * 
 * @author   Recursion Curriculum
 * @version  1.0.0
 */

class Player
{
    /**
     * プレイヤーのユーザー名
     * @var string
     */
    private string $username;

    /**
     * プレイヤーの体力
     * @var int
     */
    private int $health;

    /**
     * プレイヤーの攻撃力
     * @var int
     */
    private int $attack;

    /**
     * プレイヤーの防御力
     * @var int
     */
    private int $defense;

    /**
     * プレイヤーの身長（メートル単位）
     * デフォルト値: 1.8メートル
     * @var float
     */
    private float $height = 1.8;

    /**
     * プレイヤーの所持金
     * @var int
     */
    private int $gold;

    /**
     * Playerコンストラクタ
     * 
     * @param string $username プレイヤー名
     * @param int    $health   体力
     * @param int    $attack   攻撃力
     * @param int    $defense  防御力
     * @param int    $gold     所持金
     */
    public function __construct(string $username, int $health, int $attack, int $defense, int $gold)
    {
        $this->username = $username;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->gold = $gold;
    }

    /**
     * プレイヤーの身長を取得（メートル単位）
     * 
     * @return float 身長（メートル）
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * プレイヤーの攻撃力を取得（テスト用）
     * 
     * @return int 攻撃力
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * モンスターを攻撃する
     * 
     * 攻撃条件:
     * 1. モンスターの身長がプレイヤーの3倍未満
     * 2. プレイヤーの攻撃力がモンスターの防御力より大きい
     * 
     * 問題: MonsterとPlayerで身長の単位が異なる
     * - Player: メートル (1.8m)
     * - Monster: センチメートル (300cm)
     * この違いにより攻撃判定が正常に動作しない
     * 
     * @param Monster $monster 攻撃対象のモンスター
     * @return void
     */
    public function attack(Monster $monster): void
    {
        echo $this->username . " ATTACKS " . $monster->getName() . PHP_EOL;

        // 依存関係がある箇所：
        // Monsterの身長がPlayerの3倍以上の場合、またはMonsterの防御力がPlayerの攻撃力以上の場合、攻撃は無効
        // 
        // 問題: monster->getHeight()はセンチメートル（300）、$this->heightはメートル（1.8）
        // 比較: 300 >= 1.8 * 3 = 5.4 → true となり、攻撃が常に無効になる
        if ($monster->getHeight() >= $this->height * 3 || $this->attack <= $monster->getDefense()) {
            return;
        }

        // ダメージ計算: 攻撃力 - 防御力
        $damage = $this->attack - $monster->getDefense();
        $monster->attacked($damage);
    }

    /**
     * プレイヤーの文字列表現を取得
     * 
     * @return string プレイヤーの情報を含む文字列
     */
    public function __toString(): string
    {
        return "Player " . $this->username .
            " - HP:" . $this->health .
            "/Atk:" . $this->attack .
            "/Def:" . $this->defense .
            "/Gold:" . $this->gold .
            "/height:" . $this->height . " meters";
    }
}
