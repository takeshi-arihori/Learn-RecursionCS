<?php

namespace App\Models;

interface DeckInterface
{
    public static function createDeck(): array;

    public static function shuffleDeckInPlace(array &$cards): void;

    public static function shuffleDeckOutOfPlace(array $cards): array;

    public static function cardsToString(array $inputCards): string;
}
