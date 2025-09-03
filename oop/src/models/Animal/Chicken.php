<?php

declare(strict_types=1);

namespace App\Models\Animal;

/**
 * Chicken class representing a chicken
 *
 * Extends Bird with chicken-specific behaviors like clucking and pecking
 */
class Chicken extends Bird
{
    /**
     * Constructor for Chicken
     */
    public function __construct(
        string $species,
        float $height,
        float $weight,
        float $lifeSpan,
        string $biologicalSex,
        float $age,
        float $wingSpan,
    ) {
        parent::__construct($species, $height, $weight, $lifeSpan, $biologicalSex, $age, $wingSpan);
    }

    /**
     * Cluck (chicken sound)
     */
    public function cluck(): void
    {
        echo "Clucking...\n";
    }

    /**
     * Peck (chicken behavior)
     */
    public function peck(): void
    {
        echo "Pecking...\n";
    }

    /**
     * Check if chicken can lay eggs
     */
    public function canLayEgg(): bool
    {
        return $this->isAlive() && $this->biologicalSex === 'female' && !$this->isHungry();
    }

    /**
     * Get egg value for revenue calculation
     */
    public function getEggValue(): float
    {
        return $this->canLayEgg() ? 5.0 : 0.0;
    }

    /**
     * String representation of the chicken
     */
    public function __toString(): string
    {
        return parent::__toString() . ' - Chicken';
    }
}
