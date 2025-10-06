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
     * コンストラクタが配列からバランスの取れた二分探索木を正しく構築できることをテスト
     */
    public function constructorShouldCreateBalancedBST()
    {
        // 1から7までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);

        // 期待される構造:
        //      4
        //    /   \
        //   2     6
        //  / \   / \
        // 1   3 5   7

        // ルートノードが正しく設定されているか確認
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
     * sortedArrayToBSTメソッドが空の配列を正しく処理できることをテスト
     */
    public function sortedArrayToBSTShouldHandleEmptyArray()
    {
        // 空配列からBSTを構築すると、nullが返されることを確認
        $bst = BinarySearchTree::sortedArrayToBST([]);
        $this->assertNull($bst);
    }

    /**
     * @test
     * sortedArrayToBSTメソッドが配列からバランスの取れた二分探索木を構築できることをテスト
     */
    public function sortedArrayToBSTShouldCreateBalancedBST()
    {
        // 1から5までの配列からBSTを構築
        $bst = BinarySearchTree::sortedArrayToBST([1, 2, 3, 4, 5]);

        // 期待される構造:
        //      3
        //    /   \
        //   1     4
        //    \     \
        //     2     5

        // ツリー構造が期待通りに構築されているか確認
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
     * 間順走査（中間順）が正しい順序でノードを走査できることをテスト
     */
    public function inOrderWalkShouldReturnCorrectOrder()
    {
        // 1から7までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);
        $root = $this->getPrivateProperty($bst, 'root');

        // 間順走査（左→根→右）の結果が期待通りであることを確認
        $result = [];
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7], $bst->inOrderWalk($root, $result));
    }

    /**
     * @test
     * 前順走査（先行順）が正しい順序でノードを走査できることをテスト
     */
    public function preOrderWalkShouldReturnCorrectOrder()
    {
        // 1から7までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);
        $root = $this->getPrivateProperty($bst, 'root');

        // 前順走査（根→左→右）の結果が期待通りであることを確認
        $this->assertEquals([4, 2, 1, 3, 6, 5, 7], $bst->preOrderWalk($root));
    }

    /**
     * @test
     * 後順走査（後行順）が正しい順序でノードを走査できることをテスト
     */
    public function postOrderWalkShouldReturnCorrectOrder()
    {
        // 1から7までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);
        $root = $this->getPrivateProperty($bst, 'root');

        // 後順走査（左→右→根）の結果が期待通りであることを確認
        $this->assertEquals([1, 3, 2, 5, 7, 6, 4], $bst->postOrderWalk($root));
    }

    /**
     * @test
     * 逆間順走査が正しい順序でノードを走査できることをテスト
     */
    public function reverseInOrderWalkShouldReturnCorrectOrder()
    {
        // 1から7までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);
        $root = $this->getPrivateProperty($bst, 'root');

        // 逆間順走査（右→根→左）の結果が期待通りであることを確認（降順になる）
        $this->assertEquals([7, 6, 5, 4, 3, 2, 1], $bst->reverseInOrderWalk($root));
    }

    /**
     * @test
     * keyExistsメソッドが存在するキーに対して正しくtrueを返すことをテスト
     */
    public function keyExistsShouldReturnTrueForExistingKey()
    {
        // 1から5までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        // 存在するキーに対してtrueが返されることを確認
        $this->assertTrue($bst->keyExists(1));
        $this->assertTrue($bst->keyExists(3));
        $this->assertTrue($bst->keyExists(5));
    }

    /**
     * @test
     * keyExistsメソッドが存在しないキーに対して正しくfalseを返すことをテスト
     */
    public function keyExistsShouldReturnFalseForNonExistingKey()
    {
        // 1から5までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        // 存在しないキーに対してfalseが返されることを確認
        $this->assertFalse($bst->keyExists(0));
        $this->assertFalse($bst->keyExists(6));
    }

    /**
     * @test
     * searchメソッドが存在するキーに対して正しくノードを返すことをテスト
     */
    public function searchShouldReturnNodeForExistingKey()
    {
        // 1から5までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        // 存在するキーに対して正しいノードが返されることを確認
        $node = $bst->search(3);
        $this->assertInstanceOf(BinaryTree::class, $node);
        $this->assertEquals(3, $node->getData());
    }

    /**
     * @test
     * searchメソッドが存在しないキーに対して正しくnullを返すことをテスト
     */
    public function searchShouldReturnNullForNonExistingKey()
    {
        // 1から5までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5]);

        // 存在しないキーに対してnullが返されることを確認
        $this->assertNull($bst->search(0));
        $this->assertNull($bst->search(6));
    }

    /**
     * @test
     * insertメソッドが新しいノードを正しい位置に追加できることをテスト
     */
    public function insertShouldAddNewNodeAtCorrectPosition()
    {
        // 2, 4, 6の配列からBSTを構築
        $bst = new BinarySearchTree([2, 4, 6]);

        // 3を挿入 (4の左子の右子になるはず)
        $bst->insert(3);

        // ツリー構造を確認
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
     * insertメソッドが既存のノードを重複して追加しないことをテスト
     */
    public function insertShouldNotDuplicateExistingNodes()
    {
        // 1, 2, 3の配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3]);

        // 既存の値(2)を挿入
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
     * countNodesメソッドがノードの数を正しく数えることをテスト
     */
    public function countNodesShouldReturnCorrectCount()
    {
        // 1から7までの配列からBSTを構築
        $bst = new BinarySearchTree([1, 2, 3, 4, 5, 6, 7]);
        $root = $this->getPrivateProperty($bst, 'root');

        // 全体のノード数が7であることを確認
        $this->assertEquals(7, $bst->countNodes($root));

        // 部分木のノード数も確認
        $this->assertEquals(3, $bst->countNodes($root->getLeft()));
        $this->assertEquals(3, $bst->countNodes($root->getRight()));
    }

    /**
     * @test
     * countNodesメソッドがnullに対して0を返すことをテスト
     */
    public function countNodesShouldReturnZeroForNull()
    {
        // 任意のBSTを構築
        $bst = new BinarySearchTree([1, 2, 3]);

        // nullに対してカウント0が返されることを確認
        $this->assertEquals(0, $bst->countNodes(null));
    }

    /**
     * @test
     * allElementsSortedメソッドが2つの木のノードを正しく統合できることをテスト
     */
    public function allElementsSortedShouldCombineTwoTrees()
    {
        // 2つのBSTを作成
        $bst1 = new BinarySearchTree([1, 2, 5]);
        $bst2 = new BinarySearchTree([3, 4, 6]);

        // ルートノードを取得
        $root1 = $this->getPrivateProperty($bst1, 'root');
        $root2 = $this->getPrivateProperty($bst2, 'root');

        // 統合した結果が昇順で正しいことを確認
        $this->assertEquals([1, 2, 3, 4, 5, 6], $bst1->allElementsSorted($root1, $root2));
    }

    /**
     * @test
     * allElementsSortedメソッドがnullツリーを正しく処理できることをテスト
     */
    public function allElementsSortedShouldHandleNullTrees()
    {
        // 任意のBSTを構築
        $bst = new BinarySearchTree([1, 2, 3]);
        $root = $this->getPrivateProperty($bst, 'root');

        // 片方がnullの場合、もう片方のツリーの要素だけが返されることを確認
        $this->assertEquals([1, 2, 3], $bst->allElementsSorted($root, null));
        $this->assertEquals([1, 2, 3], $bst->allElementsSorted(null, $root));

        // 両方がnullの場合、空配列が返されることを確認
        $this->assertEquals([], $bst->allElementsSorted(null, null));
    }

    /**
     * プライベートプロパティへのアクセスヘルパー
     * ReflectionAPIを使用してプライベートプロパティにアクセスする
     *
     * @param object $object アクセス対象のオブジェクト
     * @param string $propertyName アクセスするプロパティ名
     * @return mixed プロパティの値
     */
    private function getPrivateProperty($object, $propertyName)
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
}
