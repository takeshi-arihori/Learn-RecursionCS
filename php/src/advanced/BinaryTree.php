<?php

// ソート済みのリストから平衡二分探索木を作る方法
// 1. 開始位置（startIndex）と終了位置（endIndex）を指定して配列を取り出します。
// 2. その配列の中央の値を新しい二分探索木の根ノードに設定します。
// 3. 開始位置から中央の一つ前までを取り出して、それを再帰的に左の部分木を作る関数に渡します。
// 4. 中央の一つ後から終了位置までを取り出して、それを再帰的に右の部分木を作る関数に渡します。
// 5. リストが 1 つの値だけになったら、それを新たなノードとして木に追加します。

class BinaryTree
{
    public int $data;
    public ?BinaryTree $left;
    public ?BinaryTree $right;

    public function __construct(int $data, ?BinaryTree $left = null, ?BinaryTree $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }
}

class BinarySearchTree
{
    public $root;

    public function __construct(array $numOfArray)
    {
        if (empty($numOfArray)) {
            $this->root = null;
        } else {
            $this->root = $this->sortedArrayToBSTHelper($numOfArray, 0, count($numOfArray) - 1);
        }
    }

    public function sortedArrayToBSTHelper(array $list, int $startIndex, int $endIndex): ?BinaryTree
    {
        if ($startIndex > $endIndex) return null;
        if ($startIndex === $endIndex) return new BinaryTree($list[$startIndex]);
        $middleIndex = floor(($startIndex + $endIndex) / 2);

        $left = null;
        if ($middleIndex - 1 >= $startIndex) $left = $this->sortedArrayToBSTHelper($list, $startIndex, $middleIndex - 1);

        $right = null;
        if ($middleIndex + 1 <= $endIndex) $right = $this->sortedArrayToBSTHelper($list, $middleIndex + 1, $endIndex);

        $root = new BinaryTree($list[$middleIndex], $left, $right);

        return $root;
    }

    // BSTリストの中にキーが存在するかどうかを再帰を用いて確認する
    public function keyExist(int $key, ?BinaryTree $bst): bool
    {
        if ($bst === null) return false;
        if ($bst->data === $key) return true;

        // 現在のノードよりキーが小さければ左に、大きければ右にたどる。
        if ($bst->data > $key) return $this->keyExist($key, $bst->left);
        else return $this->keyExist($key, $bst->right);
    }

    // 反復iteratorを使って木構造を検索
    public function keyExistIterator(int $key, ?BinaryTree $bst): bool
    {
        $iterator = $bst;
        while ($iterator !== null) {
            if ($iterator->data === $key) return true;
            // 現在のノードよりキーが小さければ左に、大きければ右にたどる。
            if ($iterator->data > $key) $iterator = $iterator->left;
            else $iterator = $iterator->right;
        }
        return false;
    }

    // keyを受け取り、BinarySearchTree内を探索し、部分木subTreeを返す
    public function search(int $key): ?BinaryTree
    {
        $iterator = $this->root;
        while ($iterator !== null) {
            if ($iterator->data === $key) return $iterator;
            if ($iterator->data > $key) $iterator = $iterator->left;
            else $iterator = $iterator->right;
        }
        return null;
    }
}
