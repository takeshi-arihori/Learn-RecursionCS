<?php

namespace Advanced;

// 深さ優先探索（depth-first search: DFS）は、グラフや木構造を走査するためのアルゴリズムです。
// この探索方法は、現在の頂点（ノード）から接続している未訪問の頂点へ進み、進むことができなくなったときに初めて戻るという戦略を採用します。

// 1. 初期ノードから探索を開始します。
// 2. 現在のノードに隣接する未訪問のノードがある場合は、そのノードを訪問し、そのノードを新たな「現在のノード」とします。そして、ステップ 2 を再度行います。
// 3. 現在のノードに隣接する未訪問のノードがない場合は、直前に訪れたノードに戻ります。そして、ステップ 2 を再度行います。
// 4. 全てのノードを訪問するか、または目的のノードが見つかった場合に探索を終了します。
// 深さ優先探索は、たとえば迷路の解を見つける場合や、チェスの最適解をを探索する場合など、ある状態から始めてその「深さ」（つまり、それ以降に続く可能性のある状態）を全て探索する際に役立ちます。

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

    public function printInOrder(): void
    {
        $this->inOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    // 間順走査
    public function inOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            $this->inOrderWalk($tRoot->left);
            echo ($tRoot->data . " ");
            $this->inOrderWalk($tRoot->right);
        }
    }

    public function printPreOrder(): void
    {
        $this->preOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    // 前順走査
    public function preOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            echo ($tRoot->data . " ");
            $this->preOrderWalk($tRoot->left);
            $this->preOrderWalk($tRoot->right);
        }
    }

    public function printPostOrder(): void
    {
        $this->postOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    // 後順走査
    public function postOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            $this->postOrderWalk($tRoot->left);
            $this->postOrderWalk($tRoot->right);
            echo ($tRoot->data . " ");
        }
    }

    public function printLevelOrder(): void
    {
        $this->levelOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    // 逆順間走査
    public function levelOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            $this->levelOrderWalk($tRoot->right);
            echo ($tRoot->data . " ");
            $this->levelOrderWalk($tRoot->left);
        }
    }
}

class DepthFirstTraversal
{
    private ?BinaryTree $root;

    public function __construct($arrList)
    {
        $this->generateRandomBST($arrList);
    }

    // 受け取った配列をシャッフルしてBSTを作る関数を作成
    public function generateRandomBST(array $arrList): void
    {
        if (!$arrList) $this->root = null;
        else {
            shuffle($arrList);
            $this->root = new BinaryTree($arrList[0]);
            for ($i = 1; $i < count($arrList); $i++) {
                // シャッフルした配列の要素を一つずつinsretでBSTに挿入
                $this->insert($arrList[$i]);
            }
        }
    }

    public static function maximumDepth(?BinaryTree $root): int
    {
        if ($root === null) return 0;
        if ($root->left === null && $root->right === null) return 0;
        $leftDepth = self::maximumDepth($root->left);
        $rightDepth = self::maximumDepth($root->right);
        return max($leftDepth, $rightDepth) + 1;
    }

    // BSTに要素を挿入する関数
    public function insert(int $value): ?BinaryTree
    {
        $iterator = $this->root;
        while ($iterator !== null) {
            if ($iterator->data > $value && $iterator->left === null) $iterator->left = new BinaryTree($value);
            else if ($iterator->data < $value && $iterator->right === null) $iterator->right = new BinaryTree($value);

            $iterator = ($iterator->data > $value) ? $iterator->left : $iterator->right;
        }
        return $this->root;
    }

    public function printSorted(): void
    {
        if ($this->root === null) return;
        $this->root->printInOrder();
    }
}

// 昇順に並んだ配列を作成
class RandomContainer
{
    public static function generateList(int $size): array
    {
        $list = [];
        for ($i = 0; $i < $size; $i++) {
            $list[] = rand(1, 100);
        }
        return $list;
    }
}
