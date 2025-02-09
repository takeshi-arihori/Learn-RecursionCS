<?php

require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Deck.php';
require_once __DIR__ . '/HelperFunctions.php';

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
            "deck" => new Deck($gameMode)
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

        return $table;
    }

    static function initialCards(string $gameMode): int
    {
        if ($gameMode == "poker") return 5;
        if ($gameMode == "21") return 2;
    }

    // 卓の情報を表示するメソッド
    static function printTableInformation(array $table): void
    {
        echo "Amount of players: " . count($table["players"]) . "... Game mode: " . $table["gameMode"] . ". At this table: " . PHP_EOL;

        for ($i = 0; $i < count($table["players"]); $i++) {
            echo "Player " . ($i + 1) . " hand is: " . PHP_EOL;

            for ($j = 0; $j < count($table["players"][$i]); $j++) {
                echo $table["players"][$i][$j]->getCardString() . PHP_EOL;
            }
        }
    }

    // 各プレーヤーの手札を受け取って、合計値を計算するscore21Individualメソッドを作成します。
    // ブラックジャックでは値の合計値が21を超えるとNGなのでその場合は0とします。
    static function score21Individual(array $hand): int
    {
        $value = 0;
        foreach ($hand as $card) {
            $value += $card->intValue;
        }
        return $value > 21 ? 0 : $value;
    }

    // ブラックジャックで勝利したプレイヤを表示
    // 配列のスコアを key: value に変換
    static function winnerOf21(array $table): string
    {
        $points = [];
        $cache = [];
        for ($i = 0; $i < count($table["players"]); $i++) {
            $point = Dealer::score21Individual($table["players"][$i]);
            // それぞれのpointを配列に保存
            array_push($points, $point);

            if (isset($cache[$point]) && $cache[$point] >= 1) $cache[$point] += 1;
            else $cache[$point] = 1;
        }

        // 各プレイヤーの得点を確認
        echo implode(',', $points) . " ";

        $winnerIndex = HelperFunctions::maxInArrayIndex($points);
        if ($cache[$points[$winnerIndex]] > 1) return "It is a draw";
        else if ($cache[$points[$winnerIndex]] >= 0) return "player " . ($winnerIndex + 1) . " is the winner";
        else return "No winners..";
    }
}


$table = Dealer::startGame(4, "21");

Dealer::printTableInformation($table);
echo Dealer::winnerOf21($table) . PHP_EOL;
