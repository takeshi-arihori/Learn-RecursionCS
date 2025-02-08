<?php

require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Deck.php';

/**
 * ディーラーは状態を持たないステートレスオブジェクト
 * ステートレスオブジェクトはインスタンスを作成する必要がないためクラスの全てのメソッドや変数に直接アクセスできる
 */
class Dealer
{
    static function startGame(int $amountOfPlayers, string $gameMode): array
    {
        // 卓の情報
        $table = array(
            "players" => array(),
            "gameMode" => $gameMode,
            "deck" => new Deck()
        );

        // デッキをシャッフル
        $table["deck"]->shuffleDeck();

        for ($i = 0; $i < $amountOfPlayers; $i++) {
            // プレイヤーの手札
            $playerCard = array();
            // ブラックジャックの手札は2枚
            for ($j = 0; $j < self::initialCards($gameMode); $j++) {
                array_push($playerCard, $table["deck"]->draw());
            }
            array_push($table["players"], $playerCard);
        }

        return $table["players"];
    }

    static function initialCards(string $gameMode): int
    {
        if ($gameMode == "poker") return 5;
        if ($gameMode == "21") return 2;
    }
}


$table1 = Dealer::startGame(3, "21");
print_r($table1);

$table2 = Dealer::startGame(4, "poker");
print_r($table2);
