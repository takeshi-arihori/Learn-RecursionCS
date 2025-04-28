<?php

/**
 * 分割統治法
 * 以下の3ステップを再帰的に実装することで問題を解決する方法
 * 1. 分割: 問題全体を同じ構造の小さな問題に分割する
 * 2. 統治: 分割した問題を、それ以上分割できない規模になるまで解く
 * 3. 合併: 解いた多数の部分問題の解を、分割と逆の順番に併合していき、全体を一つに統合する
 */
function sumOfArray(array $arr)
{
    return sumOfArrayHelper($arr, 0, count($arr) - 1);
}

// 手順1: リストを同じ大きさの二つの部分リストに分ける
// 手順2: それぞれの部分リストの合計を計算する。(再帰で)
// 手順3: 最後に、左右の部分リストの合計を求める
function sumOfArrayHelper(array $arr, int $start, int $end)
{
    if ($start == $end) return $arr[$start];

    $mid = floor(($start + $end) / 2);

    $leftArr = sumOfArrayHelper($arr, $start, $mid);
    $rightArr = sumOfArrayHelper($arr, $mid + 1, $end);

    // 単一要素同士を足す
    return $leftArr + $rightArr;
}

$arr = [1, 2, 3, 4, 5];
echo sumOfArray($arr);
