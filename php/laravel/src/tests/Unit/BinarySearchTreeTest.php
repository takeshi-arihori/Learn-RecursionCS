<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\BinaryTree\BinarySearchTreeController;

class BinarySearchTreeTest extends TestCase
{
    public function testSearch()
    {
        // テストデータ
        $data = [10, 5, 15, 3, 7, 12, 20, 1, 6, 8];
        $bst = new BinarySearchTreeController($data);

        //         10
        //        /  \
        //        5    15
        //       / \   / \
        //      3   7 12  20
        //     /   / \
        //    1   6   8

        // 存在するキーを検索
        $this->assertEquals(10, $bst->search(10)->getData());
        $this->assertEquals(5, $bst->search(5)->getData());
        $this->assertEquals(15, $bst->search(15)->getData());
        $this->assertEquals(3, $bst->search(3)->getData());
        $this->assertEquals(7, $bst->search(7)->getData());
        $this->assertEquals(12, $bst->search(12)->getData());
        $this->assertEquals(20, $bst->search(20)->getData());
        $this->assertEquals(1, $bst->search(1)->getData());
        $this->assertEquals(6, $bst->search(6)->getData());
        $this->assertEquals(8, $bst->search(8)->getData());

        // 存在しないキーを検索
        $this->assertNull($bst->search(0));
        $this->assertNull($bst->search(25));
        $this->assertNull($bst->search(-5));
    }
}
