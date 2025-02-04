<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../blackjack/Card.php';

class BlackjackCardTest extends TestCase
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
}

// 実行方法
// php phpunit --testdox intermediate/tests/BlackjackCardTest.php