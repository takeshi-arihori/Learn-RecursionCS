<?php

/**
 * 計算のみを行うHelperFunctionsクラス
 * 最も高いスコアを得た人が誰かを判断するための機能
 */
class HelperFunctions
{
    // 数値で構成される配列を受け取り、最大値のインデックスを返す
    static function maxInArrayIndex(array $intArr): int
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
}
