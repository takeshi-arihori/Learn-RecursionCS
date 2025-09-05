<?php

declare(strict_types=1);

use App\Models\Audible\Violin;
use PHPUnit\Framework\TestCase;

/**
 * Violinクラスのユニットテスト
 * 
 * ViolinクラスはAudibleInterfaceを実装しており、
 * 音を出す楽器としての機能をテストします。
 * バイオリンは美しい音色を持つ弦楽器として表現されます。
 * 
 * @package App\Tests\Models\Audible
 * @author Claude Code
 * @version 1.0.0
 */
class ViolinTest extends TestCase
{
    /**
     * テスト用のViolinインスタンス
     * 
     * @var Violin
     */
    private Violin $violin;

    /**
     * テスト実行前の初期設定
     * 
     * 各テストで使用するViolinオブジェクトを作成します。
     * バイオリンはコンストラクタパラメータを持たないため、
     * 単純にインスタンス化します。
     * 
     * @return void
     */
    protected function setUp(): void
    {
        $this->violin = new Violin();
    }

    /**
     * コンストラクタとプロパティの初期化をテスト
     * 
     * Violinオブジェクトが正しく作成され、適切なクラスのインスタンスであることを確認します。
     * デフォルトの音響特性が正しく設定されることをテストします。
     * 
     * @test
     * @return void
     */
    public function testConstructorAndPropertyInitialization(): void
    {
        // Given: 新しいViolinインスタンスを作成
        $violin = new Violin();

        // Then: 正しいクラスのインスタンスであることを確認
        $this->assertInstanceOf(Violin::class, $violin);

        // And: Violinクラスが正しく作成されることを確認
        $this->assertIsObject($violin);
    }

    /**
     * __toString()メソッドのテスト
     * 
     * バイオリンの情報が正しい形式で文字列として返されることを確認します。
     * 楽器の説明文が適切にフォーマットされて表示されることをテストします。
     * 
     * @test
     * @return void
     */
    public function testToString(): void
    {
        // Given & When: バイオリンの文字列表現を取得
        $result = $this->violin->__toString();

        // Then: 期待される文字列が返されることを確認
        $expected = 'This is a violin that plays music: ';
        $this->assertEquals($expected, $result);
    }

    /**
     * makeNoise()メソッドのテスト（AudibleInterface実装）
     * 
     * "Beep Beep!!"が標準出力に正しく出力されることを確認します。
     * AudibleInterfaceで定義された音を出す機能をテストします。
     * 
     * Note: 実際のバイオリンは美しい音色を奏でますが、
     * このクラスでは簡単な音として実装されています。
     * 
     * @test
     * @return void
     */
    public function testMakeNoise(): void
    {
        // Given & When & Then: バイオリンの音が正しく出力されることを確認
        $this->expectOutputString('Beep Beep!!' . PHP_EOL);
        $this->violin->makeNoise();
    }

    /**
     * makeNoise()メソッドの複数回実行テスト
     * 
     * 複数のViolinオブジェクトが連続して音を出すことをテストします。
     * アンサンブル演奏や複数のバイオリンが同時に演奏するシナリオをテストします。
     * 
     * @test
     * @return void
     */
    public function testMakeNoiseMultipleTimes(): void
    {
        // Given: 期待される出力を定義
        $expectedOutput = 'Beep Beep!!' . PHP_EOL . 'Beep Beep!!' . PHP_EOL;

        // And: 複数のバイオリンを用意
        $violin1 = new Violin();
        $violin2 = new Violin();

        // When & Then: 複数のバイオリンが連続して音を出すことを確認
        $this->expectOutputString($expectedOutput);
        $violin1->makeNoise();
        $violin2->makeNoise();
    }

    /**
     * soundFrequency()メソッドのテスト（AudibleInterface実装）
     * 
     * バイオリンの音の周波数659.3Hzが返されることを確認します。
     * この周波数はE5音程（ミ）に対応する美しい音域をテストします。
     * 
     * @test
     * @return void
     */
    public function testSoundFrequency(): void
    {
        // Given & When: バイオリンの周波数を取得
        $frequency = $this->violin->soundFrequency();

        // Then: 659.3Hz（E5音程）が返されることを確認
        $this->assertEquals(659.3, $frequency);
    }

    /**
     * soundLevel()メソッドのテスト（AudibleInterface実装）
     * 
     * バイオリンの音量95.0dBが返されることを確認します。
     * 楽器らしい適度な音量レベルをテストします。
     * 
     * @test
     * @return void
     */
    public function testSoundLevel(): void
    {
        // Given & When: バイオリンの音量を取得
        $soundLevel = $this->violin->soundLevel();

        // Then: 95.0dBが返されることを確認
        $this->assertEquals(95.0, $soundLevel);
    }

    /**
     * AudibleInterfaceの実装確認テスト
     * 
     * Violinクラスが音を出すために必要な全てのメソッドを持っていることを確認します。
     * インターフェースで定義されたメソッドの存在をテストします。
     * 
     * @test
     * @return void
     */
    public function testAudibleInterfaceImplementation(): void
    {
        // Given & When & Then: AudibleInterfaceで要求されるメソッドが存在することを確認
        $this->assertTrue(method_exists($this->violin, 'makeNoise'));
        $this->assertTrue(method_exists($this->violin, 'soundFrequency'));
        $this->assertTrue(method_exists($this->violin, 'soundLevel'));
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
        // Given: バイオリンの文字列表現を取得
        $stringRep = $this->violin->__toString();

        // When & Then: 必要な要素が含まれていることを確認
        $this->assertStringContainsString('This is a violin', $stringRep);
        $this->assertStringContainsString('plays music', $stringRep);
    }

    /**
     * バイオリンの音響特性テスト
     * 
     * バイオリンが楽器らしい音響特性を持っていることを確認します。
     * 他の楽器と比較して適切な周波数と音量を持つことをテストします。
     * 
     * @test
     * @return void
     */
    public function testMusicalInstrumentCharacteristics(): void
    {
        // Given: バイオリンの音響特性を取得
        $frequency = $this->violin->soundFrequency();
        $soundLevel = $this->violin->soundLevel();

        // When & Then: 楽器らしい音響特性を確認

        // 周波数: 659.3Hz（E5音程の美しい音域）
        $this->assertEquals(659.3, $frequency);
        $this->assertGreaterThan(400.0, $frequency, 'バイオリンは中高音域の楽器');
        $this->assertLessThan(800.0, $frequency, 'バイオリンの音域は適度な高さ');

        // 音量: 95.0dB（楽器らしい適度な音量）
        $this->assertEquals(95.0, $soundLevel);
        $this->assertGreaterThan(80.0, $soundLevel, 'バイオリンは十分な音量を持つ');
        $this->assertLessThan(110.0, $soundLevel, 'バイオリンの音量は耳に優しい');
    }

    /**
     * 音楽的特性の一貫性テスト
     * 
     * バイオリンの音響特性が複数回の呼び出しで一貫していることを確認します。
     * 楽器として安定した音程と音量を維持することをテストします。
     * 
     * @test
     * @return void
     */
    public function testConsistentMusicalProperties(): void
    {
        // Given: 複数のバイオリンインスタンス
        $violins = [
            new Violin(),
            new Violin(),
            new Violin(),
        ];

        // When & Then: 全てのバイオリンが同じ音響特性を持つことを確認
        foreach ($violins as $violin) {
            $this->assertEquals(659.3, $violin->soundFrequency(), '全てのバイオリンが同じ音程');
            $this->assertEquals(95.0, $violin->soundLevel(), '全てのバイオリンが同じ音量');
            $this->assertEquals('This is a violin that plays music: ', $violin->__toString(), '全てのバイオリンが同じ説明');
        }
    }

    /**
     * 楽器としての分類テスト
     * 
     * バイオリンが適切な楽器カテゴリに属することを確認します。
     * 弦楽器としての特性を間接的にテストします。
     * 
     * @test
     * @return void
     */
    public function testInstrumentClassification(): void
    {
        // Given: バイオリンの説明
        $description = $this->violin->__toString();

        // When & Then: 楽器としての特徴を確認
        $this->assertStringContainsString('violin', $description, 'バイオリンとして識別される');
        $this->assertStringContainsString('music', $description, '音楽を奏でる楽器');
        $this->assertStringNotContainsString('noise', strtolower($description), 'ノイズではなく音楽');
    }

    /**
     * 連続演奏シミュレーションテスト
     * 
     * バイオリンが連続して演奏される場面をシミュレートします。
     * コンサートや練習での連続使用に対する動作を確認します。
     * 
     * @test
     * @return void
     */
    public function testContinuousPerformance(): void
    {
        // Given: テスト用のバイオリン
        $violin = new Violin();

        // When & Then: 複数回の演奏で一貫した結果を確認
        for ($i = 0; $i < 10; $i++) {
            $this->assertEquals('This is a violin that plays music: ', $violin->__toString());
            $this->assertEquals(659.3, $violin->soundFrequency());
            $this->assertEquals(95.0, $violin->soundLevel());
        }
    }

    /**
     * バイオリンの音程精度テスト
     * 
     * バイオリンの音程が正確であることを確認します。
     * 659.3HzがE5音程に正確に対応していることをテストします。
     * 
     * @test
     * @return void
     */
    public function testPitchAccuracy(): void
    {
        // Given: 標準的なE5音程の周波数
        $standardE5Frequency = 659.25; // 理論値
        $tolerance = 0.5; // 許容誤差

        // When: バイオリンの周波数を取得
        $violinFrequency = $this->violin->soundFrequency();

        // Then: E5音程に近い周波数であることを確認
        $this->assertEqualsWithDelta(
            $standardE5Frequency,
            $violinFrequency,
            $tolerance,
            'バイオリンの音程がE5に近い'
        );
    }
}
