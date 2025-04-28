<?php

namespace Advanced\BinaryTree;

use Advanced\BinaryTree\BinaryTree;

class BinarySearchTree
{
    private ?BinaryTree $root;

    public function __construct(array $arrList)
    {
        $sortedList = $arrList;
        sort($sortedList);
        $this->root = $this->sortedArrayToBST($sortedList);
    }

    public static function sortedArrayToBST(array $array): ?BinaryTree
    {
        if (count($array) === 0) {
            return null;
        }

        return BinarySearchTree::sortedArrayToBSTHelper($array, 0, count($array) - 1);
    }

    public static  function sortedArrayToBSTHelper(array $arr, int $start, int $end): ?BinaryTree
    {
        if ($start === $end) return new BinaryTree($arr[$start], null, null);

        $mid = floor(($start + $end) / 2);

        $left = ($mid - 1 >= $start) ? BinarySearchTree::sortedArrayToBSTHelper($arr, $start, $mid - 1) : null;
        $right = ($mid + 1 <= $end) ? BinarySearchTree::sortedArrayToBSTHelper($arr, $mid + 1, $end) : null;
        return new BinaryTree($arr[$mid], $left, $right);
    }

    public function keyExists(int $key): bool
    {
        return $this->search($key) !== null;
    }

    public function search(int $key): ?BinaryTree
    {
        $iterator = $this->root;
        while ($iterator !== null) {
            if ($iterator->getData() === $key) return $iterator;
            $iterator = ($iterator->getData() > $key) ? $iterator->getLeft() : $iterator->getRight();
        }
        return null;
    }

    // insert
    public function insert(int $value): ?BinaryTree
    {
        if ($this->keyExists($value)) return $this->root;
        $iterator = $this->root;
        while ($iterator !== null) {
            if ($iterator->getData() > $value && $iterator->getLeft() === null) $iterator->setLeft(new BinaryTree($value));
            else if ($iterator->getData() < $value && $iterator->getRight() === null) $iterator->setRight(new BinaryTree($value));

            $iterator = ($iterator->getData() > $value) ? $iterator->getLeft() : $iterator->getRight();
        }
        return $this->root;
    }

    // 完全二分木のノードの数を取得
    public function countNodes(?BinaryTree $root): int
    {
        return $this->countNodesHelper($root, 1);
    }

    private function countNodesHelper(?BinaryTree $root, int $count): int
    {
        if($root === null) return 0;

        if($root->getLeft() !== null) $count = $this->countNodesHelper($root->getLeft(), $count+1);
        if($root->getRight() !== null) $count = $this->countNodesHelper($root->getRight(), $count+1);
        return $count;
    }
}
