<?php

namespace App\Models;

class Deck
{
    public const SUITS = ['♠', '♡', '♢', '♣'];
    public const RANKS = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    private array $cards;

    public function __construct()
    {
        $this->cards = self::createDeck();
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public static function createDeck(): array
    {
        $cards = [];
        $s = count(self::SUITS);
        $r = count(self::RANKS);

        for ($i = 0; $i < $s; $i++) {
            for ($j = 0; $j < $r; $j++) {
                $cards[] = new Card(self::RANKS[$j], self::SUITS[$i]);
            }
        }

        return $cards;
    }

    public function shuffleDeck(): void
    {
        $deckSize = count($this->cards);

        for ($i = $deckSize - 1; $i >= 0; $i--) {
            $j = mt_rand(0, $i);

            $temp = $this->cards[$i];
            $this->cards[$i] = $this->cards[$j];
            $this->cards[$j] = $temp;
        }
    }

    public function toString(): string
    {
        return self::cardsToString($this->cards);
    }

    public static function cardsToString(array $inputCards): string
    {
        $s = '';

        for ($i = 0; $i < count($inputCards); $i++) {
            $s .= $inputCards[$i]->toString();
            if ($i % 5 == 4) {
                $s .= ' ';
            }
        }

        return $s;
    }
}
