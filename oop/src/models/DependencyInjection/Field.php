<?php

namespace App\Models\DependencyInjection;

/**
 * フィールドクラス
 * モンスターの位置情報などを管理します
 */
class Field
{
    /** @var int フィールドのX軸最大値 */
    private const MAX_X = 100000;

    /** @var int フィールドのY軸最大値 */
    private const MAX_Y = 40000;

    /** @var int フィールドのZ軸最大値 */
    private const MAX_Z = 1000;

    /** @var array フィールド上に存在するモンスターのリスト */
    private array $creatures;

    /** 
     * @var array それぞれのモンスターの座標を保持するリスト
     * creaturesリストの各モンスターに対応しており、
     * creaturesリストのn番目のモンスターの座標は
     * creatureCoordinatesリストのn番目の座標となる
     */
    private array $creatureCoordinates;

    /**
     * フィールドを初期化
     * モンスターリストと座標リストを空の配列で初期化
     */
    public function __construct()
    {
        $this->creatures = [];
        $this->creatureCoordinates = [];
    }

    /**
     * フィールドにランダムな位置にモンスターを追加
     * このメソッドではモンスターのパラメータを直接受け取り、
     * その内部で新しいモンスターオブジェクトを作成します。
     * この場合、他のクラスからはこのメソッドがどのようにモンスターオブジェクトを
     * 作成しているか、また、このメソッドがMonsterクラスにどのように依存しているかがわかりません。
     * 
     * @param string $monster モンスター名
     * @param int $health 体力
     * @param int $attack 攻撃力
     * @param int $defense 防御力
     */
    public function randomlyAdd(string $monster, int $health, int $attack, int $defense): void
    {
        // 内部でMonsterオブジェクトを作成（依存性が隠蔽されている）
        $newMonster = new Monster($monster, $health, $attack, $defense);

        // ランダムな座標を生成
        $c = new Coordinate(
            $this->internalRanAlgorithm(1, self::MAX_X),
            $this->internalRanAlgorithm(1, self::MAX_Y),
            $this->internalRanAlgorithm(1, self::MAX_Z)
        );

        $this->creatures[] = $newMonster;
        $this->creatureCoordinates[] = $c;
    }

    /**
     * フィールドにランダムな位置にモンスターを追加（依存性注入版）
     * このメソッドではモンスターオブジェクト自体を直接受け取ります。
     * これによりこのメソッドがMonsterクラスに依存していることが明示的になります。
     * そしてこの依存性は外部（このメソッドを呼び出すクラスやメソッド）にも明らかとなります。
     * 
     * @param Monster $creature 追加するモンスターオブジェクト
     */
    public function randomlyAddWithDependency(Monster $creature): void
    {
        // ランダムな座標を生成
        $c = new Coordinate(
            $this->internalRanAlgorithm(1, self::MAX_X),
            $this->internalRanAlgorithm(1, self::MAX_Y),
            $this->internalRanAlgorithm(1, self::MAX_Z)
        );

        // 外部で作成されたMonsterオブジェクトを注入
        $this->creatures[] = $creature;
        $this->creatureCoordinates[] = $c;
    }

    /**
     * 内部ランダム生成アルゴリズム
     * 指定された範囲内でランダムな整数を生成
     * 
     * @param int $min 最小値
     * @param int $max 最大値
     * @return int ランダムな整数
     */
    private function internalRanAlgorithm(int $min, int $max): int
    {
        return rand($min, $max - 1);
    }

    /**
     * フィールド上の全モンスターと座標情報を文字列として表現
     * 
     * @return string フィールドの詳細情報
     */
    public function __toString(): string
    {
        $s = "";
        // 各モンスターとその座標を文字列に追加
        for ($i = 0; $i < count($this->creatures); $i++) {
            $s .= $this->creatures[$i] . " with coordinates: " . $this->creatureCoordinates[$i] . "
";
        }
        return $s;
    }
}
