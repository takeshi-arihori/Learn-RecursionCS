<?php

declare(strict_types=1);

use App\Models\Audible\Truck;
use PHPUnit\Framework\TestCase;

/**
 * TruckPhysicsTest - TruckクラスのPhysicsObjectInterface実装テスト
 *
 * TruckクラスがPhysicsObjectInterfaceを正しく実装していることを確認します。
 * トラックの物理的特性（エネルギー計算、密度、重量）をテストします。
 *
 * テスト対象メソッド：
 * - workToMove(float $meters): 指定距離を移動するのに必要なエネルギーを計算
 * - density(): トラックの密度を返す
 * - weight(float $gravity): 指定重力下での重量を計算
 *
 * @package App\Tests\Models\Audible
 * @author Claude Code
 * @version 1.0.0
 * @since 2025-01-27
 */
class TruckPhysicsTest extends TestCase
{
    /**
     * 軽量トラックのインスタンス（小型トラック相当）
     *
     * @var Truck
     */
    private Truck $lightTruck;

    /**
     * 中重量トラックのインスタンス（中型トラック相当）
     *
     * @var Truck
     */
    private Truck $mediumTruck;

    /**
     * 重量トラックのインスタンス（大型トラック相当）
     *
     * @var Truck
     */
    private Truck $heavyTruck;

    /**
     * テスト実行前の初期設定
     *
     * 異なる重量のTruckオブジェクトを作成し、
     * 様々な条件での物理計算をテストできるように準備します。
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->lightTruck = new Truck(3000.0);    // 小型トラック相当（3トン）
        $this->mediumTruck = new Truck(8000.0);   // 中型トラック相当（8トン）
        $this->heavyTruck = new Truck(25000.0);   // 大型トラック相当（25トン）
    }

    /**
     * workToMove()メソッドの基本機能テスト
     *
     * トラックが指定された距離を移動するのに必要なエネルギーが
     * 正しく計算されることをテストします。
     * エネルギー = 力 × 距離 = (質量 × 重力 × 摩擦係数) × 距離
     *
     * @test
     * @return void
     */
    public function testWorkToMoveBasicCalculation(): void
    {
        // Given: 軽量トラック（3000kg）と移動距離（100m）
        $distance = 100.0;

        // When: 移動に必要なエネルギーを計算
        $workRequired = $this->lightTruck->workToMove($distance);

        // Then: 適切なエネルギー値が返される
        $this->assertIsFloat($workRequired, '戻り値は浮動小数点数である必要があります');
        $this->assertGreaterThan(0, $workRequired, 'エネルギーは正の値である必要があります');

        // 重量に比例してエネルギーが増加することを確認
        $heavyWorkRequired = $this->heavyTruck->workToMove($distance);
        $this->assertGreaterThan($workRequired, $heavyWorkRequired, '重いトラックはより多くのエネルギーを必要とします');
    }

    /**
     * workToMove()メソッドの距離依存性テスト
     *
     * エネルギー計算が移動距離に正比例することをテストします。
     * 距離が2倍になれば、必要エネルギーも2倍になることを確認します。
     *
     * @test
     * @return void
     */
    public function testWorkToMoveDistanceProportionality(): void
    {
        // Given: 基準距離とその2倍の距離
        $baseDistance = 50.0;
        $doubleDistance = 100.0;

        // When: それぞれの距離での必要エネルギーを計算
        $baseWork = $this->mediumTruck->workToMove($baseDistance);
        $doubleWork = $this->mediumTruck->workToMove($doubleDistance);

        // Then: 2倍の距離では2倍のエネルギーが必要
        $expectedDoubleWork = $baseWork * 2.0;
        $this->assertEqualsWithDelta($expectedDoubleWork, $doubleWork, 0.01, '距離に比例してエネルギーが増加する必要があります');
    }

    /**
     * workToMove()メソッドの重量依存性テスト
     *
     * エネルギー計算が車両重量に正比例することをテストします。
     * 質量が大きいほど必要エネルギーが増加することを確認します。
     *
     * @test
     * @return void
     */
    public function testWorkToMoveWeightProportionality(): void
    {
        // Given: 同じ距離
        $distance = 200.0;

        // When: 異なる重量のトラックでの必要エネルギーを計算
        $lightWork = $this->lightTruck->workToMove($distance);    // 3トン
        $mediumWork = $this->mediumTruck->workToMove($distance);  // 8トン
        $heavyWork = $this->heavyTruck->workToMove($distance);    // 25トン

        // Then: 重量順にエネルギーが増加
        $this->assertLessThan($mediumWork, $lightWork, '軽いトラックは中型より少ないエネルギー');
        $this->assertLessThan($heavyWork, $mediumWork, '中型トラックは大型より少ないエネルギー');

        // 重量比とエネルギー比の関係を確認
        $weightRatio = $this->mediumTruck->workToMove(1) / $this->lightTruck->workToMove(1);
        $expectedWeightRatio = 8000.0 / 3000.0; // 重量比
        $this->assertEqualsWithDelta($expectedWeightRatio, $weightRatio, 0.01, '重量比とエネルギー比が一致する必要があります');
    }

    /**
     * workToMove()メソッドのゼロ距離テスト
     *
     * 距離がゼロの場合、必要エネルギーもゼロになることをテストします。
     *
     * @test
     * @return void
     */
    public function testWorkToMoveZeroDistance(): void
    {
        // Given: ゼロ距離
        $zeroDistance = 0.0;

        // When & Then: すべてのトラックでゼロエネルギーを返す
        $this->assertEquals(0.0, $this->lightTruck->workToMove($zeroDistance), '距離ゼロではエネルギーもゼロ');
        $this->assertEquals(0.0, $this->mediumTruck->workToMove($zeroDistance), '距離ゼロではエネルギーもゼロ');
        $this->assertEquals(0.0, $this->heavyTruck->workToMove($zeroDistance), '距離ゼロではエネルギーもゼロ');
    }

    /**
     * density()メソッドの基本機能テスト
     *
     * トラックの密度が適切な値を返すことをテストします。
     * トラックは主に鋼鉄製なので、鋼鉄の密度（約7850 kg/m³）に近い値を返すことを確認します。
     *
     * @test
     * @return void
     */
    public function testDensityReturnsReasonableValue(): void
    {
        // Given & When: 各トラックの密度を取得
        $lightDensity = $this->lightTruck->density();
        $mediumDensity = $this->mediumTruck->density();
        $heavyDensity = $this->heavyTruck->density();

        // Then: 密度が適切な範囲内にある
        $this->assertIsFloat($lightDensity, '密度は浮動小数点数である必要があります');
        $this->assertGreaterThan(1000.0, $lightDensity, '密度は水より大きい必要があります（金属製）');
        $this->assertLessThan(20000.0, $lightDensity, '密度は現実的な範囲内である必要があります');

        // すべてのトラックで同じ密度を返す（材質が同じため）
        $this->assertEquals($lightDensity, $mediumDensity, '同じ材質のトラックは同じ密度を持つ必要があります');
        $this->assertEquals($mediumDensity, $heavyDensity, '同じ材質のトラックは同じ密度を持つ必要があります');
    }

    /**
     * density()メソッドの鋼鉄密度一致テスト
     *
     * トラックの密度が実際の鋼鉄の密度に近いことをテストします。
     * 鋼鉄の標準密度は約7850 kg/m³です。
     *
     * @test
     * @return void
     */
    public function testDensityMatchesSteelDensity(): void
    {
        // Given: 鋼鉄の標準密度
        $steelDensity = 7850.0; // kg/m³

        // When: トラックの密度を取得
        $truckDensity = $this->mediumTruck->density();

        // Then: 鋼鉄密度に近い値を返す
        $this->assertEqualsWithDelta($steelDensity, $truckDensity, 1000.0, 'トラックの密度は鋼鉄に近い値である必要があります');
    }

    /**
     * weight()メソッドの地球重力テスト
     *
     * 地球の標準重力（9.8 m/s²）でのトラックの重量計算をテストします。
     * 重量 = 質量 × 重力加速度
     *
     * @test
     * @return void
     */
    public function testWeightWithEarthGravity(): void
    {
        // Given: 地球の標準重力
        $earthGravity = 9.8; // m/s²

        // When: 各トラックの重量を計算
        $lightWeight = $this->lightTruck->weight($earthGravity);    // 3000kg
        $mediumWeight = $this->mediumTruck->weight($earthGravity);  // 8000kg
        $heavyWeight = $this->heavyTruck->weight($earthGravity);    // 25000kg

        // Then: 重量 = 質量 × 重力の関係を確認
        $this->assertEqualsWithDelta(3000.0 * 9.8, $lightWeight, 0.1, '軽量トラックの重量計算');
        $this->assertEqualsWithDelta(8000.0 * 9.8, $mediumWeight, 0.1, '中型トラックの重量計算');
        $this->assertEqualsWithDelta(25000.0 * 9.8, $heavyWeight, 0.1, '大型トラックの重量計算');
    }

    /**
     * weight()メソッドの月面重力テスト
     *
     * 月面の重力（約1.6 m/s²）でのトラックの重量計算をテストします。
     * 異なる重力環境での動作を確認します。
     *
     * @test
     * @return void
     */
    public function testWeightWithMoonGravity(): void
    {
        // Given: 月面の重力
        $moonGravity = 1.6; // m/s²

        // When: 中型トラックの月面での重量を計算
        $moonWeight = $this->mediumTruck->weight($moonGravity);

        // Then: 月面重量 = 質量 × 月重力
        $expectedMoonWeight = 8000.0 * 1.6;
        $this->assertEqualsWithDelta($expectedMoonWeight, $moonWeight, 0.1, '月面でのトラック重量計算');

        // 地球重量と比較
        $earthWeight = $this->mediumTruck->weight(9.8);
        $this->assertLessThan($earthWeight, $moonWeight, '月面では地球より軽い');
    }

    /**
     * weight()メソッドの重力比例性テスト
     *
     * 重力が変化したときに重量が正比例で変化することをテストします。
     *
     * @test
     * @return void
     */
    public function testWeightGravityProportionality(): void
    {
        // Given: 異なる重力値
        $gravity1 = 5.0;  // m/s²
        $gravity2 = 10.0; // m/s²（2倍）

        // When: それぞれの重力での重量を計算
        $weight1 = $this->lightTruck->weight($gravity1);
        $weight2 = $this->lightTruck->weight($gravity2);

        // Then: 重力が2倍なら重量も2倍
        $expectedWeight2 = $weight1 * 2.0;
        $this->assertEquals($expectedWeight2, $weight2, '重力に比例して重量が変化する必要があります');
    }

    /**
     * weight()メソッドのゼロ重力テスト
     *
     * 重力がゼロの場合（無重力状態）での重量計算をテストします。
     *
     * @test
     * @return void
     */
    public function testWeightWithZeroGravity(): void
    {
        // Given: 無重力状態
        $zeroGravity = 0.0;

        // When: 無重力での重量を計算
        $zeroWeight = $this->heavyTruck->weight($zeroGravity);

        // Then: 重量はゼロ
        $this->assertEquals(0.0, $zeroWeight, '無重力では重量はゼロになる必要があります');
    }

    /**
     * PhysicsObjectInterface実装の完全性テスト
     *
     * TruckクラスがPhysicsObjectInterfaceで要求される全メソッドを
     * 正しく実装していることを確認します。
     *
     * @test
     * @return void
     */
    public function testPhysicsObjectInterfaceImplementation(): void
    {
        // Given & When & Then: 必要なメソッドが存在することを確認
        $this->assertTrue(
            method_exists($this->lightTruck, 'workToMove'),
            'workToMove()メソッドが実装されている必要があります',
        );

        $this->assertTrue(
            method_exists($this->lightTruck, 'density'),
            'density()メソッドが実装されている必要があります',
        );

        $this->assertTrue(
            method_exists($this->lightTruck, 'weight'),
            'weight()メソッドが実装されている必要があります',
        );

        // メソッドがcallableであることを確認
        $this->assertIsCallable([$this->lightTruck, 'workToMove']);
        $this->assertIsCallable([$this->lightTruck, 'density']);
        $this->assertIsCallable([$this->lightTruck, 'weight']);
    }

    /**
     * 負の値に対するエラーハンドリングテスト
     *
     * 負の距離や重力に対して適切に処理されることをテストします。
     *
     * @test
     * @return void
     */
    public function testNegativeValuesHandling(): void
    {
        // Given: 負の距離と負の重力
        $negativeDistance = -50.0;
        $negativeGravity = -9.8;

        // When & Then: 負の距離での移動エネルギー
        $negativeWork = $this->mediumTruck->workToMove($negativeDistance);
        $this->assertLessThanOrEqual(0, $negativeWork, '負の距離では非正の値を返す必要があります');

        // 負の重力での重量
        $negativeWeight = $this->mediumTruck->weight($negativeGravity);
        $this->assertLessThanOrEqual(0, $negativeWeight, '負の重力では非正の値を返す必要があります');
    }

    /**
     * 大きな値での計算精度テスト
     *
     * 非常に大きな距離や重力値での計算精度をテストします。
     *
     * @test
     * @return void
     */
    public function testLargeValuesCalculation(): void
    {
        // Given: 非常に大きな値
        $largeDistance = 1000000.0; // 1000km
        $largeGravity = 100.0;      // 10倍重力

        // When: 大きな値での計算
        $largeWork = $this->heavyTruck->workToMove($largeDistance);
        $largeWeight = $this->heavyTruck->weight($largeGravity);

        // Then: 計算結果が適切に処理される
        $this->assertIsFloat($largeWork);
        $this->assertIsFloat($largeWeight);
        $this->assertGreaterThan(0, $largeWork);
        $this->assertGreaterThan(0, $largeWeight);

        // オーバーフローしていないことを確認
        $this->assertTrue(is_finite($largeWork), '計算結果は有限値である必要があります');
        $this->assertTrue(is_finite($largeWeight), '計算結果は有限値である必要があります');
    }

    /**
     * 小数点精度テスト
     *
     * 小数点を含む値での計算精度をテストします。
     *
     * @test
     * @return void
     */
    public function testDecimalPrecision(): void
    {
        // Given: 小数点を含む値
        $preciseDistance = 123.456;
        $preciseGravity = 9.80665; // 標準重力の正確な値

        // When: 精密な計算を実行
        $preciseWork = $this->lightTruck->workToMove($preciseDistance);
        $preciseWeight = $this->lightTruck->weight($preciseGravity);

        // Then: 精度が保たれている
        $this->assertIsFloat($preciseWork);
        $this->assertIsFloat($preciseWeight);

        // 期待される値との比較（小数点以下の精度を確認）
        $expectedWeight = 3000.0 * 9.80665;
        $this->assertEqualsWithDelta($expectedWeight, $preciseWeight, 0.001, '小数点精度が保たれている必要があります');
    }

    /**
     * 一貫性テスト - 複数回呼び出しでの結果一致
     *
     * 同じパラメータで複数回メソッドを呼び出したときに、
     * 同じ結果が返されることをテストします。
     *
     * @test
     * @return void
     */
    public function testConsistency(): void
    {
        // Given: テストパラメータ
        $distance = 500.0;
        $gravity = 9.8;

        // When: 複数回同じ計算を実行
        $work1 = $this->mediumTruck->workToMove($distance);
        $work2 = $this->mediumTruck->workToMove($distance);
        $work3 = $this->mediumTruck->workToMove($distance);

        $density1 = $this->mediumTruck->density();
        $density2 = $this->mediumTruck->density();

        $weight1 = $this->mediumTruck->weight($gravity);
        $weight2 = $this->mediumTruck->weight($gravity);

        // Then: 結果が一致する
        $this->assertEquals($work1, $work2, 'workToMove()の結果が一貫している必要があります');
        $this->assertEquals($work2, $work3, 'workToMove()の結果が一貫している必要があります');
        $this->assertEquals($density1, $density2, 'density()の結果が一貫している必要があります');
        $this->assertEquals($weight1, $weight2, 'weight()の結果が一貫している必要があります');
    }

    /**
     * 現実的な使用ケーステスト
     *
     * 実際のトラックの使用場面を想定したテストを実行します。
     *
     * @test
     * @return void
     */
    public function testRealisticUseCases(): void
    {
        // Given: 配送シナリオ（10km配送）
        $deliveryDistance = 10000.0; // 10km = 10000m
        $earthGravity = 9.8;

        // When: 配送に必要なエネルギーと重量を計算
        $deliveryEnergy = $this->mediumTruck->workToMove($deliveryDistance);
        $truckWeight = $this->mediumTruck->weight($earthGravity);
        $materialDensity = $this->mediumTruck->density();

        // Then: 現実的な値が返される
        $this->assertGreaterThan(100000, $deliveryEnergy, '10km配送には相応のエネルギーが必要');
        $this->assertEqualsWithDelta(78400, $truckWeight, 1000, '8トントラックの地球での重量');
        $this->assertEqualsWithDelta(7850, $materialDensity, 500, '鋼鉄に近い密度');
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
        unset($this->lightTruck, $this->mediumTruck, $this->heavyTruck);
        parent::tearDown();
    }
}
