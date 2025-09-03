<?php

declare(strict_types=1);

namespace App\Models\Animal;

/**
 * Horse class representing a horse animal
 *
 * Extends Mammal with horse-specific behaviors like galloping and neighing
 */
class Horse extends Mammal
{
    /**
     * Constructor for Horse
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
     * Gallop (run fast)
     */
    public function gallop(): void
    {
        echo "Galloping...\n";
    }

    /**
     * Neigh (horse sound)
     */
    public function neigh(): void
    {
        echo "Neighing...\n";
    }

    /**
     * Get training value for revenue calculation
     */
    public function getTrainingValue(): float
    {
        return $this->isAlive() && !$this->isHungry() ? 15.0 : 0.0;
    }

    /**
     * String representation of the horse
     */
    public function __toString(): string
    {
        return parent::__toString() . ' - Horse';
    }
}
