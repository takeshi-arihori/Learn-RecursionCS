<?php

require_once __DIR__ . '/Card.php';

// トランプのカードを生成するためのデッキを表すクラス
class Deck
{
    public $deck; // 52 枚のカードが格納される配列
    public function __construct()
    {
        $this->deck = Deck::generateDeck();
    }

    // デッキを生み出すメソッドを作成 (staticメソッドを使用)
    // 前記号・全ての値を用意し、forb運で一つずつカードを生成
    public static function generateDeck(): array
    {
        $newDeck = [];
        $suits = ['♠', '♦', '♣', '♥'];
        $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

        for ($i = 0; $i < count($suits); $i++) {
            for ($j = 0; $j < count($values); $j++) {
                $newDeck[] = new Card($suits[$i], $values[$j], $j + 1);
            }
        }
        return $newDeck;
    }

    public function printDeck(): void
    {
        echo "Displaying cards..." . PHP_EOL;
        foreach ($this->deck as $card) {
            echo $card->getCardString() . PHP_EOL;
        }
    }
}

$deck1 = new Deck();
$deck1->printDeck();
