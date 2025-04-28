<?php

use Advanced\DepthFirstTraversal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../DepthFirstTraversal.php';

// ./php/src/vendor/bin/phpunit --testdox php/src/advanced/tests/DepthFirstTraversalTest.php

class DepthFirstTraversalTest extends TestCase
{
    public function testGenerateRandomBST(): void
    {
        $list = [10, 20, 5, 15, 25];
        $dfs = new DepthFirstTraversal($list);

        $this->assertNotNull($dfs); // インスタンスが生成されていることを確認
    }

    public function testMaximumDepth(): void
    {
        $root = new \Advanced\BinaryTree(10);
        $root->left = new \Advanced\BinaryTree(5);
        $root->right = new \Advanced\BinaryTree(15);
        $root->left->left = new \Advanced\BinaryTree(3);
        $root->left->right = new \Advanced\BinaryTree(7);

        $depth = DepthFirstTraversal::maximumDepth($root);
        $this->assertEquals(2, $depth); // 最大深度が正しいことを確認
    }

    public function testPrintSorted(): void
    {
        $list = [10, 20, 5, 15, 25];
        $dfs = new DepthFirstTraversal($list);

        ob_start();
        $dfs->printSorted();
        $output = ob_get_clean();

        // 出力が昇順であることを確認
        $this->assertEquals("5 10 15 20 25 \n", $output);
    }
}
