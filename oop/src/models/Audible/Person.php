<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';
require_once __DIR__ . '/LensesInterface.php';

/**
 * Personクラス - 人間を表現するクラス
 * 
 * AudibleInterfaceとLensesInterfaceを実装し、
 * 音を出す生物として、そして視覚を持つ生物としての機能を提供します。
 * 人間の基本的な属性（名前、身長、体重、年齢）と、
 * 音響特性および視覚特性を持ちます。
 * 
 * @package App\Models\Audible
 * @author Claude Code
 * @version 2.0.0
 * @since 2025-01-27
 */
class Person implements AudibleInterface, LensesInterface
{
    /**
     * 人の名前（姓）
     * 
     * @var string
     */
    private string $firstName;

    /**
     * 人の名前（名）
     * 
     * @var string
     */
    private string $lastName;

    /**
     * 身長（メートル単位）
     * 
     * @var int
     */
    private int $heightM;

    /**
     * 体重（キログラム単位）
     * 
     * @var int
     */
    private int $weightKg;

    /**
     * 年齢（歳）
     * 
     * @var int
     */
    private int $age;

    /**
     * コンストラクタ - 人間のインスタンスを作成
     * 
     * @param string $firstName 名前（姓）
     * @param string $lastName 名前（名）
     * @param int $heightM 身長（メートル単位）
     * @param int $weightKg 体重（キログラム単位）
     * @param int $age 年齢（歳）
     */
    public function __construct(string $firstName, string $lastName, int $heightM, int $weightKg, int $age)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->heightM = $heightM;
        $this->weightKg = $weightKg;
        $this->age = $age;
    }

    /**
     * フルネームを取得
     * 
     * 姓と名を組み合わせたフルネームを返します。
     * 
     * @return string フルネーム（「姓 名」の形式）
     */
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * オブジェクトの文字列表現を取得
     * 
     * 人物の基本情報（名前、身長、体重）を含む文字列を返します。
     * 
     * @return string 人物情報の文字列表現
     */
    public function __toString(): string
    {
        return $this->getFullName() . ' who is ' . $this->heightM . 'm tall and weights ' . $this->weightKg . 'kg.';
    }

    /**
     * 人間が音を出す（AudibleInterface実装）
     * 
     * 人間の基本的な発声として「Hello World!」を出力します。
     * 年齢に関係なく、全ての人間が同じ挨拶をします。
     * 
     * @return void
     */
    public function makeNoise(): void
    {
        echo 'Hello World!' . PHP_EOL;
    }

    /**
     * 人間の声の周波数を取得（AudibleInterface実装）
     * 
     * 年齢に基づいて人間の声の基本周波数を返します。
     * - 16歳以下：130.0Hz（子供の声、やや高め）
     * - 17歳以上：110.0Hz（大人の声、やや低め）
     * 
     * @return float 声の基本周波数（Hz）
     */
    public function soundFrequency(): float
    {
        return $this->age > 16 ? 110.0 : 130.0;
    }

    /**
     * 人間の声の音量レベルを取得（AudibleInterface実装）
     * 
     * 年齢に基づいて人間の声の音量レベルを返します。
     * - 16歳以下：65.0dB（子供の声、やや大きめ）
     * - 17歳以上：60.0dB（大人の声、やや小さめ）
     * 
     * @return float 声の音量レベル（dB）
     */
    public function soundLevel(): float
    {
        return $this->age > 16 ? 60.0 : 65.0;
    }

    /**
     * 人間の可視光範囲を取得（LensesInterface実装）
     * 
     * 人間の標準的な可視光スペクトル範囲を返します。
     * 人間の目は380nm（紫）から700nm（赤）の範囲の光を検知できます。
     * 
     * @return array{0: int, 1: int} [最小波長, 最大波長]の配列（ナノメートル単位）
     */
    public function lightRange(): array
    {
        return [380, 700];
    }

    /**
     * オブジェクトを視覚的に観察して描写（LensesInterface実装）
     * 
     * 指定されたオブジェクトを人間の視点で観察し、
     * その視覚的特徴や印象を文字列で表現します。
     * オブジェクトの種類に応じて適切な描写を行います。
     * 
     * @param object $object 観察対象のオブジェクト
     * @return string 視覚的観察に基づく描写
     */
    public function see(object $object): string
    {
        $className = get_class($object);
        $shortClassName = basename(str_replace('\\', '/', $className));

        // オブジェクトの種類に応じた視覚的描写を生成
        switch ($shortClassName) {
            case 'Person':
                if (method_exists($object, 'getFullName')) {
                    return "私は{$object->getFullName()}という人を見ています。この人は人間で、直立して立っています。";
                }
                return "私は一人の人間を見ています。この人は直立して立っています。";

            case 'Horse':
                return "私は美しい馬を見ています。4本の足で立ち、優雅なたてがみを持つ大きな動物です。";

            case 'Cow':
                return "私は牛を見ています。大きな体をした草食動物で、白と黒の斑点があります。";

            case 'Truck':
                return "私は大きなトラックを見ています。重い荷物を運ぶための頑丈な車両で、大きな車輪があります。";

            case 'Violin':
                return "私は美しいバイオリンを見ています。木製の弦楽器で、優美な曲線を描いています。";

            default:
                return "私は{$shortClassName}というオブジェクトを見ています。詳細な特徴を観察しています。";
        }
    }
}
