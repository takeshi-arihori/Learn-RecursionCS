<?php

use PHPUnit\Framework\TestCase;
use App\Models\Card;

class CardTest extends TestCase
{
    public function testCardConstruction()
    {
        $card = new Card("A", "♠");

        $this->assertEquals("A", $card->getRank());
        $this->assertEquals("♠", $card->getSuit());
    }

    public function testToString()
    {
        $card = new Card("K", "♡");

        $this->assertEquals("K♡", $card->toString());
    }

    public function testCardWithNumberRank()
    {
        $card = new Card("10", "♢");

        $this->assertEquals("10♢", $card->toString());
    }

    public function testAllSuits()
    {
        $suits = ["♠", "♡", "♢", "♣"];

        foreach ($suits as $suit) {
            $card = new Card("A", $suit);
            $this->assertEquals("A" . $suit, $card->toString());
        }
    }

    public function testAllRanks()
    {
        $ranks = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];

        foreach ($ranks as $rank) {
            $card = new Card($rank, "♠");
            $this->assertEquals($rank . "♠", $card->toString());
        }
    }
}
