<?php

declare(strict_types=1);

require_once __DIR__ . '/Wallet.php';

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

    public function getPaid(int $amount): array
    {
        if ($this->wallet === null) return [];
        $this->wallet->insertBill($amount, 1);
        return [];
    }

    public function spendMoney(int $amount): array
    {
        return [];
    }

    public function addWallet(Wallet $wallet): Wallet
    {
        $this->wallet = $wallet;
        return $wallet;
    }

    public function dropWallet(): ?Wallet
    {
        $previousWallet = $this->wallet;
        $this->wallet = null;
        return $previousWallet;
    }
}