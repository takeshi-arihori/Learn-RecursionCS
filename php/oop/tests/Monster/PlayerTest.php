<?php

declare(strict_types=1);

/**
 * PlayerTest.php
 *
 * PlayerクラスのTDD（Test-Driven Development）テストケース
 * Given-When-Then パターンに従ってテストケースを構成
 *
 * テスト対象：
 * - コンストラクタによる初期化
 * - プロパティの取得
 * - 攻撃ロジック（単位不一致による問題も含む）
 *
 * @author   Recursion Curriculum
 * @version  1.0.0
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../src/models/Monster/Player.php';
require_once __DIR__ . '/../../src/models/Monster/Monster.php';

class PlayerTest extends TestCase
{
    /**
     * @test
     * Given: 有効なパラメータが渡される
     * When: Playerインスタンスを作成する
     * Then: すべてのプロパティが正しく初期化される
     */
    public function testPlayerCreation(): void
    {
        // Given: 有効なPlayerの初期化パラメータ
        $username = 'Batrunner';
        $health = 2000;
        $attack = 200;
        $defense = 60;
        $gold = 1000;

        // When: Playerインスタンスを作成
        $player = new Player($username, $health, $attack, $defense, $gold);

        // Then: 各プロパティが正しく設定されている
        // プライベートプロパティはリフレクションで確認
        $reflection = new ReflectionClass($player);

        $usernameProperty = $reflection->getProperty('username');
        $usernameProperty->setAccessible(true);
        $this->assertEquals($username, $usernameProperty->getValue($player));

        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $this->assertEquals($health, $healthProperty->getValue($player));

        $attackProperty = $reflection->getProperty('attack');
        $attackProperty->setAccessible(true);
        $this->assertEquals($attack, $attackProperty->getValue($player));

        $defenseProperty = $reflection->getProperty('defense');
        $defenseProperty->setAccessible(true);
        $this->assertEquals($defense, $defenseProperty->getValue($player));

        $goldProperty = $reflection->getProperty('gold');
        $goldProperty->setAccessible(true);
        $this->assertEquals($gold, $goldProperty->getValue($player));
    }

    /**
     * @test
     * Given: Playerが作成されている
     * When: getHeight()メソッドを呼び出す
     * Then: デフォルトの身長（1.8メートル）が返される
     */
    public function testGetHeight(): void
    {
        // Given: Playerインスタンス
        $player = new Player('TestPlayer', 100, 50, 30, 500);

        // When: getHeight()を呼び出す
        $height = $player->getHeight();

        // Then: デフォルトの身長1.8メートルが返される
        $this->assertEquals(1.8, $height);
        $this->assertIsFloat($height, '身長はfloat型で返される必要がある');
    }

    /**
     * @test
     * Given: Player攻撃力 > Monster防御力 かつ Monster身長 < Player身長 × 3
     * When: PlayerがMonsterを攻撃する
     * Then: 攻撃が成功し、Monsterの体力が減る
     */
    public function testSuccessfulAttack(): void
    {
        // Given: 攻撃条件を満たすPlayerとMonster
        $player = new Player('Warrior', 1000, 100, 50, 500);  // 攻撃力100
        $monster = new Monster('SmallGoblin', 200, 30, 40);   // 防御力40、デフォルト身長300cm

        // Monster の身長を小さくして攻撃条件をクリア（1.8m × 3 = 5.4m = 540cm > 300cm）
        // しかし実際の比較は 300 >= 1.8 × 3 = 5.4 となるため、身長を更に小さくする
        $reflection = new ReflectionClass($monster);
        $heightProperty = $reflection->getProperty('height');
        $heightProperty->setAccessible(true);
        $heightProperty->setValue($monster, 5.0);  // 5cm（1.8 × 3 = 5.4 より小さい）

        // Monster の初期体力を確認
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $initialHealth = $healthProperty->getValue($monster);

        // When: 攻撃を実行
        $player->attack($monster);

        // Then: Monsterの体力が減っている（100 - 40 = 60ダメージ）
        $expectedDamage = 100 - 40;
        $expectedHealth = $initialHealth - $expectedDamage;
        $currentHealth = $healthProperty->getValue($monster);

        $playerAttack = $player->getAttack();
        $monsterDefense = $monster->getDefense();
        $this->assertEquals(
            $expectedHealth,
            $currentHealth,
            "攻撃力({$playerAttack}) - 防御力({$monsterDefense}) = {$expectedDamage}ダメージが入る",
        );
    }

    /**
     * @test
     * Given: Monster身長 >= Player身長 × 3
     * When: PlayerがMonsterを攻撃する
     * Then: 攻撃が無効になり、Monsterの体力が変わらない
     */
    public function testAttackBlockedByHeight(): void
    {
        // Given: プレイヤーより3倍以上高いモンスター
        // Player身長: 1.8m = 180cm
        // Monster身長: 300cm (デフォルト) >= 180cm × 3 = 540cm...
        // 実際は 300cm < 540cm なので条件は満たされない

        // より大きなモンスターをテストするため、カスタムモンスターを使用
        $player = new Player('SmallWarrior', 1000, 200, 50, 500);
        $monster = new Monster('GiantDragon', 5000, 100, 50);

        // Monster の身長を 600cm に設定（リフレクションを使用）
        $reflection = new ReflectionClass($monster);
        $heightProperty = $reflection->getProperty('height');
        $heightProperty->setAccessible(true);
        $heightProperty->setValue($monster, 600.0);  // 6m = 600cm

        // 初期体力を記録
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $initialHealth = $healthProperty->getValue($monster);

        // When: 攻撃を実行
        $player->attack($monster);

        // Then: 体力が変わらない（攻撃無効）
        $currentHealth = $healthProperty->getValue($monster);
        $monsterHeight = $monster->getHeight();
        $playerHeightThreshold = $player->getHeight() * 3;
        $this->assertEquals(
            $initialHealth,
            $currentHealth,
            "モンスターが高すぎる場合攻撃は無効になる（{$monsterHeight}cm >= {$playerHeightThreshold}cm）",
        );
    }

    /**
     * @test
     * Given: Player攻撃力 <= Monster防御力
     * When: PlayerがMonsterを攻撃する
     * Then: 攻撃が無効になり、Monsterの体力が変わらない
     */
    public function testAttackBlockedByDefense(): void
    {
        // Given: 攻撃力が防御力以下のPlayer
        $player = new Player('WeakWarrior', 1000, 50, 30, 500);   // 攻撃力50
        $monster = new Monster('ArmoredOrc', 3000, 100, 60);      // 防御力60

        // 初期体力を記録
        $reflection = new ReflectionClass($monster);
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $initialHealth = $healthProperty->getValue($monster);

        // When: 攻撃を実行
        $player->attack($monster);

        // Then: 体力が変わらない（攻撃無効）
        $currentHealth = $healthProperty->getValue($monster);
        $playerAttack = $player->getAttack();
        $monsterDefense = $monster->getDefense();
        $this->assertEquals(
            $initialHealth,
            $currentHealth,
            "攻撃力({$playerAttack}) <= 防御力({$monsterDefense})の場合攻撃は無効",
        );
    }

    /**
     * @test
     * Given: 単位不一致の問題（Player: メートル、Monster: センチメートル）
     * When: デフォルトのPlayerとMonsterで攻撃する
     * Then: 単位不一致により攻撃が常に無効になる問題を確認
     */
    public function testUnitMismatchProblem(): void
    {
        // Given: デフォルト設定のPlayerとMonster
        $player = new Player('Batrunner', 2000, 200, 60, 1000);
        $gorilla = new Monster('Gorilla', 4000, 40, 100);

        // Player身長: 1.8m, Monster身長: 300cm
        // 期待される比較: 300cm >= 1.8m × 3 = 5.4m = 540cm
        // 実際の比較: 300 >= 1.8 × 3 = 5.4 (単位を無視した比較)
        // これが問題の原因

        // 初期体力を記録
        $reflection = new ReflectionClass($gorilla);
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $initialHealth = $healthProperty->getValue($gorilla);

        // When: 攻撃を実行
        $player->attack($gorilla);

        // Then: 単位不一致により攻撃が無効になる
        $currentHealth = $healthProperty->getValue($gorilla);
        $gorillaHeight = $gorilla->getHeight();
        $playerHeight = $player->getHeight();
        $this->assertEquals(
            $initialHealth,
            $currentHealth,
            "単位不一致の問題: Monster({$gorillaHeight}cm) vs Player({$playerHeight}m × 3)",
        );

        // 問題の詳細をアサーション
        $playerHeightInCm = $player->getHeight() * 100;  // メートルをセンチメートルに変換
        $gorillaHeight = $gorilla->getHeight();
        $playerThresholdCm = $playerHeightInCm * 3;
        $this->assertLessThan(
            $playerThresholdCm,
            $gorillaHeight,
            "正しい単位変換後: {$gorillaHeight}cm < {$playerThresholdCm}cm であるべき",
        );
    }

    /**
     * @test
     * Given: Playerインスタンス
     * When: __toString()メソッドを呼び出す
     * Then: 期待される文字列表現が返される
     */
    public function testToString(): void
    {
        // Given: Playerインスタンス
        $player = new Player('TestHero', 1500, 120, 80, 750);

        // When: __toString()を呼び出す
        $result = $player->__toString();

        // Then: 正しいフォーマットの文字列が返される
        $expected = 'Player TestHero - HP:1500/Atk:120/Def:80/Gold:750/height:1.8 meters';
        $this->assertEquals($expected, $result);

        // 文字列キャストでも同じ結果になることを確認
        $this->assertEquals($expected, (string)$player);
    }

    /**
     * @test
     * Given: 攻撃によりMonsterの体力が0以下になる場合
     * When: PlayerがMonsterを攻撃する
     * Then: Monsterの体力が0に設定される（負の値にならない）
     */
    public function testOverkillAttack(): void
    {
        // Given: 大ダメージを与えることができるPlayer
        $player = new Player('PowerfulMage', 1000, 500, 50, 1000);  // 攻撃力500

        // 小さなモンスター（身長を調整して攻撃を有効にする）
        $monster = new Monster('WeakSlime', 50, 10, 20);  // 体力50、防御力20

        // Monster の身長を小さくして攻撃条件をクリア
        $reflection = new ReflectionClass($monster);
        $heightProperty = $reflection->getProperty('height');
        $heightProperty->setAccessible(true);
        $heightProperty->setValue($monster, 5.0);  // 5cm（1.8 × 3 = 5.4 より小さい）

        // When: 攻撃を実行（500 - 20 = 480ダメージ、体力50を大幅に超える）
        $player->attack($monster);

        // Then: Monsterの体力が0になる（負にならない）
        $healthProperty = $reflection->getProperty('health');
        $healthProperty->setAccessible(true);
        $currentHealth = $healthProperty->getValue($monster);

        $this->assertEquals(0, $currentHealth, '体力は0未満にならない');
        $this->assertGreaterThanOrEqual(0, $currentHealth, '体力は負の値にならない');
    }
}
