<?php

use PHPUnit\Framework\TestCase;
use App\Models\Card;
use App\Models\Deck;

class DeckTest extends TestCase
{
    public function testDeckConstruction()
    {
        $deck = new Deck();
        $cards = $deck->getCards();
        
        $this->assertCount(52, $cards);
        $this->assertInstanceOf(Card::class, $cards[0]);
    }

    public function testCreateDeck()
    {
        $cards = Deck::createDeck();
        
        $this->assertCount(52, $cards);
        
        $firstCard = $cards[0];
        $this->assertEquals("A", $firstCard->getRank());
        $this->assertEquals("♠", $firstCard->getSuit());
        
        $lastCard = $cards[51];
        $this->assertEquals("K", $lastCard->getRank());
        $this->assertEquals("♣", $lastCard->getSuit());
    }

    public function testDeckContainsAllCards()
    {
        $deck = new Deck();
        $cards = $deck->getCards();
        
        $suits = ["♠", "♡", "♢", "♣"];
        $ranks = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
        
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

    public function testShuffleDeck()
    {
        $deck = new Deck();
        $originalCards = [];
        foreach ($deck->getCards() as $card) {
            $originalCards[] = $card->toString();
        }
        
        $deck->shuffleDeck();
        $shuffledCards = [];
        foreach ($deck->getCards() as $card) {
            $shuffledCards[] = $card->toString();
        }
        
        $this->assertCount(52, $shuffledCards);
        $this->assertNotEquals($originalCards, $shuffledCards);
        
        sort($originalCards);
        sort($shuffledCards);
        $this->assertEquals($originalCards, $shuffledCards);
    }

    public function testToString()
    {
        $deck = new Deck();
        $deckString = $deck->toString();
        
        $this->assertIsString($deckString);
        $this->assertStringContainsString("A♠", $deckString);
        $this->assertStringContainsString("K♣", $deckString);
        $this->assertStringContainsString(" ", $deckString);
    }

    public function testCardsToString()
    {
        $cards = [
            new Card("A", "♠"),
            new Card("2", "♠"),
            new Card("3", "♠"),
            new Card("4", "♠"),
            new Card("5", "♠"),
            new Card("6", "♠")
        ];
        
        $result = Deck::cardsToString($cards);
        $expected = "A♠2♠3♠4♠5♠ 6♠";
        
        $this->assertEquals($expected, $result);
    }

    public function testConstants()
    {
        $expectedSuits = ["♠", "♡", "♢", "♣"];
        $expectedRanks = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
        
        $this->assertEquals($expectedSuits, Deck::SUITS);
        $this->assertEquals($expectedRanks, Deck::RANKS);
    }
}