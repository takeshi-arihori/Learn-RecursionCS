<?php

declare(strict_types=1);

use App\Models\Animal\Mammal;
use PHPUnit\Framework\TestCase;

class MammalTest extends TestCase
{
    // 哺乳類オブジェクトが正しく生成されるかテスト
    public function testMammalCreation(): void
    {
        $mammal = new Mammal('Lion', 1.2, 190, 5475, 'male', 5.0, 10.0, 'thick', 38.5);
        $this->assertInstanceOf(Mammal::class, $mammal);
        $this->assertFalse($mammal->isPregnant());
    }

    // メスの哺乳類オブジェクトが正しく生成されるかテスト
    public function testFemaleMammalCreation(): void
    {
        $mammal = new Mammal('Lioness', 1.1, 130, 5840, 'female', 4.0, 10.0, 'thick', 38.5);
        $this->assertInstanceOf(Mammal::class, $mammal);
        $this->assertFalse($mammal->isPregnant());
    }

    // 汗をかく機能のテスト
    public function testSweat(): void
    {
        $mammal = new Mammal('Human', 1.7, 70, 29200, 'male', 25.0, 1.0, 'thin', 37.0);
        $this->expectOutputString("Sweating....Body temperature is now 36.7C\n");
        $mammal->sweat();
    }

    // 妊娠していないときに母乳を生成しないことをテスト
    public function testProduceMilkWhenNotPregnant(): void
    {
        $female = new Mammal('Cow', 1.5, 750, 7300, 'female', 3.0, 5.0, 'short', 38.6);
        $this->expectOutputString("Cannot produce milk\n");
        $female->produceMilk();
    }

    // 妊娠しているときに母乳を生成することをテスト
    public function testProduceMilkWhenPregnant(): void
    {
        $female = new Mammal('Cow', 1.5, 750, 7300, 'female', 3.0, 5.0, 'short', 38.6);
        $female->fertilize(); // 妊娠させる
        $this->expectOutputString("Producing milk...\n");
        $female->produceMilk();
    }

    // 交尾と受精機能のテスト
    public function testMateAndFertilize(): void
    {
        $male = new Mammal('Lion', 1.2, 190, 5475, 'male', 5.0, 10.0, 'thick', 38.5);
        $female = new Mammal('Lion', 1.1, 130, 5840, 'female', 4.0, 10.0, 'thick', 38.5);

        $this->assertFalse($female->isPregnant());
        $male->mate($female);
        $this->assertTrue($female->isPregnant());
    }

    // 歯を交換する前の噛む機能のテスト
    public function testBiteAndReplaceTeeth(): void
    {
        $mammal = new Mammal('Wolf', 0.85, 40, 4745, 'male', 3.0, 8.0, 'dense', 37.8);
        $this->expectOutputString("Wolf bites with their single lower jaws which has not replaced its teeth: false\n");
        $mammal->bite();
    }

    // 歯を交換した後の噛む機能のテスト
    public function testBiteAfterReplacingTeeth(): void
    {
        $mammal = new Mammal('Wolf', 0.85, 40, 4745, 'male', 3.0, 8.0, 'dense', 37.8);
        $mammal->replaceTeeth();
        $this->expectOutputString("Wolf bites with their single lower jaws which has replaced its teeth: true\n");
        $mammal->bite();
    }

    // 体温調節機能のテスト
    public function testBodyHeat(): void
    {
        $mammal = new Mammal('Bear', 2.5, 450, 9125, 'female', 8.0, 15.0, 'shaggy', 37.0);
        $mammal->increaseBodyHeat(1.5);
        $this->assertStringContainsString('Body Temperature:38.5', $mammal->mammalInformation());

        $mammal->decreaseBodyHeat(1.0);
        $this->assertStringContainsString('Body Temperature:37.5', $mammal->mammalInformation());

        $mammal->adjustBodyHeat();
        $this->assertStringContainsString('Body Temperature:37', $mammal->mammalInformation());
    }

    // 移動機能のテスト
    public function testMove(): void
    {
        $mammal = new Mammal('Dolphin', 2.5, 150, 18250, 'female', 12.0, 0.0, 'none', 36.5);
        $this->expectOutputString("This mammal is moving.....\n");
        $mammal->move();
    }

    // 文字列化機能のテスト
    public function testToString(): void
    {
        $mammal = new Mammal('Gorilla', 1.5, 160, 14600, 'male', 15.0, 12.0, 'coarse', 37.2);
        $string = $mammal->__toString();
        $this->assertStringContainsString('Gorilla', $string);
        $this->assertStringContainsString('This is a mammal', $string);
        $this->assertStringContainsString('fur:coarse', $string);
    }

    // 食事機能のテスト
    public function testEat(): void
    {
        $mammal = new Mammal('Tiger', 1.0, 220, 5475, 'male', 6.0, 7.0, 'striped', 38.0);
        $this->expectOutputString("Tiger bites with their single lower jaws which has not replaced its teeth: false\nthis Tiger is eating with its single lower jaw\n");
        $mammal->eat();
    }
}
