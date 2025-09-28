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


    /**
     * 間順走査
     *
     * @param BinaryTree|null $root
     * @param [type] $res
     * @return void
     */
    public function inOrderWalk(?BinaryTree $root, &$res): array | null
    {
        if ($root === null) return null;

        $this->inOrderWalk($root->getLeft(), $res);
        $res[] = $root->getData();
        $this->inOrderWalk($root->getRight(), $res);

        return $res;
    }

    /**
     * 前順走査
     *
     * @param BinaryTree|null $root
     * @return void
     */
    public function preOrderWalk(?BinaryTree $root): array | null
    {
        if ($root === null) return null;

        $res = [];
        $res[] = $root->getData();

        $left = $this->preOrderWalk($root->getLeft());
        if ($left !== null) {
            $res = array_merge($res, $left);
        }

        $right = $this->preOrderWalk($root->getRight());
        if ($right !== null) {
            $res = array_merge($res, $right);
        }

        return $res;
    }

    /**
     * 後順走査
     *
     * @param BinaryTree|null $root
     * @return void
     */
    public function postOrderWalk(?BinaryTree $root): array | null
    {
        if ($root === null) return null;

        $res = [];

        $left = $this->postOrderWalk($root->getLeft());
        if ($left !== null) {
            $res = array_merge($res, $left);
        }

        $right = $this->postOrderWalk($root->getRight());
        if ($right !== null) {
            $res = array_merge($res, $right);
        }

        $res[] = $root->getData();

        return $res;
    }

    /**
     * 逆順走査
     *
     * @param BinaryTree|null $root
     * @return void
     */
    public function reverseInOrderWalk(?BinaryTree $root): array | null
    {
        if ($root === null) return null;

        $res = [];

        $right = $this->reverseInOrderWalk($root->getRight());
        if ($right !== null) {
            $res = array_merge($res, $right);
        }

        $res[] = $root->getData();

        $left = $this->reverseInOrderWalk($root->getLeft());
        if ($left !== null) {
            $res = array_merge($res, $left);
        }

        return $res;
    }

    /**
     * BSTに整数が存在するか確認
     *
     * @param integer $key
     * @return boolean
     */
    public function keyExists(int $key): bool
    {
        return $this->search($key) !== null;
    }

    /**
     * BSTに整数が存在するならそのノードを返す
     *
     * @param integer $key
     * @return BinaryTree|null
     */
    public function search(int $key): ?BinaryTree
    {
        $iterator = $this->root;
        while ($iterator !== null) {
            if ($iterator->getData() === $key) return $iterator;
            $iterator = ($iterator->getData() > $key) ? $iterator->getLeft() : $iterator->getRight();
        }
        return null;
    }

    /**
     * BSTに整数を挿入する
     *
     * @param integer $value
     * @return BinaryTree|null
     */
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

    /**
     * 完全二分木のノードの数を取得
     *
     * @param BinaryTree|null $root
     * @return integer
     */
    public function countNodes(?BinaryTree $root): int
    {
        return $this->countNodesHelper($root, 1);
    }

    private function countNodesHelper(?BinaryTree $root, int $count): int
    {
        if ($root === null) return 0;

        if ($root->getLeft() !== null) $count = $this->countNodesHelper($root->getLeft(), $count + 1);
        if ($root->getRight() !== null) $count = $this->countNodesHelper($root->getRight(), $count + 1);
        return $count;
    }

    /**
     * BSTソート
     * 二分探索木root1, root2を受け取り、2つに含まれている全ての整数を昇順でリストとして返す
     *
     * @param BinaryTree|null $root1
     * @param BinaryTree|null $root2
     * @return array
     */
    public function allElementsSorted(?BinaryTree $root1, ?BinaryTree $root2): array
    {
        // 間順走査で昇順に要素を取り出す
        $res1 = [];
        $res2 = [];
        $res1 = $this->inOrderWalk($root1, $res1) ?? [];
        $res2 = $this->inOrderWalk($root2, $res2) ?? [];

        $res = [];
        // インデックスの追跡 root1:i, root2:j
        $i = 0;
        $j = 0;

        while ($i < count($res1) && $j < count($res2)) {
            // 2つのリストを比較しながら小さい方をresに入れていく
            if ($res1[$i] < $res2[$j]) {
                $res[] = $res1[$i];
                $i++;
            } else {
                $res[] = $res2[$j];
                $j++;
            }
        }

        // 要素が残っているリストを足す
        return $i < count($res1) ? array_merge($res, array_slice($res1, $i)) : array_merge($res, array_slice($res2, $j));
    }
}
