<?php
// 配列の合体
// 整数で構成される配列 leftArr と rightArr が与えられます。2 つの配列はすでにソートされているので、2 つの配列をマージし、小さい順に並べられた配列を返す merge という関数を作成してください。

// 関数の入出力例
// 入力のデータ型： integer[] leftArr, integer[] rightArr
// 出力のデータ型： integer[]
// merge([3,4,7,9,15],[0,1,2,8,19]) --> [0,1,2,3,4,7,8,9,15,19]
// merge([14,32,62,77],[10,29,32,45]) --> [10,14,29,32,32,45,62,77]
// merge([1,2,3,4,6],[5,7,8,9,10]) --> [1,2,3,4,5,6,7,8,9,10]

// ヒント: 与えられた配列の最後に無限大を入れておくことで、ソートが完了するまで比較し続けることができます

class MergedArray
{
    public function merge(array $leftArr, array $rightArr): array
    {
        $mergedArray = [];
        $leftArr[] = PHP_INT_MAX;
        $rightArr[] = PHP_INT_MAX;

        $leftIndex = 0;
        $rightIndex = 0;
        $totalLength = count($leftArr) + count($rightArr) - 2; // 無限大を除いた実際の長さ

        for ($i = 0; $i < $totalLength; $i++) {
            if ($leftArr[$leftIndex] <= $rightArr[$rightIndex]) {
                $mergedArray[] = $leftArr[$leftIndex];
                $leftIndex++;
            } else {
                $mergedArray[] = $rightArr[$rightIndex];
                $rightIndex++;
            }
        }
        return $mergedArray;
    }
}

$mergedArray = new MergedArray();
echo implode(',', $mergedArray->merge([3, 4, 7, 9, 15], [0, 1, 2, 8, 19])); // [0,1,2,3,4,7,8,9,15,19]
echo "\n";
echo implode(',', $mergedArray->merge([14, 32, 62, 77], [10, 29, 32, 45])); // [10,14,29,32,32,45,62,77]
echo "\n";
echo implode(',', $mergedArray->merge([1, 2, 3, 4, 6], [5, 7, 8, 9, 10])); // [1,2,3,4,5,6,7,8,9,10]
echo "\n";
