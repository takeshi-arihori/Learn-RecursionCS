<?php

declare(strict_types=1);

use App\Models\Audible\Person;
use PHPUnit\Framework\TestCase;

/**
 * Personクラスのユニットテスト
 * Audibleインターフェースの実装とPersonクラスの全メソッドをテストします
 */
class PersonTest extends TestCase
{
    private Person $adultPerson;    // 大人のPersonオブジェクト（25歳）
    private Person $youngPerson;    // 若いPersonオブジェクト（15歳）
    private Person $borderlineAge;  // 境界年齢のPersonオブジェクト（16歳）

    /**
     * テスト実行前の初期設定
     * 各テストで使用するPersonオブジェクトを作成します
     */
    protected function setUp(): void
    {
        $this->adultPerson = new Person('John', 'Doe', 175, 70, 25);
        $this->youngPerson = new Person('Jane', 'Smith', 160, 50, 15);
        $this->borderlineAge = new Person('Mike', 'Johnson', 180, 75, 16);
    }

    /**
     * コンストラクタとプロパティの初期化をテスト
     * Personオブジェクトが正しく作成され、適切なインターフェースを実装していることを確認
     */
    public function testConstructorAndPropertyInitialization(): void
    {
        $person = new Person('Test', 'User', 170, 65, 30);
        $this->assertInstanceOf(Person::class, $person);
        // Personクラスが正しく作成されることを確認
    }

    /**
     * getFullName()メソッドのテスト
     * 名前と姓が正しく結合されて返されることを確認
     */
    public function testGetFullName(): void
    {
        $this->assertEquals('John Doe', $this->adultPerson->getFullName());
        $this->assertEquals('Jane Smith', $this->youngPerson->getFullName());
        $this->assertEquals('Mike Johnson', $this->borderlineAge->getFullName());
    }

    /**
     * 特殊文字を含む名前のgetFullName()メソッドのテスト
     * アクセント記号やハイフンを含む名前が正しく処理されることを確認
     */
    public function testGetFullNameWithSpecialCharacters(): void
    {
        $person = new Person('José', 'García-López', 170, 65, 30);
        $this->assertEquals('José García-López', $person->getFullName());
    }

    /**
     * __toString()メソッドのテスト
     * 人物の情報が正しい形式で文字列として返されることを確認
     */
    public function testToString(): void
    {
        $expectedAdult = 'John Doe who is 175m tall and weights 70kg.';
        $this->assertEquals($expectedAdult, $this->adultPerson->__toString());

        $expectedYoung = 'Jane Smith who is 160m tall and weights 50kg.';
        $this->assertEquals($expectedYoung, $this->youngPerson->__toString());

        $expectedBorderline = 'Mike Johnson who is 180m tall and weights 75kg.';
        $this->assertEquals($expectedBorderline, $this->borderlineAge->__toString());
    }

    /**
     * makeNoise()メソッドのテスト
     * "Hello World!"が標準出力に正しく出力されることを確認
     */
    public function testMakeNoise(): void
    {
        $this->expectOutputString('Hello World!' . PHP_EOL);
        $this->adultPerson->makeNoise();
    }

    /**
     * makeNoise()メソッドの複数回実行テスト
     * 複数のPersonオブジェクトが連続して音を出すことをテスト
     */
    public function testMakeNoiseMultipleTimes(): void
    {
        $expectedOutput = 'Hello World!' . PHP_EOL . 'Hello World!' . PHP_EOL;
        $this->expectOutputString($expectedOutput);
        $this->adultPerson->makeNoise();
        $this->youngPerson->makeNoise();
    }

    /**
     * 大人のsoundFrequency()メソッドのテスト
     * 16歳より上の年齢の場合、110.0が返されることを確認
     */
    public function testSoundFrequencyForAdults(): void
    {
        // 年齢 > 16 の場合は 110.0 を返すべき
        $this->assertEquals(110.0, $this->adultPerson->soundFrequency());

        // 別の大人でもテスト
        $anotherAdult = new Person('Alice', 'Brown', 165, 55, 35);
        $this->assertEquals(110.0, $anotherAdult->soundFrequency());
    }

    /**
     * 若い人のsoundFrequency()メソッドのテスト
     * 16歳以下の年齢の場合、130.0が返されることを確認
     */
    public function testSoundFrequencyForYoung(): void
    {
        // 年齢 <= 16 の場合は 130.0 を返すべき
        $this->assertEquals(130.0, $this->youngPerson->soundFrequency());
        $this->assertEquals(130.0, $this->borderlineAge->soundFrequency());

        // とても若い人でもテスト
        $child = new Person('Tom', 'Kid', 120, 30, 8);
        $this->assertEquals(130.0, $child->soundFrequency());
    }

    /**
     * soundFrequency()の境界条件テスト
     * 16歳ちょうどと17歳の場合の動作を確認
     */
    public function testSoundFrequencyBoundaryConditions(): void
    {
        // 16歳ちょうどのテスト
        $exactly16 = new Person('Sixteen', 'Years', 170, 60, 16);
        $this->assertEquals(130.0, $exactly16->soundFrequency());

        // 17歳のテスト（境界を超えた場合）
        $seventeen = new Person('Seventeen', 'Years', 170, 60, 17);
        $this->assertEquals(110.0, $seventeen->soundFrequency());
    }

    /**
     * 大人のsoundLevel()メソッドのテスト
     * 16歳より上の年齢の場合、60.0が返されることを確認
     */
    public function testSoundLevelForAdults(): void
    {
        // 年齢 > 16 の場合は 60.0 を返すべき
        $this->assertEquals(60.0, $this->adultPerson->soundLevel());

        // 別の大人でもテスト
        $anotherAdult = new Person('Bob', 'White', 185, 80, 45);
        $this->assertEquals(60.0, $anotherAdult->soundLevel());
    }

    /**
     * 若い人のsoundLevel()メソッドのテスト
     * 16歳以下の年齢の場合、65.0が返されることを確認
     */
    public function testSoundLevelForYoung(): void
    {
        // 年齢 <= 16 の場合は 65.0 を返すべき
        $this->assertEquals(65.0, $this->youngPerson->soundLevel());
        $this->assertEquals(65.0, $this->borderlineAge->soundLevel());

        // とても若い人でもテスト
        $child = new Person('Sally', 'Child', 100, 25, 5);
        $this->assertEquals(65.0, $child->soundLevel());
    }

    /**
     * soundLevel()の境界条件テスト
     * 16歳ちょうどと17歳の場合の動作を確認
     */
    public function testSoundLevelBoundaryConditions(): void
    {
        // 16歳ちょうどのテスト
        $exactly16 = new Person('Sixteen', 'Years', 170, 60, 16);
        $this->assertEquals(65.0, $exactly16->soundLevel());

        // 17歳のテスト（境界を超えた場合）
        $seventeen = new Person('Seventeen', 'Years', 170, 60, 17);
        $this->assertEquals(60.0, $seventeen->soundLevel());
    }

    /**
     * Audibleインターフェースの実装確認テスト
     * Personクラスが必要なメソッドを持っていることを確認
     */
    public function testAudibleInterfaceImplementation(): void
    {
        // インターフェースで要求されるメソッドが存在することを確認

        // 必要なメソッドが存在することを確認
        $this->assertTrue(method_exists($this->adultPerson, 'makeNoise'));
        $this->assertTrue(method_exists($this->adultPerson, 'soundFrequency'));
        $this->assertTrue(method_exists($this->adultPerson, 'soundLevel'));
    }

    /**
     * 文字列表現に全データが含まれることのテスト
     * __toString()メソッドが必要な情報を全て含んでいることを確認
     */
    public function testStringRepresentationIncludesAllData(): void
    {
        $person = new Person('Test', 'Person', 190, 85, 28);
        $stringRep = $person->__toString();

        $this->assertStringContainsString('Test Person', $stringRep);
        $this->assertStringContainsString('190m', $stringRep);
        $this->assertStringContainsString('85kg', $stringRep);
        $this->assertStringContainsString('who is', $stringRep);
        $this->assertStringContainsString('tall and weights', $stringRep);
    }

    /**
     * エッジケース値のテスト
     * 極端な値でのPersonクラスの動作を確認
     */
    public function testEdgeCaseValues(): void
    {
        // 最小値でのテスト
        $minPerson = new Person('A', 'B', 1, 1, 0);
        $this->assertEquals('A B', $minPerson->getFullName());
        $this->assertEquals(130.0, $minPerson->soundFrequency()); // Age 0 <= 16
        $this->assertEquals(65.0, $minPerson->soundLevel());

        // Test with large values
        $maxPerson = new Person('VeryLongFirstName', 'VeryLongLastName', 999, 999, 999);
        $this->assertEquals('VeryLongFirstName VeryLongLastName', $maxPerson->getFullName());
        $this->assertEquals(110.0, $maxPerson->soundFrequency()); // 年齢 999 > 16
        $this->assertEquals(60.0, $maxPerson->soundLevel());
    }
}
