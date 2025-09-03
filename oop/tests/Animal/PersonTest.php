<?php

declare(strict_types=1);

namespace App\Tests\Animal;

use App\Models\Animal\Cow;
use App\Models\Animal\Mammal;
use App\Models\Animal\Person;
use App\Models\Farm\Farm;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    private array $defaultPersonArgs;

    protected function setUp(): void
    {
        // Personのコンストラクタに必要なデフォルト引数
        $this->defaultPersonArgs = [
            'species' => 'human',
            'heightM' => 1.75,
            'weightKg' => 70.0,
            'lifeSpanDays' => 30000,
            'biologicalSex' => 'male',
            'age' => 25.0,
            'furLengthCm' => 0.5,
            'furType' => 'straight',
            'avgBodyTemperatureC' => 36.5,
            'name' => 'John Doe',
            'money' => 1000.0,
        ];
    }

    public function testPersonCanBeCreatedAndHasInitialProperties(): void
    {
        // Given: 人物の基本パラメータ
        $person = new Person(...array_values($this->defaultPersonArgs));

        // When: 人物が作成される
        // Then: 正しくインスタンス化される
        $this->assertInstanceOf(Person::class, $person);
        $this->assertInstanceOf(Mammal::class, $person);
        $this->assertEquals('John Doe', $person->getName());
        $this->assertEquals(1000.0, $person->getMoney());
        $this->assertNull($person->getFarm());
    }

    public function testPersonInheritsFromMammal(): void
    {
        // Given: 人物のインスタンス
        $person = new Person(...array_values($this->defaultPersonArgs));

        // When: 継承関係をチェック
        // Then: Mammalクラスを継承している
        $this->assertInstanceOf(Mammal::class, $person);
    }

    public function testPersonCanOwnAFarm(): void
    {
        // Given: 人物と農場
        $person = new Person(...array_values($this->defaultPersonArgs));
        $farm = new Farm('Green Valley Farm');

        // When: 農場を設定
        $person->setFarm($farm);

        // Then: 農場を所有している
        $this->assertInstanceOf(Farm::class, $person->getFarm());
        $this->assertEquals('Green Valley Farm', $person->getFarm()->getName());
    }

    public function testPersonCanBuyAnimal(): void
    {
        // Given: 十分なお金を持った人物と農場
        $args = $this->defaultPersonArgs;
        $args['money'] = 5000.0;
        $person = new Person(...array_values($args));
        $farm = new Farm('Test Farm');
        $person->setFarm($farm);

        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);

        // When: 動物を購入
        $result = $person->buyAnimal($cow, 2000.0);

        // Then: 購入が成功し、お金が減る
        $this->assertTrue($result);
        $this->assertEquals(3000.0, $person->getMoney());
    }

    public function testPersonCannotBuyAnimalWithInsufficientMoney(): void
    {
        // Given: 十分でないお金を持った人物
        $args = $this->defaultPersonArgs;
        $args['money'] = 500.0;
        $person = new Person(...array_values($args));
        $farm = new Farm('Test Farm');
        $person->setFarm($farm);

        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);

        // When: 高価な動物の購入を試みる
        $result = $person->buyAnimal($cow, 2000.0);

        // Then: 購入が失敗し、お金は変わらない
        $this->assertFalse($result);
        $this->assertEquals(500.0, $person->getMoney());
    }

    public function testPersonCanSellAnimal(): void
    {
        // Given: 農場に動物がいる人物
        $person = new Person(...array_values($this->defaultPersonArgs));
        $farm = new Farm('Test Farm');
        $person->setFarm($farm);

        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $farm->addAnimal($cow);

        // When: 動物を売却
        $result = $person->sellAnimal($cow, 1500.0);

        // Then: 売却が成功し、お金が増える
        $this->assertTrue($result);
        $this->assertEquals(2500.0, $person->getMoney());
    }

    public function testPersonCanFeedAnimal(): void
    {
        // Given: 空腹な動物がいる農場を持つ人物
        $person = new Person(...array_values($this->defaultPersonArgs));
        $farm = new Farm('Test Farm');
        $person->setFarm($farm);

        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $cow->setAsHungry();
        $farm->addAnimal($cow);

        // When: 動物に餌をやる
        $person->feedAnimal($cow);

        // Then: 動物が満腹になる
        $this->assertFalse($cow->isHungry());
    }

    public function testPersonCanCollectRevenue(): void
    {
        // Given: 収益を持つ農場を持つ人物
        $person = new Person(...array_values($this->defaultPersonArgs));
        $farm = new Farm('Test Farm');
        $farm->setRevenue(500.0);
        $person->setFarm($farm);

        // When: 収益を回収
        $person->collectRevenue();

        // Then: 収益がお金に追加され、農場の収益がリセットされる
        $this->assertEquals(1500.0, $person->getMoney());
        $this->assertEquals(0.0, $farm->getRevenue());
    }

    public function testPersonCannotPerformActionsWithoutFarm(): void
    {
        // Given: 農場を持たない人物
        $person = new Person(...array_values($this->defaultPersonArgs));
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);

        // When: 農場が必要なアクションを試みる
        $buyResult = $person->buyAnimal($cow, 1000.0);
        $sellResult = $person->sellAnimal($cow, 1000.0);

        // Then: アクションが失敗する
        $this->assertFalse($buyResult);
        $this->assertFalse($sellResult);
    }

    public function testPersonWithDifferentMoneyAmounts(): void
    {
        // Given: 異なる所持金を持つ人物たち
        $richArgs = $this->defaultPersonArgs;
        $richArgs['name'] = 'Rich Person';
        $richArgs['money'] = 10000.0;

        $poorArgs = $this->defaultPersonArgs;
        $poorArgs['name'] = 'Poor Person';
        $poorArgs['money'] = 100.0;

        $richPerson = new Person(...array_values($richArgs));
        $poorPerson = new Person(...array_values($poorArgs));

        // When: 所持金を比較
        $richMoney = $richPerson->getMoney();
        $poorMoney = $poorPerson->getMoney();

        // Then: 正しい所持金が設定されている
        $this->assertEquals(10000.0, $richMoney);
        $this->assertEquals(100.0, $poorMoney);
        $this->assertGreaterThan($poorMoney, $richMoney);
    }

    public function testPersonToStringIncludesNameAndMoney(): void
    {
        // Given: 人物のインスタンス
        $person = new Person(...array_values($this->defaultPersonArgs));

        // When: 文字列化
        $personString = $person->__toString();

        // Then: 名前とお金の情報が含まれている
        $this->assertStringContainsString('John Doe', $personString);
        $this->assertStringContainsString('1000', $personString);
    }

    public function testPersonCanSpendAndEarnMoney(): void
    {
        // Given: 人物のインスタンス
        $person = new Person(...array_values($this->defaultPersonArgs));
        $initialMoney = $person->getMoney();

        // When: お金を使って稼ぐ
        $person->spendMoney(200.0);
        $person->earnMoney(500.0);

        // Then: お金が正しく増減する
        $expectedMoney = $initialMoney - 200.0 + 500.0;
        $this->assertEquals($expectedMoney, $person->getMoney());
    }
}
