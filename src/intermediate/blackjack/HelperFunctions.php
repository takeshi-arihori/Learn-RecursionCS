<?php

/**
 * 計算のみを行うHelperFunctionsクラス
 * 最も高いスコアを得た人が誰かを判断するための機能
 */
class HelperFunctions
{
    // 数値で構成される配列を受け取り、最大値のインデックスを返す
    public static function maxInArrayIndex(array $intArr): int
    {
        $maxIndex = 0;
        $maxValue = $intArr[0];

        for ($i = 1; $i < count($intArr); $i++) {
            if ($intArr[$i] > $maxValue) {
                $maxValue = $intArr[$i];
                $maxIndex = $i;
            }
        }
        return $maxIndex;
    }

    // 数字だけの配列を作成
    public static function generateNumberArr(array $playerCard): array
    {
        $intArr = [];
        foreach ($playerCard as $card) {
            array_push($intArr, $card->intValue);
        }
        return $intArr;
    }

    // Hashmapの作成
    public static function createHashmap(array $cardPower, array $numberArr): array
    {
        $hashmap = [];

        foreach ($cardPower as $card) $hashmap[$card] = 0;
        foreach ($numberArr as $value) $hashmap[(string)$value]++;

        return $hashmap;
    }
}
