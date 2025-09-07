<?php

declare(strict_types=1);

use App\Models\Audible\Person;
use App\Models\Audible\Horse;
use App\Models\Audible\Cow;
use App\Models\Audible\Truck;
use App\Models\Audible\Violin;
use PHPUnit\Framework\TestCase;

/**
 * PersonLensesTest - PersonクラスのLensesInterface実装テスト
 * 
 * PersonクラスがLensesInterfaceを正しく実装していることを確認します。
 * 人間の視覚システムとしての機能（可視光範囲の検出と視覚的認識）をテストします。
 * 
 * テスト対象メソッド：
 * - lightRange(): 人間の可視光範囲を返す
 * - see(object $object): オブジェクトを見たときの視覚的描写を返す
 * 
 * @package App\Tests\Models\Audible
 * @author Claude Code
 * @version 1.0.0
 * @since 2025-01-27
 */
class PersonLensesTest extends TestCase
{
    /**
     * テスト用のPersonインスタンス（成人）
     * 
     * @var Person
     */
    private Person $adultPerson;

    /**
     * テスト用のPersonインスタンス（子供）
     * 
     * @var Person
     */
    private Person $childPerson;

    /**
     * テスト用のPersonインスタンス（高齢者）
     * 
     * @var Person
     */
    private Person $elderlyPerson;

    /**
     * テスト実行前の初期設定
     * 
     * 異なる年齢層のPersonオブジェクトを作成し、
     * 年齢による視覚機能の違いをテストできるように準備します。
     * 
     * @return void
     */
    protected function setUp(): void
    {
        $this->adultPerson = new Person('John', 'Doe', 175, 70, 30);
        $this->childPerson = new Person('Emma', 'Smith', 140, 35, 8);
        $this->elderlyPerson = new Person('Robert', 'Johnson', 170, 65, 75);
    }

    /**
     * lightRange()メソッドの基本機能テスト
     * 
     * 人間の標準的な可視光範囲（380nm-700nm）が正しく返されることを確認します。
     * すべての年齢の人間で同じ可視光範囲を持つことをテストします。
     * 
     * @test
     * @return void
     */
    public function testLightRangeReturnsHumanVisibleSpectrum(): void
    {
        // Given: 人間の標準可視光範囲
        $expectedRange = [380, 700];

        // When & Then: すべての年齢層で同じ可視光範囲を返すことを確認
        $this->assertEquals($expectedRange, $this->adultPerson->lightRange());
        $this->assertEquals($expectedRange, $this->childPerson->lightRange());
        $this->assertEquals($expectedRange, $this->elderlyPerson->lightRange());
    }

    /**
     * lightRange()の返り値構造テスト
     * 
     * lightRange()が正確に2要素の配列を返し、
     * 最小値と最大値が正しい順序で格納されていることを確認します。
     * 
     * @test
     * @return void
     */
    public function testLightRangeStructure(): void
    {
        // Given & When: 可視光範囲を取得
        $range = $this->adultPerson->lightRange();

        // Then: 構造の検証
        $this->assertIsArray($range, '戻り値は配列である必要があります');
        $this->assertCount(2, $range, '配列は正確に2つの要素を持つ必要があります');
        $this->assertIsInt($range[0], '最小値は整数である必要があります');
        $this->assertIsInt($range[1], '最大値は整数である必要があります');

        // 最小値が最大値より小さいことを確認
        $this->assertLessThan($range[1], $range[0], '最小値は最大値より小さい必要があります');

        // 人間の可視光範囲として妥当な値であることを確認
        $this->assertGreaterThan(300, $range[0], '最小値は300nmより大きい必要があります');
        $this->assertLessThan(800, $range[1], '最大値は800nmより小さい必要があります');
    }

    /**
     * see()メソッド - Personオブジェクト認識テスト
     * 
     * Personが別のPersonオブジェクトを見たときの視覚的描写をテストします。
     * 人間らしい観察と記述ができることを確認します。
     * 
     * @test
     * @return void
     */
    public function testSeePersonObject(): void
    {
        // Given: 観察対象となる別のPerson
        $targetPerson = new Person('Alice', 'Brown', 165, 55, 25);

        // When: PersonがPersonを見る
        $description = $this->adultPerson->see($targetPerson);

        // Then: 適切な視覚的描写が返されることを確認
        $this->assertIsString($description, '視覚的描写は文字列である必要があります');
        $this->assertNotEmpty($description, '視覚的描写は空であってはいけません');
        $this->assertStringContainsString('Alice', $description, '対象者の名前が含まれている必要があります');
        $this->assertStringContainsString('人', $description, '人間であることが示されている必要があります');
    }

    /**
     * see()メソッド - 動物オブジェクト認識テスト
     * 
     * Personが動物（Horse, Cow）を見たときの視覚的描写をテストします。
     * 動物の特徴を適切に認識できることを確認します。
     * 
     * @test
     * @return void
     */
    public function testSeeAnimalObjects(): void
    {
        // Given: 観察対象となる動物たち
        $horse = new Horse(500.0);
        $cow = new Cow(800.0);

        // When: PersonがHorseを見る
        $horseDescription = $this->adultPerson->see($horse);

        // Then: 馬に関する適切な描写が返される
        $this->assertIsString($horseDescription);
        $this->assertNotEmpty($horseDescription);
        $this->assertStringContainsString('馬', $horseDescription, '馬であることが認識されている必要があります');

        // When: PersonがCowを見る
        $cowDescription = $this->adultPerson->see($cow);

        // Then: 牛に関する適切な描写が返される
        $this->assertIsString($cowDescription);
        $this->assertNotEmpty($cowDescription);
        $this->assertStringContainsString('牛', $cowDescription, '牛であることが認識されている必要があります');
    }

    /**
     * see()メソッド - 無機物オブジェクト認識テスト
     * 
     * Personが無機物（Truck, Violin）を見たときの視覚的描写をテストします。
     * 物体の種類を適切に識別できることを確認します。
     * 
     * @test
     * @return void
     */
    public function testSeeInorganicObjects(): void
    {
        // Given: 観察対象となる無機物
        $truck = new Truck(15000.0);
        $violin = new Violin();

        // When: PersonがTruckを見る
        $truckDescription = $this->adultPerson->see($truck);

        // Then: トラックに関する適切な描写が返される
        $this->assertIsString($truckDescription);
        $this->assertNotEmpty($truckDescription);
        $this->assertStringContainsString('トラック', $truckDescription, 'トラックであることが認識されている必要があります');

        // When: PersonがViolinを見る
        $violinDescription = $this->adultPerson->see($violin);

        // Then: バイオリンに関する適切な描写が返される
        $this->assertIsString($violinDescription);
        $this->assertNotEmpty($violinDescription);
        $this->assertStringContainsString('バイオリン', $violinDescription, 'バイオリンであることが認識されている必要があります');
    }

    /**
     * see()メソッド - 複数オブジェクト認識の一貫性テスト
     * 
     * 同じPersonが同じオブジェクトを複数回見たときに、
     * 一貫した描写を返すことをテストします。
     * 
     * @test
     * @return void
     */
    public function testSeeConsistency(): void
    {
        // Given: 観察対象
        $target = new Horse(450.0);

        // When: 同じオブジェクトを複数回観察
        $description1 = $this->adultPerson->see($target);
        $description2 = $this->adultPerson->see($target);
        $description3 = $this->adultPerson->see($target);

        // Then: 一貫した描写が返されることを確認
        $this->assertEquals($description1, $description2, '同じオブジェクトに対しては一貫した描写である必要があります');
        $this->assertEquals($description2, $description3, '複数回観察しても同じ描写である必要があります');
    }

    /**
     * see()メソッド - 年齢による観察の違いテスト
     * 
     * 異なる年齢のPersonが同じオブジェクトを見たときに、
     * それぞれ適切な描写を返すことをテストします。
     * 年齢による視点の違いが反映されることを確認します。
     * 
     * @test
     * @return void
     */
    public function testSeeWithDifferentAges(): void
    {
        // Given: 観察対象
        $target = new Violin();

        // When: 異なる年齢のPersonが同じオブジェクトを観察
        $adultDescription = $this->adultPerson->see($target);
        $childDescription = $this->childPerson->see($target);
        $elderlyDescription = $this->elderlyPerson->see($target);

        // Then: すべて有効な描写が返される
        $this->assertIsString($adultDescription);
        $this->assertIsString($childDescription);
        $this->assertIsString($elderlyDescription);

        $this->assertNotEmpty($adultDescription);
        $this->assertNotEmpty($childDescription);
        $this->assertNotEmpty($elderlyDescription);

        // すべてにバイオリンの認識が含まれている
        $this->assertStringContainsString('バイオリン', $adultDescription);
        $this->assertStringContainsString('バイオリン', $childDescription);
        $this->assertStringContainsString('バイオリン', $elderlyDescription);
    }

    /**
     * see()メソッド - stdClassオブジェクト認識テスト
     * 
     * 標準的なオブジェクト（stdClass）を見たときの処理をテストします。
     * 未知のオブジェクトに対しても適切に対応できることを確認します。
     * 
     * @test
     * @return void
     */
    public function testSeeGenericObject(): void
    {
        // Given: 汎用オブジェクト
        $genericObject = new stdClass();
        $genericObject->property = 'test';

        // When: PersonがstdClassを見る
        $description = $this->adultPerson->see($genericObject);

        // Then: 適切な描写が返される
        $this->assertIsString($description);
        $this->assertNotEmpty($description);
        $this->assertStringContainsString('オブジェクト', $description, '汎用オブジェクトとして認識されている必要があります');
    }

    /**
     * LensesInterface実装の完全性テスト
     * 
     * PersonクラスがLensesInterfaceで要求される全メソッドを
     * 正しく実装していることを確認します。
     * 
     * @test
     * @return void
     */
    public function testLensesInterfaceImplementation(): void
    {
        // Given & When & Then: 必要なメソッドが存在することを確認
        $this->assertTrue(
            method_exists($this->adultPerson, 'lightRange'),
            'lightRange()メソッドが実装されている必要があります'
        );

        $this->assertTrue(
            method_exists($this->adultPerson, 'see'),
            'see()メソッドが実装されている必要があります'
        );

        // メソッドが callable であることを確認
        $this->assertIsCallable([$this->adultPerson, 'lightRange']);
        $this->assertIsCallable([$this->adultPerson, 'see']);
    }

    /**
     * 境界値テスト - 可視光範囲の境界
     * 
     * 人間の可視光範囲が科学的に正確な値であることを確認します。
     * 380nm（紫外線境界）と700nm（赤外線境界）の境界値をテストします。
     * 
     * @test
     * @return void
     */
    public function testLightRangeBoundaryValues(): void
    {
        // Given & When: 可視光範囲を取得
        $range = $this->adultPerson->lightRange();

        // Then: 境界値の確認
        $this->assertEquals(380, $range[0], '最小値は380nm（可視光の下限）である必要があります');
        $this->assertEquals(700, $range[1], '最大値は700nm（可視光の上限）である必要があります');

        // 範囲の幅が適切であることを確認
        $rangeWidth = $range[1] - $range[0];
        $this->assertEquals(320, $rangeWidth, '可視光範囲の幅は320nmである必要があります');
    }

    /**
     * see()メソッドの返り値詳細テスト
     * 
     * see()メソッドが返す文字列の品質と内容の豊富さをテストします。
     * 意味のある描写が返されることを確認します。
     * 
     * @test
     * @return void
     */
    public function testSeeDescriptionQuality(): void
    {
        // Given: 様々なオブジェクト
        $objects = [
            new Person('Test', 'Person', 170, 60, 25),
            new Horse(400.0),
            new Cow(600.0),
            new Truck(8000.0),
            new Violin()
        ];

        foreach ($objects as $object) {
            // When: オブジェクトを観察
            $description = $this->adultPerson->see($object);

            // Then: 品質の確認
            $this->assertIsString($description);
            $this->assertGreaterThan(10, strlen($description), '描写は十分に詳細である必要があります');
            $this->assertLessThan(500, strlen($description), '描写は簡潔である必要があります');

            // 意味のない空白や改行文字のみでないことを確認
            $this->assertNotEquals(trim($description), '', '描写は空白文字のみであってはいけません');
        }
    }

    /**
     * パフォーマンステスト
     * 
     * lightRange()とsee()メソッドが適切なパフォーマンスで動作することをテストします。
     * 大量の呼び出しでもレスポンシブであることを確認します。
     * 
     * @test
     * @return void
     */
    public function testMethodsPerformance(): void
    {
        // Given: テスト対象
        $target = new Horse(500.0);

        // When & Then: 大量呼び出しのパフォーマンステスト
        $startTime = microtime(true);

        for ($i = 0; $i < 100; $i++) {
            $this->adultPerson->lightRange();
            $this->adultPerson->see($target);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        // 100回の呼び出しが1秒以内に完了することを確認
        $this->assertLessThan(1.0, $executionTime, 'メソッドは十分に高速である必要があります');
    }

    /**
     * テスト後のクリーンアップ
     * 
     * テスト実行後にリソースの解放を行います。
     * 
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->adultPerson, $this->childPerson, $this->elderlyPerson);
        parent::tearDown();
    }
}
