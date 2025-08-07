<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../index.php';

class PersonTest extends TestCase
{
    private Person $person;

    protected function setUp(): void
    {
        $this->person = new Person("John", "Doe", 25, 1.75, 70.5);
    }

    public function testConstructor(): void
    {
        $person = new Person("Alice", "Smith", 30, 1.68, 60.0);

        $this->assertEquals("Alice", $person->firstName);
        $this->assertEquals("Smith", $person->lastName);
        $this->assertEquals(30, $person->age);
        $this->assertEquals(1.68, $person->heightM);
        $this->assertEquals(60.0, $person->weightKg);
        $this->assertNull($person->wallet);
    }

    public function testGetCashWithNoWallet(): void
    {
        $this->assertEquals(0, $this->person->getCash());
    }

    public function testGetCashWithEmptyWallet(): void
    {
        $this->person->wallet = new Wallet();
        $this->assertEquals(0, $this->person->getCash());
    }

    public function testGetCashWithMoneyInWallet(): void
    {
        $wallet = new Wallet();
        $wallet->insertBill(100, 2);  // 200
        $wallet->insertBill(50, 1);   // 50

        $this->person->wallet = $wallet;
        $this->assertEquals(250, $this->person->getCash());
    }

    public function testPrintState(): void
    {
        $this->expectOutputString("John Doe 25 1.75 70.5 0");
        $this->person->printState();
    }

    public function testPrintStateWithWallet(): void
    {
        $wallet = new Wallet();
        $wallet->insertBill(100, 1);
        $this->person->wallet = $wallet;

        $this->expectOutputString("John Doe 25 1.75 70.5 100");
        $this->person->printState();
    }

    // TDD用の失敗テスト - これらは実装前に失敗することを期待

    public function testGetPaidShouldFail(): void
    {
        $this->markTestIncomplete('getPaid method is not implemented yet');

        $wallet = new Wallet();
        $this->person->wallet = $wallet;

        $result = $this->person->getPaid(186);

        // 186 = 1x100 + 1x50 + 1x20 + 1x10 + 1x5 + 1x1
        $expected = [1, 1, 1, 1, 1, 1]; // [bill1, bill5, bill10, bill20, bill50, bill100]
        $this->assertEquals($expected, $result);
        $this->assertEquals(186, $this->person->getCash());
    }

    public function testGetPaidWithoutWalletShouldFail(): void
    {
        $this->markTestIncomplete('getPaid method is not implemented yet');

        $result = $this->person->getPaid(100);
        $this->assertEquals([], $result);
        $this->assertEquals(0, $this->person->getCash());
    }

    public function testSpendMoneyShouldFail(): void
    {
        $this->markTestIncomplete('spendMoney method is not implemented yet');

        $wallet = new Wallet();
        $wallet->insertBill(100, 2);  // 200
        $wallet->insertBill(50, 1);   // 50
        $this->person->wallet = $wallet;

        $result = $this->person->spendMoney(150);

        // 150 = 1x100 + 1x50
        $expected = [0, 0, 0, 0, 1, 1]; // [bill1, bill5, bill10, bill20, bill50, bill100]
        $this->assertEquals($expected, $result);
        $this->assertEquals(100, $this->person->getCash()); // Remaining 100
    }

    public function testSpendMoneyInsufficientFundsShouldFail(): void
    {
        $this->markTestIncomplete('spendMoney method is not implemented yet');

        $wallet = new Wallet();
        $wallet->insertBill(50, 1); // Only 50
        $this->person->wallet = $wallet;

        $result = $this->person->spendMoney(100);
        $this->assertEquals([], $result);
        $this->assertEquals(50, $this->person->getCash()); // No change
    }

    public function testSpendMoneyWithoutWalletShouldFail(): void
    {
        $this->markTestIncomplete('spendMoney method is not implemented yet');

        $result = $this->person->spendMoney(100);
        $this->assertEquals([], $result);
        $this->assertEquals(0, $this->person->getCash());
    }

    public function testAddWallet(): void
    {
        $wallet = new Wallet();
        $wallet->insertBill(100, 1);

        $returnedWallet = $this->person->addWallet($wallet);

        $this->assertSame($wallet, $returnedWallet);
        $this->assertSame($wallet, $this->person->wallet);
        $this->assertEquals(100, $this->person->getCash());
    }

    public function testDropWalletShouldFail(): void
    {
        $this->markTestIncomplete('dropWallet method is not implemented yet');

        $wallet = new Wallet();
        $wallet->insertBill(100, 1);
        $this->person->wallet = $wallet;

        $droppedWallet = $this->person->dropWallet();

        $this->assertSame($wallet, $droppedWallet);
        $this->assertNull($this->person->wallet);
        $this->assertEquals(0, $this->person->getCash());
    }

    public function testDropWalletWhenNoWalletShouldFail(): void
    {
        $this->markTestIncomplete('dropWallet method is not implemented yet');

        $result = $this->person->dropWallet();
        $this->assertNull($result);
        $this->assertNull($this->person->wallet);
    }
}
