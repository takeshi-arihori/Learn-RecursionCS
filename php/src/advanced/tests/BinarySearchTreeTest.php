<?php

use Advanced\BinaryTree\BinarySearchTree;
use Advanced\BinaryTree\BinaryTree;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BinaryTree/BinaryTree.php';
require_once __DIR__ . '/../BinaryTree/BinarySearchTree.php';

// php/src/vendor/bin/phpunit --testdox php/src/advanced/tests/BinarySearchTreeTest.php

class BinarySearchTreeTest extends TestCase
{
    /**
     * @test
     */
    public function constructorShouldCreateBalancedBST()
    {
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);

        // 期待される構造:
        //      4
        //    /   \
        //   2     6
        //  / \   / \
        // 1   3 5   7

        // ルートが正しく設定されているか確認
        $root = $this->getPrivateProperty($bst, 'root');
        $this->assertEquals(4, $root->getData());

        // 左サブツリーが正しく設定されているか確認
        $left = $root->getLeft();
        $this->assertEquals(2, $left->getData());
        $this->assertEquals(1, $left->getLeft()->getData());
        $this->assertEquals(3, $left->getRight()->getData());

        // 右サブツリーが正しく設定されているか確認
        $right = $root->getRight();
        $this->assertEquals(6, $right->getData());
        $this->assertEquals(5, $right->getLeft()->getData());
        $this->assertEquals(7, $right->getRight()->getData());
    }

    /**
     * @test
     */
    public function sortedArrayToBSTShouldHandleEmptyArray()
    {
        $bst = BinarySearchTree::sortedArrayToBST([]);
        $this->assertNull($bst);
    }

    /**
     * @test
     */
    public function sortedArrayToBSTShouldCreateBalancedBST()
    {
        $bst = BinarySearchTree::sortedArrayToBST([1, 2, 3, 4, 5]);

        // 期待される構造:
        //      3
        //    /   \
        //   1     4
        //    \     \
        //     2     5

        $this->assertEquals(3, $bst->getData());
        $this->assertEquals(1, $bst->getLeft()->getData());
        $this->assertNull($bst->getLeft()->getLeft());
        $this->assertEquals(2, $bst->getLeft()->getRight()->getData());
        $this->assertEquals(4, $bst->getRight()->getData());
        $this->assertNull($bst->getRight()->getLeft());
        $this->assertEquals(5, $bst->getRight()->getRight()->getData());
    }

    /**
     * @test
     */
    public function keyExistsShouldReturnTrueForExistingKey()
    {
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        $this->assertTrue($bst->keyExists(1));
        $this->assertTrue($bst->keyExists(3));
        $this->assertTrue($bst->keyExists(5));
    }

    /**
     * @test
     */
    public function keyExistsShouldReturnFalseForNonExistingKey()
    {
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        $this->assertFalse($bst->keyExists(0));
        $this->assertFalse($bst->keyExists(6));
    }

    /**
     * @test
     */
    public function searchShouldReturnNodeForExistingKey()
    {
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        $node = $bst->search(3);
        $this->assertInstanceOf(BinaryTree::class, $node);
        $this->assertEquals(3, $node->getData());
    }

    /**
     * @test
     */
    public function searchShouldReturnNullForNonExistingKey()
    {
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        $this->assertNull($bst->search(0));
        $this->assertNull($bst->search(6));
    }

    /**
     * @test
     */
    public function insertShouldAddNewNodeAtCorrectPosition()
    {
        $bst = new BinarySearchTree([2, 4, 6]);

        // 3を挿入 (4の左子になるはず)
        $bst->insert(3);

        $root = $this->getPrivateProperty($bst, 'root');
        $this->assertEquals(4, $root->getData());
        $this->assertEquals(2, $root->getLeft()->getData());
        $this->assertEquals(6, $root->getRight()->getData());
        $this->assertEquals(3, $root->getLeft()->getRight()->getData());

        // 1を挿入 (2の左子になるはず)
        $bst->insert(1);
        $this->assertEquals(1, $root->getLeft()->getLeft()->getData());

        // 5を挿入 (6の左子になるはず)
        $bst->insert(5);
        $this->assertEquals(5, $root->getRight()->getLeft()->getData());
    }

    /**
     * @test
     */
    public function insertShouldNotDuplicateExistingNodes()
    {
        $bst = new BinarySearchTree([1, 2, 3]);

        // 既存の値を挿入
        $bst->insert(2);

        // 構造が変わっていないことを確認
        $root = $this->getPrivateProperty($bst, 'root');
        $this->assertEquals(2, $root->getData());
        $this->assertEquals(1, $root->getLeft()->getData());
        $this->assertEquals(3, $root->getRight()->getData());
        $this->assertNull($root->getLeft()->getLeft());
        $this->assertNull($root->getLeft()->getRight());
        $this->assertNull($root->getRight()->getLeft());
        $this->assertNull($root->getRight()->getRight());
    }

    /**
     * @test
     */
    public function countNodesShouldReturnCorrectCount()
    {
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);
        $root = $this->getPrivateProperty($bst, 'root');

        $this->assertEquals(7, $bst->countNodes($root));

        // 部分木のノード数もテスト
        $this->assertEquals(3, $bst->countNodes($root->getLeft()));
        $this->assertEquals(3, $bst->countNodes($root->getRight()));
    }

    /**
     * @test
     */
    public function countNodesShouldReturnZeroForNull()
    {
        $bst = new BinarySearchTree([1, 2, 3]);

        $this->assertEquals(0, $bst->countNodes(null));
    }

    /**
     * プライベートプロパティへのアクセスヘルパー
     */
    private function getPrivateProperty($object, $propertyName)
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
}
