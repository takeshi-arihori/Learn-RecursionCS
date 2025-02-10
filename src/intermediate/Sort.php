<?php

class Sort
{
    // テスト用のリスト
    // 選択ソート
    public static function selectionSort(array $list): array
    {
        $n = count($list);
        for ($i = 0; $i < $n; $i++) {
            // $i 番目の値を暫定の最小値とする
            $minIndex = $i;
            // $i 番目より後ろから最小値を探す
            for ($j = $i + 1; $j < $n; $j++) {
                // 暫定の最小値以下なら最小値を更新
                if ($list[$j] <= $list[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // 最小値と先頭を in-place で入れ替え
            $temp = $list[$i];
            $list[$i] = $list[$minIndex];
            $list[$minIndex] = $temp;
        }
        return $list;
    }
}
