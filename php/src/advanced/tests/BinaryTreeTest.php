<?php

use Advanced\BinaryTree\BinaryTree;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BinaryTree/BinaryTree.php';

// php/src/vendor/bin/phpunit --testdox php/src/advanced/tests/BinaryTreeTest.php

class BinaryTreeTest extends TestCase
{
    /**
     * @test
     * コンストラクタが値と子ノードを正しく初期化できることをテスト
     */
    public function constructorShouldInitializeWithCorrectValues()
    {
        // 子ノードを持たない単一ノードの作成と検証
        $tree = new BinaryTree(10);
        $this->assertEquals(10, $tree->getData());
        $this->assertNull($tree->getLeft());
        $this->assertNull($tree->getRight());

        // 子ノードを持つノードの作成と検証
        $leftChild = new BinaryTree(5);
        $rightChild = new BinaryTree(15);
        $parentTree = new BinaryTree(10, $leftChild, $rightChild);

        $this->assertEquals(10, $parentTree->getData());
        $this->assertSame($leftChild, $parentTree->getLeft());
        $this->assertSame($rightChild, $parentTree->getRight());
    }

    /**
     * @test
     * getterとsetterメソッドが正しく動作することをテスト
     */
    public function gettersAndSettersShouldWorkCorrectly()
    {
        // 初期ノードの作成
        $tree = new BinaryTree(10);

        // データの変更と確認
        $tree->setData(20);
        $this->assertEquals(20, $tree->getData());

        // 左子ノードの設定と確認
        $leftChild = new BinaryTree(5);
        $tree->setLeft($leftChild);
        $this->assertSame($leftChild, $tree->getLeft());

        // 右子ノードの設定と確認
        $rightChild = new BinaryTree(25);
        $tree->setRight($rightChild);
        $this->assertSame($rightChild, $tree->getRight());

        // 子ノードをnullに設定して確認
        $tree->setLeft(null);
        $this->assertNull($tree->getLeft());

        $tree->setRight(null);
        $this->assertNull($tree->getRight());
    }
}
