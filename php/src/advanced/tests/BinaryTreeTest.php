<?php

use Advanced\BinaryTree\BinaryTree;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BinaryTree/BinaryTree.php';

// php/src/vendor/bin/phpunit --testdox php/src/advanced/tests/BinaryTreeTest.php

class BinaryTreeTest extends TestCase
{
    /**
     * @test
     */
    public function constructorShouldInitializeWithCorrectValues()
    {
        $tree = new BinaryTree(10);
        $this->assertEquals(10, $tree->getData());
        $this->assertNull($tree->getLeft());
        $this->assertNull($tree->getRight());

        $leftChild = new BinaryTree(5);
        $rightChild = new BinaryTree(15);
        $parentTree = new BinaryTree(10, $leftChild, $rightChild);

        $this->assertEquals(10, $parentTree->getData());
        $this->assertSame($leftChild, $parentTree->getLeft());
        $this->assertSame($rightChild, $parentTree->getRight());
    }

    /**
     * @test
     */
    public function gettersAndSettersShouldWorkCorrectly()
    {
        $tree = new BinaryTree(10);

        $tree->setData(20);
        $this->assertEquals(20, $tree->getData());

        $leftChild = new BinaryTree(5);
        $tree->setLeft($leftChild);
        $this->assertSame($leftChild, $tree->getLeft());

        $rightChild = new BinaryTree(25);
        $tree->setRight($rightChild);
        $this->assertSame($rightChild, $tree->getRight());

        $tree->setLeft(null);
        $this->assertNull($tree->getLeft());

        $tree->setRight(null);
        $this->assertNull($tree->getRight());
    }

    /**
     * @test
     */
    public function inOrderWalkShouldOutputCorrectOrder()
    {
        $tree = $this->createTestTree();

        ob_start();
        $tree->printInOrder();
        $output = ob_get_clean();

        $this->assertEquals("1 2 3 4 5 6 7 \n", $output);
    }

    /**
     * @test
     */
    public function preOrderWalkShouldOutputCorrectOrder()
    {
        $tree = $this->createTestTree();

        ob_start();
        $tree->printPreOrder();
        $output = ob_get_clean();

        $this->assertEquals("4 2 1 3 6 5 7 \n", $output);
    }

    /**
     * @test
     */
    public function postOrderWalkShouldOutputCorrectOrder()
    {
        $tree = $this->createTestTree();

        ob_start();
        $tree->printPostOrder();
        $output = ob_get_clean();

        $this->assertEquals("1 3 2 5 7 6 4 \n", $output);
    }

    /**
     * @test
     */
    public function reverseInOrderWalkShouldOutputCorrectOrder()
    {
        $tree = $this->createTestTree();

        ob_start();
        $tree->printReverseInOrder();
        $output = ob_get_clean();

        $this->assertEquals("7 6 5 4 3 2 1 \n", $output);
    }

    /**
     * 以下のようなテスト用の二分木を作成
     *      4
     *    /   \
     *   2     6
     *  / \   / \
     * 1   3 5   7
     */
    private function createTestTree(): BinaryTree
    {
        $node1 = new BinaryTree(1);
        $node3 = new BinaryTree(3);
        $node5 = new BinaryTree(5);
        $node7 = new BinaryTree(7);

        $node2 = new BinaryTree(2, $node1, $node3);
        $node6 = new BinaryTree(6, $node5, $node7);

        return new BinaryTree(4, $node2, $node6);
    }
}
