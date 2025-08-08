<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/models/Wallet.php';

class WalletTest extends TestCase
{
    private Wallet $wallet;

    protected function setUp(): void
    {
        $this->wallet = new Wallet();
    }

    /**
     * コンストラクタが正しくWalletオブジェクトを初期化することをテスト
     * - 各紙幣の枚数（bill1, bill5, bill10, bill20, bill50, bill100）が0に初期化されることを確認
     */
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

    /**
     * 空の財布のgetTotalMoney()メソッドの動作をテスト
     * - 紙幣が一枚も入っていない場合は0円を返すことを確認
     */
    public function testGetTotalMoneyWithEmptyWallet(): void
    {
        $this->assertEquals(0, $this->wallet->getTotalMoney());
    }

    /**
     * 様々な紙幣が入った財布のgetTotalMoney()メソッドの動作をテスト
     * - 1円札5枚、5円札3枚、10円札2枚、20円札1枚、50円札2枚、100円札1枚の合計金額を計算
     * - 期待値: 5 + 15 + 20 + 20 + 100 + 100 = 260円
     */
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

    /**
     * 1円札をinsertBill()で挿入する機能をテスト
     * - 1円札5枚を挿入して、正しく枚数が設定されることを確認
     * - 返り値として挿入した金額（5円）が返されることを確認
     */
    public function testInsertBill1(): void
    {
        $result = $this->wallet->insertBill(1, 5);

        $this->assertEquals(5, $this->wallet->bill1);
        $this->assertEquals(5, $result);
    }

    /**
     * 5円札をinsertBill()で挿入する機能をテスト
     * - 5円札3枚を挿入して、正しく枚数が設定されることを確認
     * - 返り値として挿入した金額（15円）が返されることを確認
     */
    public function testInsertBill5(): void
    {
        $result = $this->wallet->insertBill(5, 3);

        $this->assertEquals(3, $this->wallet->bill5);
        $this->assertEquals(15, $result);
    }

    /**
     * 10円札をinsertBill()で挿入する機能をテスト
     * - 10円札2枚を挿入して、正しく枚数が設定されることを確認
     * - 返り値として挿入した金額（20円）が返されることを確認
     */
    public function testInsertBill10(): void
    {
        $result = $this->wallet->insertBill(10, 2);

        $this->assertEquals(2, $this->wallet->bill10);
        $this->assertEquals(20, $result);
    }

    /**
     * 20円札をinsertBill()で挿入する機能をテスト
     * - 20円札1枚を挿入して、正しく枚数が設定されることを確認
     * - 返り値として挿入した金額（20円）が返されることを確認
     */
    public function testInsertBill20(): void
    {
        $result = $this->wallet->insertBill(20, 1);

        $this->assertEquals(1, $this->wallet->bill20);
        $this->assertEquals(20, $result);
    }

    /**
     * 50円札をinsertBill()で挿入する機能をテスト
     * - 50円札2枚を挿入して、正しく枚数が設定されることを確認
     * - 返り値として挿入した金額（100円）が返されることを確認
     */
    public function testInsertBill50(): void
    {
        $result = $this->wallet->insertBill(50, 2);

        $this->assertEquals(2, $this->wallet->bill50);
        $this->assertEquals(100, $result);
    }

    /**
     * 100円札をinsertBill()で挿入する機能をテスト
     * - 100円札1枚を挿入して、正しく枚数が設定されることを確認
     * - 返り値として挿入した金額（100円）が返されることを確認
     */
    public function testInsertBill100(): void
    {
        $result = $this->wallet->insertBill(100, 1);

        $this->assertEquals(1, $this->wallet->bill100);
        $this->assertEquals(100, $result);
    }

    /**
     * 複数の紙幣を順次insertBill()で挿入する機能をテスト
     * - 100円札1枚、50円札2枚、20円札1枚を順次挿入
     * - 各紙幣の枚数が正しく設定されることを確認
     * - 合計金額が220円になることを確認
     */
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

    /**
     * 無効な紙幣額面をinsertBill()で挿入しようとした場合のエラーハンドリングをテスト
     * - 7円札（存在しない額面）を挿入しようとしても、財布の状態が変わらないことを確認
     * - 返り値として元の合計金額が返されることを確認
     */
    public function testInsertInvalidBill(): void
    {
        $initialTotal = $this->wallet->getTotalMoney();
        $result = $this->wallet->insertBill(7, 5); // Invalid bill denomination

        $this->assertEquals($initialTotal, $result);
        $this->assertEquals($initialTotal, $this->wallet->getTotalMoney());
    }

    /**
     * 0枚の紙幣をinsertBill()で挿入しようとした場合のエッジケースをテスト
     * - 100円札0枚を挿入しても、財布の状態が変わらないことを確認
     * - 返り値として元の合計金額が返されることを確認
     */
    public function testInsertZeroAmount(): void
    {
        $initialTotal = $this->wallet->getTotalMoney();
        $result = $this->wallet->insertBill(100, 0);

        $this->assertEquals($initialTotal, $result);
        $this->assertEquals(0, $this->wallet->bill100);
    }
}
