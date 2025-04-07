<?php

use PHPUnit\Framework\TestCase;

// Test Command
// ./php/src/vendor/bin/phpunit --testdox php/src/advanced/tests/BinaryTreeTest.php

require_once __DIR__ . '/../BinaryTree.php';

class BinaryTreeTest extends TestCase
{
    public function testSortedArrayToBST()
    {
        // テストケース1: 基本的な配列
        $list1 = [1, 2, 3, 4, 5];
        $bst1 = new BinarySearchTree($list1);
        $this->assertTrue($this->isValidBST($bst1->root));
        $this->assertEquals(3, $bst1->root->data); // ルートノードは中央値

        // テストケース2: 空の配列
        $list2 = [];
        $bst2 = new BinarySearchTree($list2);
        $this->assertNull($bst2->root);

        // テストケース3: 単一要素
        $list3 = [1];
        $bst3 = new BinarySearchTree($list3);
        $this->assertTrue($this->isValidBST($bst3->root));
        $this->assertEquals(1, $bst3->root->data);

        // テストケース4: 偶数長の配列
        $list4 = [1, 2, 3, 4];
        $bst4 = new BinarySearchTree($list4);
        $this->assertTrue($this->isValidBST($bst4->root));
        $this->assertEquals(2, $bst4->root->data); // ルートノードは中央値

        // テストケース5: 負の数を含む配列
        $list5 = [-5, -3, 0, 2, 4];
        $bst5 = new BinarySearchTree($list5);
        $this->assertTrue($this->isValidBST($bst5->root));
        $this->assertEquals(0, $bst5->root->data); // ルートノードは中央値
    }

    public function testKeyExist()
    {
        // テスト用の二分探索木を作成
        $list = [1, 2, 3, 4, 5];
        $bst = new BinarySearchTree($list);

        // テストケース1: 存在する値
        $this->assertTrue($bst->keyExist(3, $bst->root));
        $this->assertTrue($bst->keyExist(1, $bst->root));
        $this->assertTrue($bst->keyExist(5, $bst->root));

        // テストケース2: 存在しない値
        $this->assertFalse($bst->keyExist(0, $bst->root));
        $this->assertFalse($bst->keyExist(6, $bst->root));
        $this->assertFalse($bst->keyExist(-1, $bst->root));

        // テストケース3: 空の木
        $this->assertFalse($bst->keyExist(1, null));
    }

    public function testKeyExistIterator()
    {
        // テスト用の二分探索木を作成
        $list = [1, 2, 3, 4, 5];
        $bst = new BinarySearchTree($list);

        // テストケース1: 存在する値
        $this->assertTrue($bst->keyExistIterator(3, $bst->root));
        $this->assertTrue($bst->keyExistIterator(1, $bst->root));
        $this->assertTrue($bst->keyExistIterator(5, $bst->root));

        // テストケース2: 存在しない値
        $this->assertFalse($bst->keyExistIterator(0, $bst->root));
        $this->assertFalse($bst->keyExistIterator(6, $bst->root));
        $this->assertFalse($bst->keyExistIterator(-1, $bst->root));

        // テストケース3: 空の木
        $this->assertFalse($bst->keyExistIterator(1, null));
    }

    public function testSearch()
    {
        // テスト用の二分探索木を作成
        $list = [1, 2, 3, 4, 5];
        $bst = new BinarySearchTree($list);

        // テストケース1: 存在する値
        $this->assertEquals(3, $bst->search(3)->data);
        $this->assertEquals(1, $bst->search(1)->data);
        $this->assertEquals(5, $bst->search(5)->data);

        // テストケース2: 存在しない値
        $this->assertNull($bst->search(0));
        $this->assertNull($bst->search(6));
        $this->assertNull($bst->search(-1));
    }

    public function testSuccessor()
    {
        // テスト用の二分探索木を作成
        $list = [1, 2, 3, 4, 5, 6, 7];
        $bst = new BinarySearchTree($list);

        // テストケース1: 左部分木のノードの後続ノード
        $successor1 = $bst->successor($bst->root, 1);
        $this->assertEquals(2, $successor1->data);

        $successor2 = $bst->successor($bst->root, 2);
        $this->assertEquals(3, $successor2->data);

        // テストケース2: 右部分木のノードの後続ノード
        $successor3 = $bst->successor($bst->root, 5);
        $this->assertEquals(6, $successor3->data);

        $successor4 = $bst->successor($bst->root, 6);
        $this->assertEquals(7, $successor4->data);

        // テストケース3: ルートノードの後続ノード
        $successor5 = $bst->successor($bst->root, 4);
        $this->assertEquals(5, $successor5->data);

        // テストケース4: 葉ノードの後続ノード
        $successor6 = $bst->successor($bst->root, 7);
        $this->assertNull($successor6);

        // テストケース5: 存在しないキーの場合
        $successor7 = $bst->successor($bst->root, 8);
        $this->assertNull($successor7);

        $successor8 = $bst->successor($bst->root, 0);
        $this->assertNull($successor8);

        // テストケース6: 右の子を持たないノードの後続ノード
        $successor9 = $bst->successor($bst->root, 3);
        $this->assertEquals(4, $successor9->data);
    }

    public function testPredecessor()
    {
        // テストケース1: 基本的な二分探索木
        $list = [1, 2, 3, 4, 5, 6, 7];
        $bst = new BinarySearchTree($list);

        // テストケース1: 右部分木のノードの先行ノード
        $predecessor1 = $bst->predecessor($bst->root, 7);
        $this->assertEquals(6, $predecessor1->data);

        $predecessor2 = $bst->predecessor($bst->root, 6);
        $this->assertEquals(5, $predecessor2->data);

        // テストケース2: 左部分木のノードの先行ノード
        $predecessor3 = $bst->predecessor($bst->root, 2);
        $this->assertEquals(1, $predecessor3->data);

        $predecessor4 = $bst->predecessor($bst->root, 3);
        $this->assertEquals(2, $predecessor4->data);

        // テストケース3: ルートノードの先行ノード
        $predecessor5 = $bst->predecessor($bst->root, 4);
        $this->assertEquals(3, $predecessor5->data);

        // テストケース4: 葉ノードの先行ノード
        $predecessor6 = $bst->predecessor($bst->root, 1);
        $this->assertNull($predecessor6);

        // テストケース5: 存在しないキーの場合
        $predecessor7 = $bst->predecessor($bst->root, 8);
        $this->assertNull($predecessor7);

        $predecessor8 = $bst->predecessor($bst->root, 0);
        $this->assertNull($predecessor8);

        // テストケース6: 左の子を持たないノードの先行ノード
        $predecessor9 = $bst->predecessor($bst->root, 5);
        $this->assertEquals(4, $predecessor9->data);

        // テストケース7: 負の数を含む二分探索木
        $list2 = [-300, -279, -238, -189, -181, -158, -148, -147, -116, -88, -67];
        sort($list2);
        $bst2 = new BinarySearchTree($list2);

        // -88の先行ノードは-116
        $predecessor10 = $bst2->predecessor($bst2->root, -88);
        $this->assertEquals(-116, $predecessor10->data);

        // -116の先行ノードは-147
        $predecessor11 = $bst2->predecessor($bst2->root, -116);
        $this->assertEquals(-147, $predecessor11->data);

        // -147の先行ノードは-148
        $predecessor12 = $bst2->predecessor($bst2->root, -147);
        $this->assertEquals(-148, $predecessor12->data);

        // -148の先行ノードは-158
        $predecessor13 = $bst2->predecessor($bst2->root, -148);
        $this->assertEquals(-158, $predecessor13->data);

        // -158の先行ノードは-181
        $predecessor14 = $bst2->predecessor($bst2->root, -158);
        $this->assertEquals(-181, $predecessor14->data);

        // -181の先行ノードは-189
        $predecessor15 = $bst2->predecessor($bst2->root, -181);
        $this->assertEquals(-189, $predecessor15->data);

        // -189の先行ノードは-238
        $predecessor16 = $bst2->predecessor($bst2->root, -189);
        $this->assertEquals(-238, $predecessor16->data);

        // -238の先行ノードは-279
        $predecessor17 = $bst2->predecessor($bst2->root, -238);
        $this->assertEquals(-279, $predecessor17->data);

        // -279の先行ノードは-300
        $predecessor18 = $bst2->predecessor($bst2->root, -279);
        $this->assertEquals(-300, $predecessor18->data);

        // -300の先行ノードはnull（最小値）
        $predecessor19 = $bst2->predecessor($bst2->root, -300);
        $this->assertNull($predecessor19);
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