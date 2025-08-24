<?php

namespace App\Models;

class Card
{
    private string $rank;
    private string $suit;

    public function __construct(string $rank, string $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    public function getSuit(): string
    {
    return $this->suit;
    }

    public function toString(): string
    {
        return $this->rank . $this->suit;
    }
}
