<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../blackjack/Card.php';
require_once __DIR__ . '/../blackjack/Deck.php';
require_once __DIR__ . '/../blackjack/Dealer.php';
require_once __DIR__ . '/../blackjack/HelperFunctions.php';

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

    // Dealerクラスのscore21Individualメソッドをテスト
    public function testScore21Individual()
    {
        $dealer = new Dealer();

        // PlayerAの手札
        $card1 = new Card("♦︎", "A", 1);
        $card2 = new Card("♦︎", "J", 11);
        $this->assertEquals(12, $dealer->score21Individual([$card1, $card2]));

        // PlayerBの手札
        $card1 = new Card("♦︎", "9", 9);
        $card2 = new Card("♦︎", "K", 13);
        $this->assertEquals(0, $dealer->score21Individual([$card1, $card2]));

        // PlayerCの手札
        $card1 = new Card("♦︎", "A", 1);
        $card2 = new Card("♦︎", "A", 1);
        $this->assertEquals(2, $dealer->score21Individual([$card1, $card2]));
    }

    // 一番高いスコアを判断。maxInArrayIndexメソッドをテスト
    public function testMaxScoreInArrayIndex()
    {
        $helper = new HelperFunctions();
        $this->assertEquals(2, $helper->maxInArrayIndex([1, 2, 3, 2, 1]));
        $this->assertEquals(0, $helper->maxInArrayIndex([1, 1, 1, 1, 1]));
        $this->assertEquals(4, $helper->maxInArrayIndex([1, 1, 1, 1, 2]));
    }
}

// 実行方法
// phpunit --testdox intermediate/tests/BlackjackCardTest.php