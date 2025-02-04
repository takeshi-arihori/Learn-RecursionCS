<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../blackjack/Card.php';
require_once __DIR__ . '/../blackjack/Deck.php';

class BlackJackCardTest extends TestCase
{
    public function testGetCardString()
    {
        $card = new Card('♠', 'A', 1);
        $this->assertEquals('♠A(1)', $card->getCardString());
        $card = new Card('♦', 'K', 10);
        $this->assertEquals('♦K(10)', $card->getCardString());
        $card = new Card('♣', 'Q', 10);
        $this->assertEquals('♣Q(10)', $card->getCardString());
        $card = new Card('♥', 'J', 10);
        $this->assertEquals('♥J(10)', $card->getCardString());
    }

    public function testGenerateDeck()
    {
        $deck = new Deck();
        $this->assertCount(52, $deck->deck);
        $this->assertEquals('♠A(1)', $deck->deck[0]->getCardString());
        $this->assertEquals('♠K(13)', $deck->deck[12]->getCardString());
        $this->assertEquals('♦A(1)', $deck->deck[13]->getCardString());
        $this->assertEquals('♦K(13)', $deck->deck[25]->getCardString());
        $this->assertEquals('♣A(1)', $deck->deck[26]->getCardString());
        $this->assertEquals('♣K(13)', $deck->deck[38]->getCardString());
        $this->assertEquals('♥A(1)', $deck->deck[39]->getCardString());
        $this->assertEquals('♥K(13)', $deck->deck[51]->getCardString());
    }
}

// 実行方法
// php phpunit --testdox intermediate/tests/BlackjackCardTest.php