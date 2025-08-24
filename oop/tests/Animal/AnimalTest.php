<?php

use PHPUnit\Framework\TestCase;
use App\Models\Animal\Animal;

class AnimalTest extends TestCase
{
    private Animal $animal;

    protected function setUp(): void
    {
        $this->animal = new Animal("Lion", 1.2, 190, 15 * 365, "Male");
    }

    public function testInitialState(): void
    {
        $this->assertTrue($this->animal->isAlive());
        $this->assertTrue($this->animal->isHungry());
        $this->assertTrue($this->animal->isSleepy());
    }

    public function testEat(): void
    {
        $this->animal->eat();
        $this->assertFalse($this->animal->isHungry());
    }

    public function testSetAsHungry(): void
    {
        $this->animal->eat();
        $this->assertFalse($this->animal->isHungry());
        $this->animal->setAsHungry();
        $this->assertTrue($this->animal->isHungry());
    }

    public function testSleep(): void
    {
        $this->animal->sleep();
        $this->assertFalse($this->animal->isSleepy());
    }

    public function testSetAsSleepy(): void
    {
        $this->animal->sleep();
        $this->assertFalse($this->animal->isSleepy());
        $this->animal->setAsSleepy();
        $this->assertTrue($this->animal->isSleepy());
    }

    public function testDie(): void
    {
        $this->animal->die();
        $this->assertFalse($this->animal->isAlive());
        $this->assertFalse($this->animal->isHungry());
        $this->assertFalse($this->animal->isSleepy());
    }

    public function testToString(): void
    {
        $this->assertStringContainsString("Lion", $this->animal->__toString());
        $this->assertStringContainsString("1.2 meters, 190kg, BMI:131.94", $this->animal->__toString());
        $this->assertStringContainsString("lives 5475 days", $this->animal->__toString());
        $this->assertStringContainsString("gender:Male", $this->animal->__toString());
    }

    public function testStatus(): void
    {
        $this->assertStringContainsString("Lion status:", $this->animal->status());
        $this->assertStringContainsString("Hunger - 100%", $this->animal->status());
        $this->assertStringContainsString("sleepiness:100%", $this->animal->status());
        $this->assertStringContainsString("Alive - true", $this->animal->status());
    }
}