<?php

declare(strict_types=1);

use App\Models\Person;
use App\Models\Wallet;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    private Person $person;

    protected function setUp(): void
    {
        $this->person = new Person('John', 'Doe', 25, 1.75, 70.5);
    }

    /**
     * コンストラクタが正しくPersonオブジェクトを初期化することをテスト
     * - 各プロパティ（firstName, lastName, age, heightM, weightKg）が正しく設定される
     * - walletプロパティが初期状態でnullであることを確認
     */
    public function testConstructor(): void
    {
        $person = new Person('Alice', 'Smith', 30, 1.68, 60.0);

        $this->assertEquals('Alice', $person->firstName);
        $this->assertEquals('Smith', $person->lastName);
        $this->assertEquals(30, $person->age);
        $this->assertEquals(1.68, $person->heightM);
        $this->assertEquals(60.0, $person->weightKg);
        $this->assertNull($person->wallet);
    }

    /**
     * 財布を持っていない場合のgetCash()メソッドの動作をテスト
     * - 財布がない場合は0を返すことを確認
     */
    public function testGetCashWithNoWallet(): void
    {
        $this->assertEquals(0, $this->person->getCash());
    }

    /**
     * 空の財布を持っている場合のgetCash()メソッドの動作をテスト
     * - 財布はあるが中身が空の場合は0を返すことを確認
     */
    public function testGetCashWithEmptyWallet(): void
    {
        $this->person->wallet = new Wallet();
        $this->assertEquals(0, $this->person->getCash());
    }

    /**
     * お金が入った財布を持っている場合のgetCash()メソッドの動作をテスト
     * - 財布の中身（100円札2枚、50円札1枚）の合計金額250円が返されることを確認
     */
    public function testGetCashWithMoneyInWallet(): void
    {
        $wallet = new Wallet();
        $wallet->insertBill(100, 2);  // 200
        $wallet->insertBill(50, 1);   // 50

        $this->person->wallet = $wallet;
        $this->assertEquals(250, $this->person->getCash());
    }

    /**
     * 財布を持っていない場合のprintState()メソッドの動作をテスト
     * - 人物の基本情報と所持金0円が正しく出力されることを確認
     */
    public function testPrintState(): void
    {
        $this->expectOutputString('John Doe 25 1.75 70.5 0');
        $this->person->printState();
    }

    /**
     * 財布を持っている場合のprintState()メソッドの動作をテスト
     * - 人物の基本情報と財布の中身（100円）が正しく出力されることを確認
     */
    public function testPrintStateWithWallet(): void
    {
        $wallet = new Wallet();
        $wallet->insertBill(100, 1);
        $this->person->wallet = $wallet;

        $this->expectOutputString('John Doe 25 1.75 70.5 100');
        $this->person->printState();
    }

    // TDD用の失敗テスト - これらは実装前に失敗することを期待

    /**
     * getPaid()メソッドの実装前テスト（TDD用）
     * - 給料を受け取って財布に正しい紙幣の組み合わせで入れることをテスト
     * - 186円 = 100円×1 + 50円×1 + 20円×1 + 10円×1 + 5円×1 + 1円×1
     */
    public function testGetPaid(): void
    {

        $wallet = new Wallet();
        $this->person->wallet = $wallet;

        $result = $this->person->getPaid(186);

        // 186 = 1x100 + 1x50 + 1x20 + 1x10 + 1x5 + 1x1
        $expected = [1, 1, 1, 1, 1, 1]; // [bill1, bill5, bill10, bill20, bill50, bill100]
        $this->assertEquals($expected, $result);
        $this->assertEquals(186, $this->person->getCash());
    }

    /**
     * 財布を持っていない状態でgetPaid()を呼んだ場合のテスト（TDD用）
     * - 財布がない場合は空の配列を返し、所持金は0円のままであることを確認
     */
    public function testGetPaidWithoutWallet(): void
    {

        $result = $this->person->getPaid(100);
        $this->assertEquals([], $result);
        $this->assertEquals(0, $this->person->getCash());
    }

    /**
     * spendMoney()メソッドの実装前テスト（TDD用）
     * - 指定した金額を支払い、適切な紙幣の組み合わせで返すことをテスト
     * - 150円支払い = 100円×1 + 50円×1
     * - 支払い後は残高100円になることを確認
     */
    public function testSpendMoney(): void
    {

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

    /**
     * 残高不足でspendMoney()を呼んだ場合のテスト（TDD用）
     * - 50円しか持っていない状態で100円支払いを試行
     * - 支払いできない場合は空の配列を返し、所持金は変わらないことを確認
     */
    public function testSpendMoneyInsufficientFunds(): void
    {

        $wallet = new Wallet();
        $wallet->insertBill(50, 1); // Only 50
        $this->person->wallet = $wallet;

        $result = $this->person->spendMoney(100);
        $this->assertEquals([], $result);
        $this->assertEquals(50, $this->person->getCash()); // No change
    }

    /**
     * 財布を持っていない状態でspendMoney()を呼んだ場合のテスト（TDD用）
     * - 財布がない場合は空の配列を返し、所持金は0円のままであることを確認
     */
    public function testSpendMoneyWithoutWallet(): void
    {

        $result = $this->person->spendMoney(100);
        $this->assertEquals([], $result);
        $this->assertEquals(0, $this->person->getCash());
    }

    /**
     * addWallet()メソッドの動作をテスト
     * - 財布を追加して、その財布が正しく設定されることを確認
     * - 返り値として追加した財布が返されることを確認
     * - 所持金が正しく計算されることを確認
     */
    public function testAddWallet(): void
    {
        $wallet = new Wallet();
        $wallet->insertBill(100, 1);

        $returnedWallet = $this->person->addWallet($wallet);

        $this->assertSame($wallet, $returnedWallet);
        $this->assertSame($wallet, $this->person->wallet);
        $this->assertEquals(100, $this->person->getCash());
    }

    /**
     * dropWallet()メソッドの実装前テスト（TDD用）
     * - 財布を落として、その財布が返されることを確認
     * - 財布がnullに設定されることを確認
     * - 所持金が0円になることを確認
     */
    public function testDropWallet(): void
    {

        $wallet = new Wallet();
        $wallet->insertBill(100, 1);
        $this->person->wallet = $wallet;

        $droppedWallet = $this->person->dropWallet();

        $this->assertSame($wallet, $droppedWallet);
        $this->assertNull($this->person->wallet);
        $this->assertEquals(0, $this->person->getCash());
    }

    /**
     * 財布を持っていない状態でdropWallet()を呼んだ場合のテスト（TDD用）
     * - 財布がない場合はnullを返すことを確認
     * - 財布プロパティはnullのままであることを確認
     */
    public function testDropWalletWhenNoWallet(): void
    {

        $result = $this->person->dropWallet();
        $this->assertNull($result);
        $this->assertNull($this->person->wallet);
    }
}
