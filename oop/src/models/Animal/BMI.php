<?php

namespace App\Models\Animal;

class BMI
{
    private float $heightM;
    private float $weightKg;

    public function __construct(float $heightM, float $weightKg)
    {
        $this->heightM = $heightM;
        $this->weightKg = $weightKg;
    }

    public function getWeightKg(): float
    {
        return $this->weightKg;
    }

    public function getValue(): float
    {
        return round($this->weightKg / ($this->heightM ** 2), 2);
    }

    public function toString(): string
    {
        return $this->heightM . " meters, " . $this->weightKg . "kg, BMI:" . $this->getValue();
    }
}
