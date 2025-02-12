<?php

class Sort
{
    /**
     * 選択ソート
     * 配列の未ソートの部分から最小の要素を選んで、現在の位置の要素と交換することを繰り返す、とてもシンプルなソートアルゴリズム
     * 要素をソートするために追加のスペースを必要とせず、元の配列の中でソートが行われているため、 in-place ソートと呼ばれている。
     *
     * @param array $list
     * @return array
     */
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

    /**
     * 挿入ソート
     * 1つずつ順番に要素を取り出し、その要素をソート済みの部分の適切な場所に挿入していくソートアルゴリズム
     * 選択ソートと同じで追加のスペースを必要とせず、in-place ソートのアルゴリズム
     *
     * @param array $list
     * @return array
     */
    public static function insertionSort(array $list): array
    {
        $n = count($list);

        for ($i = 0; $i < $n; $i++) {
            $currentValue = $list[$i];
            // currentValueの左側を探索し、挿入できる箇所を探索する
            for ($j = $i - 1; $j >= 0; $j--) {
                // currentValueが小さい場合は、値を入れ替えていく
                if ($currentValue <= $list[$j]) {
                    $list[$j + 1] = $list[$j];
                    $list[$j] = $currentValue;
                }
                // currentValueが大きい場合は正しい位置にあるため、ループを終了して $i+1 に移動する
                else break;
            }
        }

        return $list;
    }
}
