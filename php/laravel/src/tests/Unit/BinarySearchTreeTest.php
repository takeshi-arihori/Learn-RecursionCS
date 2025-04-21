<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase; // Log出力させるため、PHPUnit\Framework\TestCaseではなくTests\TestCaseを使用
use App\Http\Controllers\BinaryTree\BinarySearchTreeController;
use Illuminate\Support\Facades\Log;

// テストコマンド
//  docker compose exec app php artisan test tests/Unit/BinarySearchTreeTest.php

class BinarySearchTreeTest extends TestCase
{
    private BinarySearchTreeController $bst;

    public function setUp(): void
    {
        parent::setUp();

        // Logファサードをモック
        // Log::shouldReceive('channel')
        //     ->andReturnSelf();
        // Log::shouldReceive('info')
        //     ->andReturnNull();
        // Log::shouldReceive('debug')
        //     ->andReturnNull();

        // テストデータ
        $data = [15, 3, 10, 20, 7, 12, 5, 8, 1, 6];
        shuffle($data);
        $this->bst = new BinarySearchTreeController($data);

        //         10
        //        /  \
        //        5    15
        //       / \   / \
        //      3   7 12  20
        //     /   / \
        //    1   6   8

    }
    // searchメソッドのテスト
    public function testSearch()
    {
        // 存在するキーを検索
        $this->assertEquals(10, $this->bst->search(10)->getData());
        $this->assertEquals(5, $this->bst->search(5)->getData());
        $this->assertEquals(15, $this->bst->search(15)->getData());
        $this->assertEquals(3, $this->bst->search(3)->getData());
        $this->assertEquals(7, $this->bst->search(7)->getData());
        $this->assertEquals(12, $this->bst->search(12)->getData());
        $this->assertEquals(20, $this->bst->search(20)->getData());
        $this->assertEquals(1, $this->bst->search(1)->getData());
        $this->assertEquals(6, $this->bst->search(6)->getData());
        $this->assertEquals(8, $this->bst->search(8)->getData());

        // 存在しないキーを検索
        $this->assertNull($this->bst->search(0));
        $this->assertNull($this->bst->search(25));
        $this->assertNull($this->bst->search(-5));
    }

    // insertメソッドのテスト
    public function testInsert()
    {
        // 新しい値を挿入
        $this->bst->insert(9); // 9を挿入
        $this->bst->insert(13); // 13を挿入
        $this->bst->insert(21); // 21を挿入

        // 挿入後の検証
        $this->assertEquals(9, $this->bst->search(9)->getData(), "9 should exist in the tree.");
        $this->assertEquals(13, $this->bst->search(13)->getData(), "13 should exist in the tree.");
        $this->assertEquals(21, $this->bst->search(21)->getData(), "21 should exist in the tree.");

        // 既存の値を挿入しようとした場合（重複値の扱いを確認）
        $this->bst->insert(10); // 10は既に存在
        $this->assertEquals(10, $this->bst->search(10)->getData(), "10 should still exist in the tree.");

        // 存在しない値の検証
        $this->assertNull($this->bst->search(30), "30 should not exist in the tree.");
    }
}
