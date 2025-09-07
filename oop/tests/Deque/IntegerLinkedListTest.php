<?php

declare(strict_types=1);

namespace Tests\Deque;

use App\Models\Deque\IntegerLinkedList;
use PHPUnit\Framework\TestCase;

/**
 * IntegerLinkedList クラスのテスト
 */
class IntegerLinkedListTest extends TestCase
{
    private IntegerLinkedList $list;

    protected function setUp(): void
    {
        $this->list = new IntegerLinkedList();
    }

    /**
     * 初期状態のテスト
     */
    public function testInitialState(): void
    {
        $this->assertTrue($this->list->isEmpty());
        $this->assertEquals(0, $this->list->getSize());
        $this->assertNull($this->list->peekFirst());
        $this->assertNull($this->list->peekLast());
        $this->assertEquals([], $this->list->toArray());
    }

    /**
     * AbstractListInteger インターフェースのテスト
     */
    public function testAbstractListIntegerInterface(): void
    {
        // 要素を追加
        $this->list->push(1);
        $this->list->push(2);
        $this->list->push(3);

        // サイズ確認
        $this->assertEquals(3, $this->list->getSize());
        $this->assertFalse($this->list->isEmpty());

        // インデックスアクセス
        $this->assertEquals(1, $this->list->get(0));
        $this->assertEquals(2, $this->list->get(1));
        $this->assertEquals(3, $this->list->get(2));
        $this->assertNull($this->list->get(-1));
        $this->assertNull($this->list->get(3));

        // 配列変換
        $this->assertEquals([1, 2, 3], $this->list->toArray());
    }

    /**
     * Stack動作のテスト（LIFO）
     */
    public function testStackBehavior(): void
    {
        // 要素をpush
        $this->list->push(1);
        $this->list->push(2);
        $this->list->push(3);

        // LIFO順序でpop
        $this->assertEquals(3, $this->list->pop());
        $this->assertEquals(2, $this->list->pop());
        $this->assertEquals(1, $this->list->pop());
        $this->assertNull($this->list->pop());
    }

    /**
     * Queue動作のテスト（FIFO）
     */
    public function testQueueBehavior(): void
    {
        // 要素をpush
        $this->list->push(1);
        $this->list->push(2);
        $this->list->push(3);

        // FIFO順序でpoll
        $this->assertEquals(1, $this->list->poll());
        $this->assertEquals(2, $this->list->poll());
        $this->assertEquals(3, $this->list->poll());
        $this->assertNull($this->list->poll());
    }

    /**
     * Deque動作のテスト（両端操作）
     */
    public function testDequeBehavior(): void
    {
        // 両端に要素を追加
        $this->list->push(2);        // [2]
        $this->list->addFirst(1);    // [1, 2]
        $this->list->push(3);        // [1, 2, 3]
        $this->list->addFirst(0);    // [0, 1, 2, 3]

        // 状態確認
        $this->assertEquals(0, $this->list->peekFirst());
        $this->assertEquals(3, $this->list->peekLast());
        $this->assertEquals([0, 1, 2, 3], $this->list->toArray());

        // 両端から取り出し
        $this->assertEquals(0, $this->list->poll());  // [1, 2, 3]
        $this->assertEquals(3, $this->list->pop());   // [1, 2]
        $this->assertEquals(1, $this->list->poll());  // [2]
        $this->assertEquals(2, $this->list->pop());   // []

        $this->assertTrue($this->list->isEmpty());
    }

    /**
     * 単一要素での操作テスト
     */
    public function testSingleElementOperations(): void
    {
        $this->list->push(42);

        // 両端が同じ要素を指す
        $this->assertEquals(42, $this->list->peekFirst());
        $this->assertEquals(42, $this->list->peekLast());
        $this->assertEquals(1, $this->list->getSize());

        // pop操作
        $this->assertEquals(42, $this->list->pop());
        $this->assertTrue($this->list->isEmpty());

        // 再度単一要素追加
        $this->list->addFirst(100);
        $this->assertEquals(100, $this->list->peekFirst());
        $this->assertEquals(100, $this->list->peekLast());

        // poll操作
        $this->assertEquals(100, $this->list->poll());
        $this->assertTrue($this->list->isEmpty());
    }

    /**
     * 複雑な操作シーケンステスト
     */
    public function testComplexOperationSequence(): void
    {
        // 複雑な操作シーケンス
        $this->list->addFirst(10);     // [10]
        $this->list->push(20);         // [10, 20]
        $this->list->addFirst(5);      // [5, 10, 20]
        $this->list->push(30);         // [5, 10, 20, 30]
        $this->list->addFirst(1);      // [1, 5, 10, 20, 30]

        // 期待される配列
        $expected = [1, 5, 10, 20, 30];
        $this->assertEquals($expected, $this->list->toArray());
        $this->assertEquals(5, $this->list->getSize());

        // インデックスアクセステスト
        $this->assertEquals(1, $this->list->get(0));
        $this->assertEquals(5, $this->list->get(1));
        $this->assertEquals(10, $this->list->get(2));
        $this->assertEquals(20, $this->list->get(3));
        $this->assertEquals(30, $this->list->get(4));

        // 混合操作
        $this->assertEquals(1, $this->list->poll());   // [5, 10, 20, 30]
        $this->assertEquals(30, $this->list->pop());   // [5, 10, 20]
        $this->assertEquals([5, 10, 20], $this->list->toArray());
    }

    /**
     * peek操作が非破壊的であることのテスト
     */
    public function testPeekIsNonDestructive(): void
    {
        $this->list->push(1);
        $this->list->push(2);
        $this->list->push(3);

        // 複数回peek
        $this->assertEquals(1, $this->list->peekFirst());
        $this->assertEquals(1, $this->list->peekFirst());
        $this->assertEquals(3, $this->list->peekLast());
        $this->assertEquals(3, $this->list->peekLast());

        // 要素は変化していない
        $this->assertEquals([1, 2, 3], $this->list->toArray());
        $this->assertEquals(3, $this->list->getSize());
    }
}
