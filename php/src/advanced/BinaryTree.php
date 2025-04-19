<?php

// BinaryTreeクラス - 木のノードを表す基本クラス
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

    function inOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            $this->inOrderWalk($tRoot->left);
            echo ($tRoot->data . " ");
            $this->inOrderWalk($tRoot->right);
        }
    }
}

// TreeBuilderクラス - 木の構築に関連する機能
class TreeBuilder
{
    // ソート済み配列から二分探索木を構築
    public function sortedArrayToBST(array $numOfArray): ?BinaryTree
    {
        if (empty($numOfArray)) {
            return null;
        } else {
            return $this->sortedArrayToBSTHelper($numOfArray, 0, count($numOfArray) - 1);
        }
    }

    public function sortedArrayToBSTHelper(array $list, int $startIndex, int $endIndex): ?BinaryTree
    {
        if ($startIndex > $endIndex) return null;
        if ($startIndex === $endIndex) return new BinaryTree($list[$startIndex]);
        $middleIndex = floor(($startIndex + $endIndex) / 2);

        $left = ($middleIndex - 1 >= $startIndex) ? $this->sortedArrayToBSTHelper($list, $startIndex, $middleIndex - 1) : null;
        $right = ($middleIndex + 1 <= $endIndex) ? $this->sortedArrayToBSTHelper($list, $middleIndex + 1, $endIndex) : null;

        $root = new BinaryTree($list[$middleIndex], $left, $right);

        return $root;
    }
}

// TreeSearchクラス - 木の検索に関連する機能
class TreeSearch
{
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

    // keyを受け取り、二分探索木内を探索し、部分木subTreeを返す
    public function search(int $key, ?BinaryTree $root): ?BinaryTree
    {
        $iterator = $root;
        while ($iterator !== null) {
            if ($iterator->data === $key) return $iterator;
            if ($iterator->data > $key) $iterator = $iterator->left;
            else $iterator = $iterator->right;
        }
        return null;
    }

    // 最小値を探す
    public function minimumNode(?BinaryTree $root): ?BinaryTree
    {
        $iterator = $root;
        while ($iterator !== null && $iterator->left !== null) {
            $iterator = $iterator->left;
        }
        return $iterator;
    }

    // 最大値を探す
    public function maximumNode(?BinaryTree $root): ?BinaryTree
    {
        $iterator = $root;
        while ($iterator !== null && $iterator->right !== null) {
            $iterator = $iterator->right;
        }
        return $iterator;
    }
}

// TreeTraversalクラス - 木の巡回と深さ計算に関連する機能
class TreeTraversal
{
    // 最大の深さを求める
    public function maximumDepth(?BinaryTree $root): int
    {
        if ($root === null) return 0;
        if ($root->left === null && $root->right === null) return 0;
        // ヘルパーメソッドを使って深さをカウントする
        return $this->maximumDepthHelper($root, 0);
    }

    // 最大の深さを求めるヘルパーメソッド
    private function maximumDepthHelper(?BinaryTree $root, int $count): int
    {
        // rootの左の子がnullになるまで左に進み、nullになったらcountを返す
        $leftDepth = ($root->left !== null) ? $this->maximumDepthHelper($root->left, $count + 1) : $count;
        $rightDepth = ($root->right !== null) ? $this->maximumDepthHelper($root->right, $count + 1) : $count;
        return max($leftDepth, $rightDepth);
    }

    // 二分探索木の要素を配列に追加するヘルパーメソッド
    public function inOrderTraversal(?BinaryTree $root, array &$sortedList): void
    {
        // 中間順巡回（in-order traversal）を実行
        if ($root !== null) {
            // 左部分木を処理
            $this->inOrderTraversal($root->left, $sortedList);
            // 現在のノードの値を配列に追加
            $sortedList[] = $root->data;
            // 右部分木を処理
            $this->inOrderTraversal($root->right, $sortedList);
        }
    }
}

// TreeOperationsクラス - 木の操作（挿入、反転など）に関連する機能
class TreeOperations
{
    private TreeSearch $treeSearch;

    public function __construct()
    {
        $this->treeSearch = new TreeSearch();
    }

    // 挿入
    public function insert(int $value, ?BinaryTree &$root, ?BinaryTree $node = null): ?BinaryTree
    {
        // ノードが指定されていない場合はルートを使用
        if ($node === null) {
            $node = $root;
            // ルートも存在しない場合は新しいルートを作成
            if ($node === null) {
                $root = new BinaryTree($value);
                return $root;
            }
        }

        // 値が既に存在する場合は何もしない
        if ($node->data === $value) {
            return $node;
        }

        // 値が現在のノードより小さい場合は左へ
        if ($value < $node->data) {
            // 左の子が存在しない場合は新しいノードを作成
            if ($node->left === null) {
                $node->left = new BinaryTree($value);
            } else {
                // 左の子が存在する場合は再帰的に挿入
                $this->insert($value, $root, $node->left);
            }
        }
        // 値が現在のノードより大きい場合は右へ
        else {
            // 右の子が存在しない場合は新しいノードを作成
            if ($node->right === null) {
                $node->right = new BinaryTree($value);
            } else {
                // 右の子が存在する場合は再帰的に挿入
                $this->insert($value, $root, $node->right);
            }
        }

        return $node;
    }

    // 二分の反転
    public function invertTree(?BinaryTree $root): ?BinaryTree
    {
        // 幅優先走査
        // キューを使用
        $queue = [];
        // 根ノードをiteratorに入れる。
        $iterator = $root;
        // iteratorがnullになるまで繰り返す
        while ($iterator !== null) {
            // iteratorの左右の部分木をキューに入れる
            array_push($queue, $iterator->left);
            array_push($queue, $iterator->right);

            // swap
            $temp = $iterator->left;
            $iterator->left = $iterator->right;
            $iterator->right = $temp;

            // キューの先頭は削除して、新しいiteratorにする
            $iterator = array_shift($queue);
        }
        return $root;
    }

    // TreeOperationsクラス内のinvertTreeメソッド
    // public function invertTree(?BinaryTree $root): ?BinaryTree
    // {
    //     if ($root === null) return null;

    //     // 左右を一時変数に保存してから入れ替え
    //     $temp = $root->left;
    //     $root->left = $this->invertTree($root->right);
    //     $root->right = $this->invertTree($temp);

    //     return $root;
    // }
}

// TreeNodeRelationsクラス - ノード間の関係（後続、先行）に関連する機能
class TreeNodeRelations
{
    private TreeSearch $treeSearch;

    public function __construct()
    {
        $this->treeSearch = new TreeSearch();
    }

    // rootとBST内に存在するkeyを受け取り、根ノードが後続ノードである部分木を返す
    public function successor(?BinaryTree $root, int $key): ?BinaryTree
    {
        // keyのノードを探す
        $targetNode = $this->treeSearch->search($key, $root);
        if ($targetNode === null) return null;

        // ケース1: targetNodeが右の子を持っている場合
        if ($targetNode->right !== null) {
            return $this->treeSearch->minimumNode($targetNode->right);
        }

        // ケース2: targetNodeが右の子を持っていない場合
        $successor = null;
        $iterator = $root;

        while ($iterator !== null) {
            // ターゲットとiteratorが同じ場合は、successorを返す
            if ($targetNode->data == $iterator->data) return $successor;
            // 左側に進むときは、現在のiteratorが後続ノードである可能性があるので、successorを更新する
            if ($targetNode->data < $iterator->data) {
                $successor = $iterator;
                $iterator = $iterator->left;
                // 右側に進むときは、successorを更新しない
            } else if ($targetNode->data > $iterator->data) {
                $iterator = $iterator->right;
            }
        }

        return $successor;
    }

    // rootとBST内に存在するkeyを受け取り、根ノードが先行ノードである部分木を返す
    public function predecessor(?BinaryTree $root, int $key): ?BinaryTree
    {
        // keyのノードを探す
        $targetNode = $this->treeSearch->search($key, $root);
        if ($targetNode === null) return null;

        // ケース1: targetNodeが左の子を持っている場合
        if ($targetNode->left !== null) {
            return $this->treeSearch->maximumNode($targetNode->left);
        }

        // ケース2: targetNodeが左の子を持っていない場合
        $predecessor = null;
        $iterator = $root;

        while ($iterator !== null) {
            if ($targetNode->data === $iterator->data) return $predecessor;
            if ($targetNode->data > $iterator->data) {
                $predecessor = $iterator;
                $iterator = $iterator->right;
            } else if ($targetNode->data < $iterator->data) {
                $iterator = $iterator->left;
            }
        }

        return $predecessor;
    }
}

// TreeMergeクラス - 木のマージに関連する機能
class TreeMerge
{
    private TreeTraversal $treeTraversal;

    public function __construct()
    {
        $this->treeTraversal = new TreeTraversal();
    }

    // 二つの二分探索木の全要素をソートされた配列として返す（sort関数使用）
    public function allElementsSortedWithSort(?BinaryTree $root1, ?BinaryTree $root2): array
    {
        $sortedList = [];

        // 中間順巡回（in-order traversal）で木の要素を配列に追加
        $this->treeTraversal->inOrderTraversal($root1, $sortedList);
        $this->treeTraversal->inOrderTraversal($root2, $sortedList);

        // 結果を昇順にソート
        sort($sortedList);

        return $sortedList;
    }

    // 二つの二分探索木の全要素をソートされた配列として返す（マージソート的アプローチ）
    public function allElementsSorted(?BinaryTree $root1, ?BinaryTree $root2): array
    {
        // 各木から要素を取得
        $root1ToArray = [];
        $root2ToArray = [];

        $this->treeTraversal->inOrderTraversal($root1, $root1ToArray);
        $this->treeTraversal->inOrderTraversal($root2, $root2ToArray);

        // マージ結果を格納する配列
        $sortedList = [];

        // マージ操作（マージソート的なアプローチ）
        $i = 0;
        $j = 0;
        while ($i < count($root1ToArray) && $j < count($root2ToArray)) {
            if ($root1ToArray[$i] <= $root2ToArray[$j]) {
                $sortedList[] = $root1ToArray[$i];
                $i++;
            } else {
                $sortedList[] = $root2ToArray[$j];
                $j++;
            }
        }

        // 残りの要素を追加
        while ($i < count($root1ToArray)) {
            $sortedList[] = $root1ToArray[$i];
            $i++;
        }

        while ($j < count($root2ToArray)) {
            $sortedList[] = $root2ToArray[$j];
            $j++;
        }

        return $sortedList;
    }
}

// BinarySearchTreeクラス - すべての機能をまとめたクラス
class BinarySearchTree
{
    public $root;
    private TreeBuilder $treeBuilder;
    private TreeSearch $treeSearch;
    private TreeTraversal $treeTraversal;
    private TreeOperations $treeOperations;
    private TreeNodeRelations $treeNodeRelations;
    private TreeMerge $treeMerge;

    public function __construct(array $numOfArray)
    {
        $this->treeBuilder = new TreeBuilder();
        $this->treeSearch = new TreeSearch();
        $this->treeTraversal = new TreeTraversal();
        $this->treeOperations = new TreeOperations();
        $this->treeNodeRelations = new TreeNodeRelations();
        $this->treeMerge = new TreeMerge();

        if (empty($numOfArray)) {
            $this->root = null;
        } else {
            $this->root = $this->treeBuilder->sortedArrayToBST($numOfArray);
        }
    }

    // 元のクラスのメソッドは、各専門クラスのメソッドを呼び出すだけのメソッドに置き換え

    public function sortedArrayToBSTHelper(array $list, int $startIndex, int $endIndex): ?BinaryTree
    {
        return $this->treeBuilder->sortedArrayToBSTHelper($list, $startIndex, $endIndex);
    }

    public function keyExist(int $key, ?BinaryTree $bst): bool
    {
        return $this->treeSearch->keyExist($key, $bst);
    }

    public function keyExistIterator(int $key, ?BinaryTree $bst): bool
    {
        return $this->treeSearch->keyExistIterator($key, $bst);
    }

    public function search(int $key): ?BinaryTree
    {
        return $this->treeSearch->search($key, $this->root);
    }

    public function successor(?BinaryTree $root, int $key): ?BinaryTree
    {
        return $this->treeNodeRelations->successor($root, $key);
    }

    public function predecessor(?BinaryTree $root, int $key): ?BinaryTree
    {
        return $this->treeNodeRelations->predecessor($root, $key);
    }

    // 最小値を探す - private methodを外部から呼び出すためのメソッド
    private function minimumNode(?BinaryTree $root): ?BinaryTree
    {
        return $this->treeSearch->minimumNode($root);
    }

    // 最大値を探す - private methodを外部から呼び出すためのメソッド
    private function maximumNode(?BinaryTree $root): ?BinaryTree
    {
        return $this->treeSearch->maximumNode($root);
    }

    public function maximumDepth(?BinaryTree $root): int
    {
        return $this->treeTraversal->maximumDepth($root);
    }

    // 最大の深さを求めるヘルパーメソッド - TreeTraversalクラスに移動

    public function insert(int $value, ?BinaryTree $node = null): ?BinaryTree
    {
        return $this->treeOperations->insert($value, $this->root, $node);
    }

    // 二つの二分探索木の全要素をソートされた配列として返す
    public function allElementsSorted(?BinaryTree $root1, ?BinaryTree $root2): array
    {
        // BinarySearchTreeクラスでは、元のコードと同じsort()を使用した実装を提供
        return $this->treeMerge->allElementsSortedWithSort($root1, $root2);

        // 別のバージョンを使用する場合（マージソート的アプローチ）
        // return $this->treeMerge->allElementsSorted($root1, $root2);
    }

    // 二分探索木の要素を配列に追加するヘルパーメソッド - TreeTraversalクラスに移動

    public function invertTree(?BinaryTree $root): ?BinaryTree
    {
        return $this->treeOperations->invertTree($root);
    }
}
