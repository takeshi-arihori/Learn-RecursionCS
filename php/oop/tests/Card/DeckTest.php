<?php

declare(strict_types=1);

use App\Models\Card;
use App\Models\Deck;
use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    public function testDeckConstruction(): void
    {
        $deck = new Deck();
        $cards = $deck->getCards();

        $this->assertCount(52, $cards);
        $this->assertInstanceOf(Card::class, $cards[0]);
    }

    public function testCreateDeck(): void
    {
        $cards = Deck::createDeck();

        $this->assertCount(52, $cards);

        $firstCard = $cards[0];
        $this->assertEquals('A', $firstCard->getRank());
        $this->assertEquals('♠', $firstCard->getSuit());

        $lastCard = $cards[51];
        $this->assertEquals('K', $lastCard->getRank());
        $this->assertEquals('♣', $lastCard->getSuit());
    }

    public function testDeckContainsAllCards(): void
    {
        $deck = new Deck();
        $cards = $deck->getCards();

        $suits = ['♠', '♡', '♢', '♣'];
        $ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

        $expectedCards = [];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $expectedCards[] = $rank . $suit;
            }
        }

        $actualCards = [];

        foreach ($cards as $card) {
            $actualCards[] = $card->toString();
        }

        sort($expectedCards);
        sort($actualCards);
        $this->assertEquals($expectedCards, $actualCards);
    }

    public function testToString(): void
    {
        $deck = new Deck();
        $deckString = $deck->toString();

        $this->assertIsString($deckString);
        $this->assertStringContainsString('A♠', $deckString);
        $this->assertStringContainsString('K♣', $deckString);
        $this->assertStringContainsString(' ', $deckString);
    }

    public function testCardsToString(): void
    {
        $cards = [
            new Card('A', '♠'),
            new Card('2', '♠'),
            new Card('3', '♠'),
            new Card('4', '♠'),
            new Card('5', '♠'),
            new Card('6', '♠'),
        ];

        $result = Deck::cardsToString($cards);
        $expected = 'A♠2♠3♠4♠5♠ 6♠';

        $this->assertEquals($expected, $result);
    }

    public function testConstants(): void
    {
        $expectedSuits = ['♠', '♡', '♢', '♣'];
        $expectedRanks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

        $this->assertEquals($expectedSuits, Deck::SUITS);
        $this->assertEquals($expectedRanks, Deck::RANKS);
    }

    public function testShuffleDeckInPlace(): void
    {
        $cards = Deck::createDeck();
        $originalCards = [];

        foreach ($cards as $card) {
            $originalCards[] = $card->toString();
        }

        Deck::shuffleDeckInPlace($cards);

        $this->assertCount(52, $cards);

        $shuffledCards = [];

        foreach ($cards as $card) {
            $shuffledCards[] = $card->toString();
        }

        $this->assertNotEquals($originalCards, $shuffledCards);

        sort($originalCards);
        sort($shuffledCards);
        $this->assertEquals($originalCards, $shuffledCards);
    }

    public function testShuffleDeckOutOfPlace(): void
    {
        $originalCards = Deck::createDeck();
        $originalCardsStrings = [];

        foreach ($originalCards as $card) {
            $originalCardsStrings[] = $card->toString();
        }

        $shuffledCards = Deck::shuffleDeckOutOfPlace($originalCards);

        $this->assertCount(52, $shuffledCards);
        $this->assertCount(52, $originalCards);

        $originalCardsStringsAfter = [];

        foreach ($originalCards as $card) {
            $originalCardsStringsAfter[] = $card->toString();
        }
        $this->assertEquals($originalCardsStrings, $originalCardsStringsAfter);

        $shuffledCardsStrings = [];

        foreach ($shuffledCards as $card) {
            $shuffledCardsStrings[] = $card->toString();
        }

        $this->assertNotEquals($originalCardsStrings, $shuffledCardsStrings);

        sort($originalCardsStrings);
        sort($shuffledCardsStrings);
        $this->assertEquals($originalCardsStrings, $shuffledCardsStrings);
    }
}
