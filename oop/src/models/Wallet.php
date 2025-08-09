<?php

declare(strict_types=1);

/**
 * 財布クラス
 * 
 * 様々な額面の紙幣を管理し、総金額の計算や紙幣の挿入操作を提供する
 */
class Wallet
{
    public int $bill1;   // 1円札の枚数
    public int $bill5;   // 5円札の枚数
    public int $bill10;  // 10円札の枚数
    public int $bill20;  // 20円札の枚数
    public int $bill50;  // 50円札の枚数
    public int $bill100; // 100円札の枚数

    /**
     * Walletクラスのコンストラクタ
     * 
     * すべての紙幣の枚数を0に初期化する
     */
    public function __construct()
    {
        $this->bill1 = 0;
        $this->bill5 = 0;
        $this->bill10 = 0;
        $this->bill20 = 0;
        $this->bill50 = 0;
        $this->bill100 = 0;
    }

    /**
     * 財布内の総金額を計算
     * 
     * @return int 総金額（円）
     */
    public function getTotalMoney(): int
    {
        return $this->bill1 * 1 + $this->bill5 * 5 + $this->bill10 * 10 + $this->bill20 * 20 + $this->bill50 * 50 + $this->bill100 * 100;
    }

    /**
     * 指定された額面の紙幣を財布に挿入
     * 
     * @param int $bill 紙幣の額面 (1, 5, 10, 20, 50, 100)
     * @param int $amount 挿入する枚数
     * @return int 挿入後の総金額
     */
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

    /**
     * 指定された額面の紙幣を財布から取り出し
     * 
     * @param int $bill 紙幣の額面 (1, 5, 10, 20, 50, 100)
     * @param int $amount 取り出す枚数
     * @return int 取り出し後の総金額
     */
    public function removeBill(int $bill, int $amount): int
    {
        switch ($bill) {
            case 1:
                $this->bill1 = max(0, $this->bill1 - $amount);
                break;
            case 5:
                $this->bill5 = max(0, $this->bill5 - $amount);
                break;
            case 10:
                $this->bill10 = max(0, $this->bill10 - $amount);
                break;
            case 20:
                $this->bill20 = max(0, $this->bill20 - $amount);
                break;
            case 50:
                $this->bill50 = max(0, $this->bill50 - $amount);
                break;
            case 100:
                $this->bill100 = max(0, $this->bill100 - $amount);
                break;
            default:
                break;
        }

        return $this->getTotalMoney();
    }
}