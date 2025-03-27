<?php

// ソート済みのリストから平衡二分探索木を作る方法
// 1. 開始位置（startIndex）と終了位置（endIndex）を指定して配列を取り出します。
// 2. その配列の中央の値を新しい二分探索木の根ノードに設定します。
// 3. 開始位置から中央の一つ前までを取り出して、それを再帰的に左の部分木を作る関数に渡します。
// 4. 中央の一つ後から終了位置までを取り出して、それを再帰的に右の部分木を作る関数に渡します。
// 5. リストが 1 つの値だけになったら、それを新たなノードとして木に追加します。

class BinaryTree
{
    public string $data;
    public ?BinaryTree $left;
    public ?BinaryTree $right;

    public function __construct(string $data, ?BinaryTree $left = null, ?BinaryTree $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }

    public function sortedArrayToBSTHelper(array $list, int $startIndex, int $endIndex): ?BinaryTree
    {
        if ($startIndex === $endIndex) return new BinaryTree(($list[$startIndex]));
        $middleIndex = floor(($startIndex + $endIndex) / 2);

        $left = null;
        if ($middleIndex - 1 >= $startIndex) $left = $this->sortedArrayToBSTHelper($list, $startIndex, $middleIndex - 1);

        $right = null;
        if ($middleIndex + 1 <= $endIndex) $right = $this->sortedArrayToBSTHelper($list, $middleIndex + 1, $endIndex);

        $root = new BinaryTree($list[$middleIndex], $left, $right);

        return $root;
    }

    public function sortedArrayToBST(array $numOfArray): ?BinaryTree
    {
        if (count($numOfArray) === 0) return null;
        return $this->sortedArrayToBSTHelper($numOfArray, 0, count($numOfArray) - 1);
    }
}
