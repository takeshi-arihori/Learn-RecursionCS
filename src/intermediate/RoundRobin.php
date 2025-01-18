<?php

class RoundRobin
{
    // 1次元配列
    // RoundRobinTest.php の testChooseNFromBags2d() でtest
    public function chooseNFromBags1d(int $n, array $bagOfNumbers, int $totalBags, int $numbersPerBag): array
    {
        $chosenNumbers = [];
        $counter = 0;
        while ($counter < $n) {
            // 現在のバッグの範囲を取得します
            // counter が毎度 +1 されるので、currentBagStart　が 0 -> 4 -> 8 -> ... のようにループの度に値が変わります
            $currentBagStart = ($counter % $totalBags) * $numbersPerBag;
            $currentBagEnd = $currentBagStart + $numbersPerBag - 1;

            // 範囲内から 1 つ数字を選択します
            $chosenNumbers[] = ($bagOfNumbers[rand($currentBagStart, $currentBagEnd - 1)]);
            $counter += 1;
        }
        return $chosenNumbers;
    }

    function chooseNFromBags2d($n, $listOfBags)
    {
        $totalBags = count($listOfBags);
        $chosenNumbers = [];
        $counter = 0;
        while ($counter < $n) {
            # counter % numberOfBags によって、ラウンドロビンができます。バッグの中を循環します。
            $currentBag = $listOfBags[$counter % $totalBags];
            # 選択された数値を追加します。currentBagからランダムな値が選択されます。
            $chosenNumbers[] = ($currentBag[rand(0, count($currentBag) - 1)]);
            # counterを1ずつ増加します。
            $counter += 1;
        }
        return $chosenNumbers;
    }

    function printArray($intArr)
    {
        echo "[";
        for ($i = 0; $i < count($intArr); $i++) {
            echo $intArr[$i] . " ";
        }
        echo "]" . PHP_EOL;
    }
}


# それぞれのバッグは4つの数字を含んでいます。
# 二次元配列
$luckyArrayOfBags = [[21, 5, 12, 25], [100, 88, 354, 643], [122, 145, 825, 4], [228, 674, 777, 77]];

$roundRobin = new RoundRobin();
$roundRobin->printArray($roundRobin->chooseNFromBags2d(10, $luckyArrayOfBags));
