<?php

declare(strict_types=1);

namespace App\Models\Audible;

require_once __DIR__ . '/AudibleInterface.php';

class Person implements AudibleInterface
{
    private string $firstName;
    private string $lastName;
    private int $heightM;
    private int $weightKg;
    private int $age;

    public function __construct(string $firstName, string $lastName, int $heightM, int $weightKg, int $age)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->heightM = $heightM;
        $this->weightKg = $weightKg;
        $this->age = $age;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function __toString(): string
    {
        return $this->getFullName() . ' who is ' . $this->heightM . 'm tall and weights ' . $this->weightKg . 'kg.';
    }

    // Personが音を出すメソッドを定義します。
    // このメソッドはAudibleインターフェースによって要求されています。
    public function makeNoise(): void
    {
        echo 'Hello World!' . PHP_EOL;
    }

    // Personの音の周波数を返すメソッドを定義します。
    // このメソッドはAudibleインターフェースによって要求されています。
    public function soundFrequency(): float
    {
        return $this->age > 16 ? 110.0 : 130.0;
    }

    // Personの音のレベルを返すメソッドを定義します。
    // このメソッドはAudibleインターフェースによって要求されています。
    public function soundLevel(): float
    {
        return $this->age > 16 ? 60.0 : 65.0;
    }
}
