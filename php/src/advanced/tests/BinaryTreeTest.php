<?php

use PHPUnit\Framework\TestCase;

// Test Command
// ./vendor/bin/phpunit --testdox php/src/advanced/tests/BinaryTreeTest.php

require_once __DIR__ . '/../BinaryTree.php';

class BinaryTreeTest extends TestCase
{
    public function testSortedArrayToBST()
    {
        $binaryTree = new BinaryTree(""); // ダミーのデータで初期化

        // テストケース1: 基本的な配列
        $list1 = [1, 2, 3, 4, 5];
        $bst1 = $binaryTree->sortedArrayToBST($list1);
        $this->assertTrue($this->isValidBST($bst1));
        $this->assertEquals(3, $bst1->data); // ルートノードは中央値

        // テストケース2: 空の配列
        $list2 = [];
        $bst2 = $binaryTree->sortedArrayToBST($list2);
        $this->assertNull($bst2);

        // テストケース3: 単一要素
        $list3 = [1];
        $bst3 = $binaryTree->sortedArrayToBST($list3);
        $this->assertTrue($this->isValidBST($bst3));
        $this->assertEquals(1, $bst3->data);

        // テストケース4: 偶数長の配列
        $list4 = [1, 2, 3, 4];
        $bst4 = $binaryTree->sortedArrayToBST($list4);
        $this->assertTrue($this->isValidBST($bst4));
        $this->assertEquals(2, $bst4->data); // ルートノードは中央値

        // テストケース5: 負の数を含む配列
        $list5 = [-5, -3, 0, 2, 4];
        $bst5 = $binaryTree->sortedArrayToBST($list5);
        $this->assertTrue($this->isValidBST($bst5));
        $this->assertEquals(0, $bst5->data); // ルートノードは中央値
    }

    private function isValidBST($root, $min = PHP_INT_MIN, $max = PHP_INT_MAX)
    {
        if ($root === null) {
            return true;
        }

        // 現在のノードの値が範囲内にあるかチェック
        if ($root->data <= $min || $root->data >= $max) {
            return false;
        }

        // 左の部分木と右の部分木を再帰的にチェック
        return $this->isValidBST($root->left, $min, $root->data) &&
            $this->isValidBST($root->right, $root->data, $max);
    }
}

// 実行方法
// php src/vendor/bin/phpunit --testdox src/advanced/tests/BinaryTreeTest.php