<?php

declare(strict_types=1);

use App\Models\Audible\Cow;
use PHPUnit\Framework\TestCase;

/**
 * Cowクラスのユニットテスト
 * 
 * CowクラスはAudibleInterfaceとEdibleInterfaceの両方を実装しており、
 * 音を出す動物としての機能と食べ物としての機能をテストします。
 * 
 * @package App\Tests\Models\Audible
 * @author Claude Code
 * @version 1.0.0
 */
class CowTest extends TestCase
{
    /**
     * 軽い牛のインスタンス（子牛相当）
     * 
     * @var Cow
     */
    private Cow $lightCow;

    /**
     * 重い牛のインスタンス（成牛相当）
     * 
     * @var Cow
     */
    private Cow $heavyCow;

    /**
     * 平均的な牛のインスタンス
     * 
     * @var Cow
     */
    private Cow $averageCow;

    /**
     * テスト実行前の初期設定
     * 
     * 各テストで使用するCowオブジェクトを作成します。
     * 軽い牛、重い牛、平均的な牛の3つのパターンを用意し、
     * 様々な重量での動作を確認できるようにしています。
     * 
     * @return void
     */
    protected function setUp(): void
    {
        $this->lightCow = new Cow(150.0);    // 子牛相当
        $this->heavyCow = new Cow(800.0);    // 成牛相当
        $this->averageCow = new Cow(500.0);  // 平均的な牛
    }

    /**
     * コンストラクタとプロパティの初期化をテスト
     * 
     * Cowオブジェクトが正しく作成され、適切なクラスのインスタンスであることを確認します。
     * 重量パラメータが適切に設定されることをテストします。
     * 
     * @test
     * @return void
     */
    public function testConstructorAndPropertyInitialization(): void
    {
        // Given: 新しいCowインスタンスを作成
        $cow = new Cow(450.0);
        
        // Then: 正しいクラスのインスタンスであることを確認
        $this->assertInstanceOf(Cow::class, $cow);
        
        // And: Cowクラスが正しく作成されることを確認
        $this->assertIsObject($cow);
    }

    /**
     * __toString()メソッドのテスト
     * 
     * 牛の情報が正しい形式で文字列として返されることを確認します。
     * 重量情報が適切にフォーマットされて表示されることをテストします。
     * 
     * @test
     * @return void
     */
    public function testToString(): void
    {
        // Given & When & Then: 各牛の文字列表現を確認
        $expectedLight = 'This is a cow that weights: 150kg';
        $this->assertEquals($expectedLight, $this->lightCow->__toString());
        
        $expectedHeavy = 'This is a cow that weights: 800kg';
        $this->assertEquals($expectedHeavy, $this->heavyCow->__toString());
        
        $expectedAverage = 'This is a cow that weights: 500kg';
        $this->assertEquals($expectedAverage, $this->averageCow->__toString());
    }

    /**
     * 小数点を含む重量の__toString()メソッドのテスト
     * 
     * 浮動小数点数が正しく表示されることを確認します。
     * 小数点以下の精度が保たれることをテストします。
     * 
     * @test
     * @return void
     */
    public function testToStringWithDecimalWeight(): void
    {
        // Given: 小数点を含む重量の牛を作成
        $cow = new Cow(456.789);
        
        // When: 文字列表現を取得
        $result = $cow->__toString();
        
        // Then: 小数点が正しく表示されることを確認
        $expected = 'This is a cow that weights: 456.789kg';
        $this->assertEquals($expected, $result);
    }

    /**
     * makeNoise()メソッドのテスト（AudibleInterface実装）
     * 
     * "Moooo!!"が標準出力に正しく出力されることを確認します。
     * AudibleInterfaceで定義された音を出す機能をテストします。
     * 
     * @test
     * @return void
     */
    public function testMakeNoise(): void
    {
        // Given & When & Then: 牛の鳴き声が正しく出力されることを確認
        $this->expectOutputString('Moooo!!' . PHP_EOL);
        $this->lightCow->makeNoise();
    }

    /**
     * makeNoise()メソッドの複数回実行テスト
     * 
     * 複数のCowオブジェクトが連続して音を出すことをテストします。
     * 出力のバッファリングが正しく動作することを確認します。
     * 
     * @test
     * @return void
     */
    public function testMakeNoiseMultipleTimes(): void
    {
        // Given: 期待される出力を定義
        $expectedOutput = 'Moooo!!' . PHP_EOL . 'Moooo!!' . PHP_EOL;
        
        // When & Then: 複数の牛が連続して鳴くことを確認
        $this->expectOutputString($expectedOutput);
        $this->lightCow->makeNoise();
        $this->heavyCow->makeNoise();
    }

    /**
     * soundFrequency()メソッドのテスト（AudibleInterface実装）
     * 
     * 全てのCowインスタンスで一定の周波数90.0が返されることを確認します。
     * 牛の音の周波数特性が一定であることをテストします。
     * 
     * @test
     * @return void
     */
    public function testSoundFrequency(): void
    {
        // Given & When & Then: 全ての牛で同じ周波数90.0を返すことを確認
        $this->assertEquals(90.0, $this->lightCow->soundFrequency());
        $this->assertEquals(90.0, $this->heavyCow->soundFrequency());
        $this->assertEquals(90.0, $this->averageCow->soundFrequency());
    }

    /**
     * soundLevel()メソッドのテスト（AudibleInterface実装）
     * 
     * 全てのCowインスタンスで一定の音量70.0dBが返されることを確認します。
     * 牛の鳴き声の音量レベルが一定であることをテストします。
     * 
     * @test
     * @return void
     */
    public function testSoundLevel(): void
    {
        // Given & When & Then: 全ての牛で同じ音量70.0dBを返すことを確認
        $this->assertEquals(70.0, $this->lightCow->soundLevel());
        $this->assertEquals(70.0, $this->heavyCow->soundLevel());
        $this->assertEquals(70.0, $this->averageCow->soundLevel());
    }

    /**
     * howToPrepare()メソッドのテスト（EdibleInterface実装）
     * 
     * 牛肉の調理方法説明が正しく返されることを確認します。
     * EdibleInterfaceで定義された料理方法の取得機能をテストします。
     * 
     * @test
     * @return void
     */
    public function testHowToPrepare(): void
    {
        // Given: 期待される調理方法
        $expectedPreparation = "Cut the cow with a butchering knife into even pieces, and grill each piece at 220C";
        
        // When & Then: 全ての牛で同じ調理方法が返されることを確認
        $this->assertEquals($expectedPreparation, $this->lightCow->howToPrepare());
        $this->assertEquals($expectedPreparation, $this->heavyCow->howToPrepare());
        $this->assertEquals($expectedPreparation, $this->averageCow->howToPrepare());
    }

    /**
     * calories()メソッドのテスト（EdibleInterface実装）
     * 
     * 重量に基づいたカロリー計算が正しく行われることを確認します。
     * 重量 × 1850の計算式でカロリーが算出されることをテストします。
     * 
     * @test
     * @return void
     */
    public function testCalories(): void
    {
        // Given & When & Then: 重量に基づく正しいカロリー計算を確認
        
        // 軽い牛: 150kg × 1850 = 277,500カロリー
        $this->assertEquals(277500.0, $this->lightCow->calories());
        
        // 重い牛: 800kg × 1850 = 1,480,000カロリー
        $this->assertEquals(1480000.0, $this->heavyCow->calories());
        
        // 平均的な牛: 500kg × 1850 = 925,000カロリー
        $this->assertEquals(925000.0, $this->averageCow->calories());
    }

    /**
     * AudibleInterfaceの実装確認テスト
     * 
     * Cowクラスが音を出すために必要な全てのメソッドを持っていることを確認します。
     * インターフェースで定義されたメソッドの存在をテストします。
     * 
     * @test
     * @return void
     */
    public function testAudibleInterfaceImplementation(): void
    {
        // Given & When & Then: AudibleInterfaceで要求されるメソッドが存在することを確認
        $this->assertTrue(method_exists($this->lightCow, 'makeNoise'));
        $this->assertTrue(method_exists($this->lightCow, 'soundFrequency'));
        $this->assertTrue(method_exists($this->lightCow, 'soundLevel'));
    }

    /**
     * EdibleInterfaceの実装確認テスト
     * 
     * Cowクラスが食べ物として必要な全てのメソッドを持っていることを確認します。
     * インターフェースで定義されたメソッドの存在をテストします。
     * 
     * @test
     * @return void
     */
    public function testEdibleInterfaceImplementation(): void
    {
        // Given & When & Then: EdibleInterfaceで要求されるメソッドが存在することを確認
        $this->assertTrue(method_exists($this->lightCow, 'howToPrepare'));
        $this->assertTrue(method_exists($this->lightCow, 'calories'));
    }

    /**
     * 文字列表現に全データが含まれることのテスト
     * 
     * __toString()メソッドが必要な情報を全て含んでいることを確認します。
     * 文字列に期待される要素が全て含まれていることをテストします。
     * 
     * @test
     * @return void
     */
    public function testStringRepresentationIncludesAllData(): void
    {
        // Given: テスト用の牛を作成
        $cow = new Cow(725.5);
        
        // When: 文字列表現を取得
        $stringRep = $cow->__toString();
        
        // Then: 必要な要素が全て含まれていることを確認
        $this->assertStringContainsString('This is a cow', $stringRep);
        $this->assertStringContainsString('725.5kg', $stringRep);
        $this->assertStringContainsString('weights:', $stringRep);
    }

    /**
     * エッジケース値のテスト
     * 
     * 極端な値でのCowクラスの動作を確認します。
     * 最小値、最大値、負の値などの境界値でのテストを実行します。
     * 
     * @test
     * @return void
     */
    public function testEdgeCaseValues(): void
    {
        // Given: 極端な値のテストケース
        
        // When & Then: 最小値でのテスト（0kg）
        $minCow = new Cow(0.0);
        $this->assertEquals('This is a cow that weights: 0kg', $minCow->__toString());
        $this->assertEquals(90.0, $minCow->soundFrequency());
        $this->assertEquals(70.0, $minCow->soundLevel());
        $this->assertEquals(0.0, $minCow->calories()); // 0kg × 1850 = 0カロリー
        
        // And: 大きな値でのテスト
        $maxCow = new Cow(9999.99);
        $this->assertEquals('This is a cow that weights: 9999.99kg', $maxCow->__toString());
        $this->assertEquals(90.0, $maxCow->soundFrequency());
        $this->assertEquals(70.0, $maxCow->soundLevel());
        $this->assertEquals(18499981.5, $maxCow->calories()); // 9999.99kg × 1850
    }

    /**
     * 負の重量値のテスト
     * 
     * 負の値でも動作することを確認します。
     * 実用性は低いですが、技術的な動作の堅牢性をテストします。
     * 
     * @test
     * @return void
     */
    public function testNegativeWeight(): void
    {
        // Given: 負の重量の牛を作成
        $negativeCow = new Cow(-100.0);
        
        // When & Then: 負の重量でも適切に動作することを確認
        $expected = 'This is a cow that weights: -100kg';
        $this->assertEquals($expected, $negativeCow->__toString());
        
        // And: カロリー計算も負の値になることを確認
        $this->assertEquals(-185000.0, $negativeCow->calories()); // -100kg × 1850
    }

    /**
     * 非常に小さい小数点値のテスト
     * 
     * 精度の高い浮動小数点数の処理を確認します。
     * 小数点以下の精度が保たれることをテストします。
     * 
     * @test
     * @return void
     */
    public function testVerySmallDecimalWeight(): void
    {
        // Given: 非常に小さい重量の牛を作成
        $preciseCow = new Cow(0.001);
        
        // When & Then: 小数点の精度が保たれることを確認
        $expected = 'This is a cow that weights: 0.001kg';
        $this->assertEquals($expected, $preciseCow->__toString());
        
        // And: カロリー計算も正確であることを確認
        $this->assertEquals(1.85, $preciseCow->calories()); // 0.001kg × 1850
    }

    /**
     * カロリー計算の精度テスト
     * 
     * 浮動小数点数の計算精度を確認します。
     * 重量とカロリーの関係が正確に計算されることをテストします。
     * 
     * @test
     * @return void
     */
    public function testCaloriesCalculationPrecision(): void
    {
        // Given: 精密な重量値でテスト
        $preciseCow = new Cow(123.456);
        
        // When: カロリーを計算
        $actualCalories = $preciseCow->calories();
        
        // Then: 正確な計算結果を確認（123.456 × 1850 = 228,393.6）
        $expectedCalories = 123.456 * 1850;
        $this->assertEquals($expectedCalories, $actualCalories);
        $this->assertEquals(228393.6, $actualCalories);
    }

    /**
     * カロリー計算用のデータプロバイダー
     * 
     * @return array<array<float>> テストデータの配列
     */
    public static function caloriesDataProvider(): array
    {
        return [
            'light_cow' => [150.0, 277500.0],
            'average_cow' => [500.0, 925000.0],
            'heavy_cow' => [800.0, 1480000.0],
            'precise_cow' => [123.456, 228393.6],
        ];
    }
}