<?php

declare(strict_types=1);

namespace App\Tests\Farm;

use App\Models\Animal\Chicken;
use App\Models\Animal\Cow;
use App\Models\Animal\Horse;
use App\Models\Farm\Farm;
use PHPUnit\Framework\TestCase;

class FarmTest extends TestCase
{
    private Farm $farm;

    protected function setUp(): void
    {
        $this->farm = new Farm('Green Valley Farm');
    }

    public function testFarmCanBeCreatedWithName(): void
    {
        // Given: 農場名
        $farmName = 'Sunny Hill Farm';

        // When: 農場を作成
        $farm = new Farm($farmName);

        // Then: 農場が正しく作成される
        $this->assertInstanceOf(Farm::class, $farm);
        $this->assertEquals($farmName, $farm->getName());
    }

    public function testFarmHasInitialState(): void
    {
        // Given: 新しい農場
        $farm = new Farm('Test Farm');

        // When: 初期状態を確認
        $revenue = $farm->getRevenue();
        $cows = $farm->getCows();
        $horses = $farm->getHorses();
        $chickens = $farm->getChickens();

        // Then: 初期状態が正しい
        $this->assertEquals(0.0, $revenue);
        $this->assertEquals([], $cows);
        $this->assertEquals([], $horses);
        $this->assertEquals([], $chickens);
    }

    public function testFarmCanAddCow(): void
    {
        // Given: 牛のインスタンス
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);

        // When: 農場に牛を追加
        $this->farm->addAnimal($cow);

        // Then: 牛が追加される
        $cows = $this->farm->getCows();
        $this->assertCount(1, $cows);
        $this->assertSame($cow, $cows[0]);
    }

    public function testFarmCanAddHorse(): void
    {
        // Given: 馬のインスタンス
        $horse = new Horse('Arabian', 1.6, 500.0, 9125.0, 'male', 3.0, 1.0, 'brown', 38.0);

        // When: 農場に馬を追加
        $this->farm->addAnimal($horse);

        // Then: 馬が追加される
        $horses = $this->farm->getHorses();
        $this->assertCount(1, $horses);
        $this->assertSame($horse, $horses[0]);
    }

    public function testFarmCanAddChicken(): void
    {
        // Given: 鶏のインスタンス
        $chicken = new Chicken('Leghorn', 0.6, 2.5, 2190.0, 'female', 1.0, 1.2);

        // When: 農場に鶏を追加
        $this->farm->addAnimal($chicken);

        // Then: 鶏が追加される
        $chickens = $this->farm->getChickens();
        $this->assertCount(1, $chickens);
        $this->assertSame($chicken, $chickens[0]);
    }

    public function testFarmCanRemoveCow(): void
    {
        // Given: 農場に牛がいる
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $this->farm->addAnimal($cow);

        // When: 牛を削除
        $result = $this->farm->removeAnimal($cow);

        // Then: 削除が成功し、牛がいなくなる
        $this->assertTrue($result);
        $this->assertCount(0, $this->farm->getCows());
    }

    public function testFarmCannotRemoveAnimalNotInFarm(): void
    {
        // Given: 農場にいない牛
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);

        // When: 存在しない牛を削除しようとする
        $result = $this->farm->removeAnimal($cow);

        // Then: 削除が失敗する
        $this->assertFalse($result);
    }

    public function testFarmCanSetAndGetRevenue(): void
    {
        // Given: 農場のインスタンス
        $revenue = 1500.0;

        // When: 収益を設定
        $this->farm->setRevenue($revenue);

        // Then: 収益が正しく設定される
        $this->assertEquals($revenue, $this->farm->getRevenue());
    }

    public function testFarmCanCalculateRevenue(): void
    {
        // Given: 生産可能な動物がいる農場
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $chicken = new Chicken('Leghorn', 0.6, 2.5, 2190.0, 'female', 1.0, 1.2);
        $this->farm->addAnimal($cow);
        $this->farm->addAnimal($chicken);

        // When: 収益を計算
        $revenue = $this->farm->calculateRevenue();

        // Then: 収益が計算される
        $this->assertGreaterThan(0, $revenue);
        $this->assertEquals($revenue, $this->farm->getRevenue());
    }

    public function testFarmDailyUpdateAffectsAnimals(): void
    {
        // Given: 満腹な動物がいる農場
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $cow->eat(); // 満腹状態にする
        $this->farm->addAnimal($cow);

        // When: 日次更新を実行
        $this->farm->dailyUpdate();

        // Then: 動物の状態が変化する（空腹度が増加）
        $this->assertGreaterThan(0, $cow->hungerPercent ?? 0);
    }

    public function testFarmCanHaveMultipleAnimalsOfSameType(): void
    {
        // Given: 複数の同じ種類の動物
        $cow1 = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $cow2 = new Cow('Angus', 1.4, 550.0, 7300.0, 'male', 1.5, 0.4, 'red', 37.2);

        // When: 両方の牛を農場に追加
        $this->farm->addAnimal($cow1);
        $this->farm->addAnimal($cow2);

        // Then: 両方が追加される
        $cows = $this->farm->getCows();
        $this->assertCount(2, $cows);
        $this->assertContains($cow1, $cows);
        $this->assertContains($cow2, $cows);
    }

    public function testFarmGetAllAnimalsReturnsAllAnimals(): void
    {
        // Given: 異なる種類の動物がいる農場
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $horse = new Horse('Arabian', 1.6, 500.0, 9125.0, 'male', 3.0, 1.0, 'brown', 38.0);
        $chicken = new Chicken('Leghorn', 0.6, 2.5, 2190.0, 'female', 1.0, 1.2);

        $this->farm->addAnimal($cow);
        $this->farm->addAnimal($horse);
        $this->farm->addAnimal($chicken);

        // When: 全動物を取得
        $allAnimals = $this->farm->getAllAnimals();

        // Then: 全動物が返される
        $this->assertCount(3, $allAnimals);
        $this->assertContains($cow, $allAnimals);
        $this->assertContains($horse, $allAnimals);
        $this->assertContains($chicken, $allAnimals);
    }

    public function testFarmToStringIncludesNameAndAnimalCounts(): void
    {
        // Given: 動物がいる農場
        $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', 2.0, 0.5, 'black', 37.0);
        $this->farm->addAnimal($cow);

        // When: 文字列化
        $farmString = $this->farm->__toString();

        // Then: 農場名と動物数の情報が含まれている
        $this->assertStringContainsString('Green Valley Farm', $farmString);
        $this->assertStringContainsString('1', $farmString); // 動物数
    }

    public function testFarmWithNoAnimalsHasZeroRevenue(): void
    {
        // Given: 動物のいない農場
        $emptyFarm = new Farm('Empty Farm');

        // When: 収益を計算
        $revenue = $emptyFarm->calculateRevenue();

        // Then: 収益は0
        $this->assertEquals(0.0, $revenue);
    }
}
