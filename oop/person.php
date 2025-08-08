<?php

declare(strict_types=1);

class Wallet
{
    public int $bill1;
    public int $bill5;
    public int $bill10;
    public int $bill20;
    public int $bill50;
    public int $bill100;

    public function __construct()
    {
        $this->bill1 = 0;
        $this->bill5 = 0;
        $this->bill10 = 0;
        $this->bill20 = 0;
        $this->bill50 = 0;
        $this->bill100 = 0;
    }

    public function getTotalMoney(): int
    {
        return $this->bill1 * 1 + $this->bill5 * 5 + $this->bill10 * 10 + $this->bill20 * 20 + $this->bill50 * 50 + $this->bill100 * 100;
    }

    public function insertBill(int $bill, int $amount): int
    {
        switch ($bill) {
            case 1:
                $this->bill1 += $amount;
                break;
            case 5:
                $this->bill5 += $amount;
                break;
            case 10:
                $this->bill10 += $amount;
                break;
            case 20:
                $this->bill20 += $amount;
                break;
            case 50:
                $this->bill50 += $amount;
                break;
            case 100:
                $this->bill100 += $amount;
                break;
            default:
                break;
        }

        return $this->getTotalMoney();
    }
}


class Person
{
    public string $firstName;
    public string $lastName;
    public int $age;
    public float $heightM;
    public float $weightKg;
    public ?Wallet $wallet;

    public function __construct(string $firstName, string $lastName, int $age, float $heightM, float $weightKg)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->heightM = $heightM;
        $this->weightKg = $weightKg;
        $this->wallet = null;
    }

    public function getCash(): int
    {
        if ($this->wallet === null) return 0;
        return $this->wallet->getTotalMoney();
    }

    public function printState(): void
    {
        echo "{$this->firstName} {$this->lastName} {$this->age} {$this->heightM} {$this->weightKg} {$this->getCash()}";
    }

    // getPaid(): 整数値を受け取り、通貨タイプに応じて財布に格納する紙幣を設定し、それを財布に追加します。そして、追加された各紙幣を表す整数配列を返します。
    // 各インデックスは紙幣を表し、インデックス 0 は 1 ドル札、インデックス 1 は 5 ドル札、... インデックス 5 は 100 ドル札の紙幣を表します。
    // 財布が存在しない場合は何もしません。
    public function getPaid(int $amount): array
    {
        // ここをTDDで実装
    }

    // spendMoney(): 整数値を受け取り、通貨タイプに応じて財布から取り出す紙幣を設定し、それらを財布から削除します。その後、取り出された紙幣を表す整数配列を返します。財布がない場合や財布に十分なお金がない場合は何もしません。
    public function spendMoney(int $amount): array
    {
        // ここをTDDで実装
    }


    // addWallet(): 新しい Wallet オブジェクトを受け取り、それをインスタンス変数として設定します。
    public function addWallet(Wallet $wallet): Wallet
    {
        $this->wallet = $wallet;
        return $wallet;
    }
    // dropWallet(): 現在の財布の状態を null に変更し、それまで存在していた財布を返します。
    public function dropWallet(): ?Wallet
    {
        // ここをTDDで実装
    }
}


$person = new Person("John", "Doe", 20, 1.8, 70);
$person->printState();

$person->wallet = new Wallet();
$person->wallet->insertBill(100, 10);
