<?php

namespace App\Models\DependencyInjection;

/**
 * プレイヤークラス
 * ユーザー情報とアクションを管理します
 */
class Player
{
    /** @var string プレイヤー名 */
    private string $username;

    /** @var int 体力 */
    private int $health;

    /** @var int 攻撃力 */
    private int $attack;

    /** @var int 防御力 */
    private int $defense;

    /** @var float 身長（メートル） */
    private float $height = 1.8;

    /** @var int 所持金 */
    private int $gold;

    /**
     * プレイヤーを初期化
     * 
     * @param string $username プレイヤー名
     * @param int $health 体力
     * @param int $attack 攻撃力
     * @param int $defense 防御力
     * @param int $gold 所持金
     */
    public function __construct(string $username, int $health, int $attack, int $defense, int $gold)
    {
        $this->username = $username;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->height = 1.8;
        $this->gold = $gold;
    }

    /**
     * プレイヤー名を取得
     * 
     * @return string プレイヤー名
     */
    public function getName(): string
    {
        return $this->username;
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
     * モンスターを攻撃
     * モンスターの高さが自分の3倍以上、または攻撃力が相手の防御力以下の場合は攻撃無効
     * 
     * @param Monster $monster 攻撃対象のモンスター
     */
    public function attack(Monster $monster): void
    {
        echo $this->username . " ATTACKS " . $monster->getName() . "
";

        // 攻撃条件チェック：モンスターが大きすぎるか、攻撃が通らない場合
        if ($monster->getHeight() >= $this->height * 3 || $this->attack <= $monster->getDefense()) {
            return;
        }

        // 実際のダメージ = 攻撃力 - 防御力
        $monster->attacked($this->attack - $monster->getDefense());
    }

    /**
     * プレイヤー情報を文字列として表現
     * 
     * @return string プレイヤーの詳細情報
     */
    public function __toString(): string
    {
        return "Player " . $this->username . " - HP:" . $this->health . "/Atk:" . $this->attack . "/Def:" . $this->defense . "/Gold:" . $this->gold . "/height:" . $this->height . " meters";
    }
}
