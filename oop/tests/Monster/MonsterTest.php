<?php

declare(strict_types=1);

/**
 * MonsterTest.php
 *
 * MonsterクラスのTDD（Test-Driven Development）テストケース
 * Given-When-Then パターンに従ってテストケースを構成
 *
 * テスト対象：
 * - コンストラクタによる初期化
 * - ゲッターメソッドの動作
 * - attacked()メソッドによる体力減少処理
 * - toString()メソッドの文字列表現
 *
 * @author   Recursion Curriculum
 * @version  1.0.0
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../src/models/Monster/Monster.php';

class MonsterTest extends TestCase
{
    /**
     * @test
     * Given: 有効なパラメータが渡される
     * When: Monsterインスタンスを作成する
     * Then: すべてのプロパティが正しく初期化される
     */
    public function testMonsterCreation(): void
    {
        // Given: 有効なMonsterの初期化パラメータ
        $monsterName = 'Gorilla';
        $health = 4000;
        $attack = 40;
        $defense = 100;

        // When: Monsterインスタンスを作成
        $monster = new Monster($monsterName, $health, $attack, $defense);

        // Then: 各プロパティが正しく設定されている
        // プライベートプロパティはリフレクションで確認
        $reflection = new ReflectionClass($monster);

        $monsterProperty = $reflection->getProperty('monster');
        $monsterProperty->setAccessible(true);
        $this->assertEquals($monsterName, $monsterProperty->getValue($monster));

        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $this->assertEquals($health, $healthProperty->getValue($monster));

        $attackProperty = $reflection->getProperty('attack');
        $attackProperty->setAccessible(true);
        $this->assertEquals($attack, $attackProperty->getValue($monster));

        $defenseProperty = $reflection->getProperty('defense');
        $defenseProperty->setAccessible(true);
        $this->assertEquals($defense, $defenseProperty->getValue($monster));

        // デフォルトの身長が設定されているか確認
        $heightProperty = $reflection->getProperty('height');
        $heightProperty->setAccessible(true);
        $this->assertEquals(300.0, $heightProperty->getValue($monster));
    }

    /**
     * @test
     * Given: Monsterが作成されている
     * When: getName()メソッドを呼び出す
     * Then: 正しいモンスター名が返される
     */
    public function testGetName(): void
    {
        // Given: Monsterインスタンス
        $expectedName = 'DragonKing';
        $monster = new Monster($expectedName, 5000, 200, 150);

        // When: getName()を呼び出す
        $actualName = $monster->getName();

        // Then: 正しいモンスター名が返される
        $this->assertEquals($expectedName, $actualName);
        $this->assertIsString($actualName, 'モンスター名は文字列で返される必要がある');
    }

    /**
     * @test
     * Given: Monsterが作成されている
     * When: getHeight()メソッドを呼び出す
     * Then: デフォルトの身長（300.0センチメートル）が返される
     */
    public function testGetHeight(): void
    {
        // Given: Monsterインスタンス
        $monster = new Monster('TestMonster', 1000, 50, 30);

        // When: getHeight()を呼び出す
        $height = $monster->getHeight();

        // Then: デフォルトの身長300.0センチメートルが返される
        $this->assertEquals(300.0, $height);
        $this->assertIsFloat($height, '身長はfloat型で返される必要がある');
    }

    /**
     * @test
     * Given: Monsterが作成されている
     * When: getAttack()メソッドを呼び出す
     * Then: 正しい攻撃力が返される
     */
    public function testGetAttack(): void
    {
        // Given: 特定の攻撃力を持つMonster
        $expectedAttack = 175;
        $monster = new Monster('Warrior', 2000, $expectedAttack, 80);

        // When: getAttack()を呼び出す
        $actualAttack = $monster->getAttack();

        // Then: 正しい攻撃力が返される
        $this->assertEquals($expectedAttack, $actualAttack);
        $this->assertIsInt($actualAttack, '攻撃力はint型で返される必要がある');
    }

    /**
     * @test
     * Given: Monsterが作成されている
     * When: getDefense()メソッドを呼び出す
     * Then: 正しい防御力が返される
     */
    public function testGetDefense(): void
    {
        // Given: 特定の防御力を持つMonster
        $expectedDefense = 120;
        $monster = new Monster('Guardian', 3000, 90, $expectedDefense);

        // When: getDefense()を呼び出す
        $actualDefense = $monster->getDefense();

        // Then: 正しい防御力が返される
        $this->assertEquals($expectedDefense, $actualDefense);
        $this->assertIsInt($actualDefense, '防御力はint型で返される必要がある');
    }

    /**
     * @test
     * Given: Monsterが満タンの体力を持っている
     * When: attacked()メソッドで通常のダメージを与える
     * Then: 体力が正しく減少する
     */
    public function testAttackedNormalDamage(): void
    {
        // Given: 体力1000のMonster
        $initialHealth = 1000;
        $monster = new Monster('TestTarget', $initialHealth, 50, 30);

        // 初期体力を確認
        $reflection = new ReflectionClass($monster);
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $this->assertEquals($initialHealth, $healthProperty->getValue($monster));

        // When: 200ダメージを与える
        $damage = 200;
        $monster->attacked($damage);

        // Then: 体力が正しく減少している
        $expectedHealth = $initialHealth - $damage;
        $actualHealth = $healthProperty->getValue($monster);
        $this->assertEquals(
            $expectedHealth,
            $actualHealth,
            "体力が{$damage}ダメージ分減少する",
        );
    }

    /**
     * @test
     * Given: Monsterが低い体力を持っている
     * When: attacked()メソッドで大ダメージを与える（体力を超える）
     * Then: 体力が0になる（負の値にならない）
     */
    public function testAttackedOverkillDamage(): void
    {
        // Given: 体力100のMonster
        $initialHealth = 100;
        $monster = new Monster('WeakTarget', $initialHealth, 25, 15);

        // When: 300ダメージを与える（体力を大幅に超える）
        $hugeDamage = 300;
        $monster->attacked($hugeDamage);

        // Then: 体力が0になる（負にならない）
        $reflection = new ReflectionClass($monster);
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $actualHealth = $healthProperty->getValue($monster);

        $this->assertEquals(0, $actualHealth, '体力は0が最小値');
        $this->assertGreaterThanOrEqual(0, $actualHealth, '体力は負の値にならない');
    }

    /**
     * @test
     * Given: Monsterが既にダメージを受けている
     * When: 複数回attacked()メソッドを呼び出す
     * Then: ダメージが累積して正しく体力が減る
     */
    public function testMultipleAttacks(): void
    {
        // Given: 体力2000のMonster
        $initialHealth = 2000;
        $monster = new Monster('DurableEnemy', $initialHealth, 80, 60);

        $reflection = new ReflectionClass($monster);
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);

        // When: 3回攻撃を受ける
        $firstDamage = 500;
        $secondDamage = 300;
        $thirdDamage = 400;

        $monster->attacked($firstDamage);
        $healthAfterFirst = $healthProperty->getValue($monster);

        $monster->attacked($secondDamage);
        $healthAfterSecond = $healthProperty->getValue($monster);

        $monster->attacked($thirdDamage);
        $healthAfterThird = $healthProperty->getValue($monster);

        // Then: ダメージが累積されている
        $this->assertEquals(
            $initialHealth - $firstDamage,
            $healthAfterFirst,
            '1回目の攻撃後の体力',
        );
        $this->assertEquals(
            $initialHealth - $firstDamage - $secondDamage,
            $healthAfterSecond,
            '2回目の攻撃後の体力',
        );
        $this->assertEquals(
            $initialHealth - $firstDamage - $secondDamage - $thirdDamage,
            $healthAfterThird,
            '3回目の攻撃後の体力',
        );
    }

    /**
     * @test
     * Given: Monsterが0ダメージを受ける
     * When: attacked(0)メソッドを呼び出す
     * Then: 体力が変わらない
     */
    public function testAttackedZeroDamage(): void
    {
        // Given: Monsterインスタンス
        $initialHealth = 1500;
        $monster = new Monster('TestMonster', $initialHealth, 70, 40);

        // When: 0ダメージを与える
        $monster->attacked(0);

        // Then: 体力が変わらない
        $reflection = new ReflectionClass($monster);
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $actualHealth = $healthProperty->getValue($monster);

        $this->assertEquals($initialHealth, $actualHealth, '0ダメージでは体力は変わらない');
    }

    /**
     * @test
     * Given: Monsterインスタンス
     * When: __toString()メソッドを呼び出す
     * Then: 期待される文字列表現が返される（センチメートル単位で）
     */
    public function testToString(): void
    {
        // Given: Monsterインスタンス
        $monster = new Monster('FireDragon', 8000, 250, 180);

        // When: __toString()を呼び出す
        $result = $monster->__toString();

        // Then: 正しいフォーマットの文字列が返される
        $expected = 'FireDragon - HP:8000/Atk:250/Def:180/height:300 centimeters';
        $this->assertEquals($expected, $result);

        // 文字列キャストでも同じ結果になることを確認
        $this->assertEquals($expected, (string)$monster);
    }

    /**
     * @test
     * Given: ダメージを受けて体力が減ったMonster
     * When: __toString()メソッドを呼び出す
     * Then: 現在の体力が正しく表示される
     */
    public function testToStringWithDamage(): void
    {
        // Given: Monsterがダメージを受けている
        $monster = new Monster('BattledOrc', 1000, 100, 50);
        $monster->attacked(300);  // 300ダメージを与える

        // When: __toString()を呼び出す
        $result = $monster->__toString();

        // Then: 現在の体力（700）が表示される
        $expected = 'BattledOrc - HP:700/Atk:100/Def:50/height:300 centimeters';
        $this->assertEquals($expected, $result, '現在の体力が正しく表示される');
    }

    /**
     * @test
     * Given: 体力が0になったMonster
     * When: __toString()メソッドを呼び出す
     * Then: 体力が0と表示される
     */
    public function testToStringDefeated(): void
    {
        // Given: 体力が0になったMonster
        $monster = new Monster('DefeatedBeast', 500, 80, 40);
        $monster->attacked(1000);  // 体力を0にする大ダメージ

        // When: __toString()を呼び出す
        $result = $monster->__toString();

        // Then: 体力0が表示される
        $expected = 'DefeatedBeast - HP:0/Atk:80/Def:40/height:300 centimeters';
        $this->assertEquals($expected, $result, '倒れたモンスターの体力は0と表示');
    }

    /**
     * @test
     * Given: 単位に関する問題の検証
     * When: デフォルトMonsterの身長を確認
     * Then: センチメートル単位であることが明確
     */
    public function testHeightUnitValidation(): void
    {
        // Given: デフォルトのMonster
        $monster = new Monster('HeightTestMonster', 1000, 50, 30);

        // When: 身長を取得
        $height = $monster->getHeight();

        // Then: センチメートル単位の値である
        $this->assertEquals(300.0, $height, 'Monsterの身長は300センチメートル');

        // メートルに変換すると3メートル
        $heightInMeters = $height / 100;
        $this->assertEquals(3.0, $heightInMeters, 'メートル換算では3メートル');

        // 単位問題のドキュメント化
        $this->assertNotEquals(
            3.0,
            $height,
            '身長の値(300)はセンチメートル単位であり、メートル単位(3.0)ではない',
        );
    }
}
