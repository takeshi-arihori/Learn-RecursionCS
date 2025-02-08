<?php

require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Deck.php';

/**
 * ディーラーは状態を持たないステートレスオブジェクト
 * ステートレスオブジェクトはインスタンスを作成する必要がないためクラスの全てのメソッドや変数に直接アクセスできる
 */
class Dealer
{
    static function startGame(int $amountOfPlayers): array
    {
        // 卓の情報
        $table = array(
            "players" => array(),
            "deck" => new Deck()
        );

        // デッキをシャッフル
        $table["deck"]->shuffleDeck();

        for ($i = 0; $i < $amountOfPlayers; $i++) {
            // プレイヤーの手札
            $playerCard = array();
            // ブラックジャックの手札は2枚
            for ($j = 0; $j < 2; $j++) {
                $playerCard[] = $table["deck"]->draw();
            }
            array_push($table["players"], $playerCard);
        }

        return $table["players"];
    }
}


$table1 = Dealer::startGame(4);
print_r($table1);
