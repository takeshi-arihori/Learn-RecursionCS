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