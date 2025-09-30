<?php

declare(strict_types=1);

namespace App\Models\Animal;

/**
 * Egg class representing an egg
 *
 * Contains properties and behaviors related to eggs
 */
class Egg
{
    private string $size;
    private string $color;
    private float $weight;
    private bool $fresh;
    private bool $cracked;

    /**
     * Constructor for Egg
     */
    public function __construct(string $size, string $color, float $weight)
    {
        $this->size = $size;
        $this->color = $color;
        $this->weight = $weight;
        $this->fresh = true;
        $this->cracked = false;
    }

    /**
     * Get the size of the egg
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Get the color of the egg
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Get the weight of the egg
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * Check if the egg is fresh
     */
    public function isFresh(): bool
    {
        return $this->fresh;
    }

    /**
     * Check if the egg is cracked
     */
    public function isCracked(): bool
    {
        return $this->cracked;
    }

    /**
     * Crack the egg
     */
    public function crack(): void
    {
        $this->cracked = true;
        $this->fresh = false;
    }

    /**
     * Age the egg (make it less fresh)
     */
    public function age(): void
    {
        $this->fresh = false;
    }

    /**
     * String representation of the egg
     */
    public function __toString(): string
    {
        $freshStr = $this->fresh ? 'true' : 'false';
        $crackedStr = $this->cracked ? 'true' : 'false';

        return "Egg - Size:{$this->size}/Color:{$this->color}/Weight:{$this->weight}g/Fresh:{$freshStr}/Cracked:{$crackedStr}";
    }
}
