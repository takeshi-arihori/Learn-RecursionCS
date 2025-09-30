<?php

require_once __DIR__ . '/Card.php';

// トランプのカードを生成するためのデッキを表すクラス
class Deck
{
    public array $deck; // 52 枚のカードが格納される配列
    public function __construct(string $gameMode = null)
    {
        $this->deck = Deck::generateDeck($gameMode);
    }

    // デッキを生み出すメソッドを作成 (staticメソッドを使用)
    // 前記号・全ての値を用意し、forb運で一つずつカードを生成
    public static function generateDeck(string $gameMode = null): array
    {
        $newDeck = [];
        $suits = ['♠', '♦', '♣', '♥'];
        $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
        $blackJack = ["A" => 1, "J" => 10, "Q" => 10, "K" => 10];

        for ($i = 0; $i < count($suits); $i++) {
            for ($j = 0; $j < count($values); $j++) {
                $currentValue = $values[$j];
                $intValue = ($gameMode == "21") ? (isset($blackJack[$currentValue]) ? $blackJack[$currentValue] : (int)$currentValue) : $j + 1;
                array_push($newDeck, new Card($suits[$i], $values[$j], $intValue));
            }
        }
        return $newDeck;
    }

    // カードをドロー
    public function draw(): Card
    {
        return array_pop($this->deck);
    }

    public function printDeck(): void
    {
        echo "Displaying cards..." . PHP_EOL;
        foreach ($this->deck as $card) {
            echo $card->getCardString() . PHP_EOL;
        }
    }

    // in-placeアルゴリズムでデッキをシャッフルするメソッド
    public function shuffleDeck(): void
    {
        $deckSize = count($this->deck);
        for ($i = $deckSize - 1; $i >= 0; $i--) {
            $j = mt_rand(0, $i);
            $temp = $this->deck[$i];
            $this->deck[$i] = $this->deck[$j];
            $this->deck[$j] = $temp;
        }
    }
}

$deck1 = new Deck();

// デッキをシャッフル
$deck1->shuffleDeck();

// デッキを確認
// echo $deck1->deck[count($deck1->deck) - 1]->getCardString() . PHP_EOL;
// echo $deck1->draw()->getCardString() . PHP_EOL;
// echo $deck1->deck[count($deck1->deck) - 1]->getCardString() . PHP_EOL;
// echo $deck1->draw()->getCardString() . PHP_EOL;
// echo $deck1->deck[count($deck1->deck) - 1]->getCardString() . PHP_EOL;
