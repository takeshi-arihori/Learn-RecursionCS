<?php

declare(strict_types=1);

namespace App\Models\Animal;

/**
 * Cow class representing a cow animal
 *
 * Extends Mammal with cow-specific behaviors like milk production and grazing
 */
class Cow extends Mammal
{
    /**
     * Constructor for Cow
     */
    public function __construct(
        string $species,
        float $height,
        float $weight,
        float $lifeSpan,
        string $biologicalSex,
        float $age,
        float $furLengthCm,
        string $furType,
        float $bodyTemperature,
    ) {
        parent::__construct($species, $height, $weight, $lifeSpan, $biologicalSex, $age, $furLengthCm, $furType, $bodyTemperature);
    }

    /**
     * Produce milk
     */
    public function produceMilk(): void
    {
        echo "Producing milk...\n";
    }

    /**
     * Graze on grass
     */
    public function graze(): void
    {
        echo "Grazing...\n";
    }

    /**
     * Check if cow can produce milk
     */
    public function canProduceMilk(): bool
    {
        return $this->isAlive() && $this->biologicalSex === 'female' && !$this->isHungry();
    }

    /**
     * Get milk value for revenue calculation
     */
    public function getMilkValue(): float
    {
        return $this->canProduceMilk() ? 10.0 : 0.0;
    }

    /**
     * String representation of the cow
     */
    public function __toString(): string
    {
        return parent::__toString() . ' - Cow';
    }
}
