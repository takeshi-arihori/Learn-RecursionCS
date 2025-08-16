<?php

declare(strict_types=1);

namespace App\Models;

require_once __DIR__ . '/Wallet.php';

class Person
{
    public string $firstName;
    public string $lastName;
    public int $age;
    public float $heightM;
    public float $weightKg;
    public ?Wallet $wallet;

    /**
     * Personクラスのコンストラクタ
     * 
     * @param string $firstName 名前
     * @param string $lastName 姓
     * @param int $age 年齢
     * @param float $heightM 身長（メートル）
     * @param float $weightKg 体重（キログラム）
     */
    public function __construct(string $firstName, string $lastName, int $age, float $heightM, float $weightKg)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->heightM = $heightM;
        $this->weightKg = $weightKg;
        $this->wallet = null;
    }

    /**
     * 現在の所持金を取得
     * 
     * @return int 所持金（円）
     */
    public function getCash(): int
    {
        if ($this->wallet === null) return 0;
        return $this->wallet->getTotalMoney();
    }

    /**
     * 人物の状態を出力
     * 
     * フォーマット: "firstName lastName age heightM weightKg cash"
     */
    public function printState(): void
    {
        echo "{$this->firstName} {$this->lastName} {$this->age} {$this->heightM} {$this->weightKg} {$this->getCash()}";
    }

    /**
     * 給料を受け取り、財布に紙幣を追加
     * 
     * 指定された金額を最適な紙幣の組み合わせで財布に格納し、
     * 追加された各紙幣の枚数を配列で返す
     * 
     * @param int $amount 受け取る金額
     * @return array 追加された紙幣の枚数 [bill1, bill5, bill10, bill20, bill50, bill100]
     */
    public function getPaid(int $amount): array
    {
        if ($this->wallet === null) return [];

        // Convert amount to optimal bill combination
        $bills = [0, 0, 0, 0, 0, 0]; // [bill1, bill5, bill10, bill20, bill50, bill100]
        $denominations = [100, 50, 20, 10, 5, 1];

        $remaining = $amount;
        foreach ($denominations as $i => $denom) {
            if ($remaining >= $denom) {
                $count = intval($remaining / $denom);
                $bills[5 - $i] = $count; // Reverse index to match return format
                $this->wallet->insertBill($denom, $count);
                $remaining %= $denom;
            }
        }

        return $bills;
    }

    /**
     * 指定された金額を支払う
     * 
     * 財布から適切な紙幣の組み合わせで支払いを行い、
     * 取り出された各紙幣の枚数を配列で返す
     * 
     * @param int $amount 支払う金額
     * @return array 取り出された紙幣の枚数 [bill1, bill5, bill10, bill20, bill50, bill100]
     */
    public function spendMoney(int $amount): array
    {
        if ($this->wallet === null || $this->getCash() < $amount) return [];

        // Calculate optimal bill combination to spend
        $bills = [0, 0, 0, 0, 0, 0]; // [bill1, bill5, bill10, bill20, bill50, bill100]
        $denominations = [100, 50, 20, 10, 5, 1];
        $walletBills = [
            $this->wallet->bill100,
            $this->wallet->bill50,
            $this->wallet->bill20,
            $this->wallet->bill10,
            $this->wallet->bill5,
            $this->wallet->bill1
        ];

        $remaining = $amount;

        // Try to make exact change using largest bills first
        for ($i = 0; $i < count($denominations); $i++) {
            $denom = $denominations[$i];
            if ($remaining >= $denom && $walletBills[$i] > 0) {
                $count = min(intval($remaining / $denom), $walletBills[$i]);
                if ($count > 0) {
                    $bills[5 - $i] = $count; // Reverse index to match return format
                    $this->wallet->removeBill($denom, $count);
                    $remaining -= $denom * $count;
                }
            }
        }

        // If we couldn't make exact change, restore wallet and return empty array
        if ($remaining > 0) {
            // Restore removed bills
            for ($i = 0; $i < count($denominations); $i++) {
                if ($bills[5 - $i] > 0) {
                    $this->wallet->insertBill($denominations[$i], $bills[5 - $i]);
                }
            }
            return [];
        }

        return $bills;
    }

    /**
     * 財布を追加
     * 
     * @param Wallet $wallet 追加する財布
     * @return Wallet 追加された財布
     */
    public function addWallet(Wallet $wallet): Wallet
    {
        $this->wallet = $wallet;
        return $wallet;
    }

    /**
     * 財布を落とす
     * 
     * 現在の財布をnullに設定し、それまで持っていた財布を返す
     * 
     * @return Wallet|null 落とした財布（財布がない場合はnull）
     */
    public function dropWallet(): ?Wallet
    {
        $previousWallet = $this->wallet;
        $this->wallet = null;
        return $previousWallet;
    }
}
