<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../index.php';

class WalletTest extends TestCase
{
    private Wallet $wallet;

    protected function setUp(): void
    {
        $this->wallet = new Wallet();
    }

    public function testConstructor(): void
    {
        $wallet = new Wallet();

        $this->assertEquals(0, $wallet->bill1);
        $this->assertEquals(0, $wallet->bill5);
        $this->assertEquals(0, $wallet->bill10);
        $this->assertEquals(0, $wallet->bill20);
        $this->assertEquals(0, $wallet->bill50);
        $this->assertEquals(0, $wallet->bill100);
    }

    public function testGetTotalMoneyWithEmptyWallet(): void
    {
        $this->assertEquals(0, $this->wallet->getTotalMoney());
    }

    public function testGetTotalMoneyWithVariousBills(): void
    {
        $this->wallet->bill1 = 5;    // 5 * 1 = 5
        $this->wallet->bill5 = 3;    // 3 * 5 = 15
        $this->wallet->bill10 = 2;   // 2 * 10 = 20
        $this->wallet->bill20 = 1;   // 1 * 20 = 20
        $this->wallet->bill50 = 2;   // 2 * 50 = 100
        $this->wallet->bill100 = 1;  // 1 * 100 = 100

        $expectedTotal = 5 + 15 + 20 + 20 + 100 + 100;
        $this->assertEquals($expectedTotal, $this->wallet->getTotalMoney());
    }

    public function testInsertBill1(): void
    {
        $result = $this->wallet->insertBill(1, 5);

        $this->assertEquals(5, $this->wallet->bill1);
        $this->assertEquals(5, $result);
    }

    public function testInsertBill5(): void
    {
        $result = $this->wallet->insertBill(5, 3);

        $this->assertEquals(3, $this->wallet->bill5);
        $this->assertEquals(15, $result);
    }

    public function testInsertBill10(): void
    {
        $result = $this->wallet->insertBill(10, 2);

        $this->assertEquals(2, $this->wallet->bill10);
        $this->assertEquals(20, $result);
    }

    public function testInsertBill20(): void
    {
        $result = $this->wallet->insertBill(20, 1);

        $this->assertEquals(1, $this->wallet->bill20);
        $this->assertEquals(20, $result);
    }

    public function testInsertBill50(): void
    {
        $result = $this->wallet->insertBill(50, 2);

        $this->assertEquals(2, $this->wallet->bill50);
        $this->assertEquals(100, $result);
    }

    public function testInsertBill100(): void
    {
        $result = $this->wallet->insertBill(100, 1);

        $this->assertEquals(1, $this->wallet->bill100);
        $this->assertEquals(100, $result);
    }

    public function testInsertMultipleBills(): void
    {
        $this->wallet->insertBill(100, 1);  // 100
        $this->wallet->insertBill(50, 2);   // 100
        $this->wallet->insertBill(20, 1);   // 20

        $this->assertEquals(1, $this->wallet->bill100);
        $this->assertEquals(2, $this->wallet->bill50);
        $this->assertEquals(1, $this->wallet->bill20);
        $this->assertEquals(220, $this->wallet->getTotalMoney());
    }

    public function testInsertInvalidBill(): void
    {
        $initialTotal = $this->wallet->getTotalMoney();
        $result = $this->wallet->insertBill(7, 5); // Invalid bill denomination

        $this->assertEquals($initialTotal, $result);
        $this->assertEquals($initialTotal, $this->wallet->getTotalMoney());
    }

    public function testInsertZeroAmount(): void
    {
        $initialTotal = $this->wallet->getTotalMoney();
        $result = $this->wallet->insertBill(100, 0);

        $this->assertEquals($initialTotal, $result);
        $this->assertEquals(0, $this->wallet->bill100);
    }
}
