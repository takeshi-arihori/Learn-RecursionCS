<?php

declare(strict_types=1);

namespace Tests\Deque;

use App\Models\Deque\Deque;
use App\Models\Deque\DequeImpl;
use PHPUnit\Framework\TestCase;

/**
 * Deque インターフェースの振る舞いをテスト（両端キュー動作）
 */
class DequeTest extends TestCase
{
    private Deque $deque;

    protected function setUp(): void
    {
        $this->deque = new DequeImpl();
    }

    /**
     * addFirstで先頭に要素を追加できる
     */
    public function testAddFirstAddsElementToFront(): void
    {
        // Given: 空のDeque

        // When: addFirstで要素を追加
        $this->deque->addFirst(42);

        // Then: peekFirstで取得できる
        $this->assertEquals(42, $this->deque->peekFirst());
        $this->assertEquals(42, $this->deque->peekLast());
    }

    /**
     * addFirstとpushの組み合わせテスト
     */
    public function testAddFirstAndPushWorkTogether(): void
    {
        // Given: 要素をpush
        $this->deque->push(2);

        // When: addFirstで先頭に追加
        $this->deque->addFirst(1);

        // Then: 正しい順序で要素が配置される
        $this->assertEquals(1, $this->deque->peekFirst());
        $this->assertEquals(2, $this->deque->peekLast());
    }

    /**
     * Dequeの両端操作の完全テスト
     */
    public function testDequeBothEndsOperations(): void
    {
        // Given: 複数の要素を両端から追加
        $this->deque->push(3);        // [3]
        $this->deque->addFirst(2);    // [2, 3]
        $this->deque->addFirst(1);    // [1, 2, 3]
        $this->deque->push(4);        // [1, 2, 3, 4]

        // When & Then: 両端から取得できる
        $this->assertEquals(1, $this->deque->peekFirst());
        $this->assertEquals(4, $this->deque->peekLast());

        // 前から取得
        $this->assertEquals(1, $this->deque->poll());  // [2, 3, 4]
        $this->assertEquals(2, $this->deque->peekFirst());

        // 後ろから取得
        $this->assertEquals(4, $this->deque->pop());   // [2, 3]
        $this->assertEquals(3, $this->deque->peekLast());
    }

    /**
     * Stackとしての振る舞い（継承確認）
     */
    public function testDequeAsStackWorksCorrectly(): void
    {
        // Given: Stack操作を実行
        $this->deque->push(1);
        $this->deque->push(2);
        $this->deque->push(3);

        // When & Then: LIFO動作
        $this->assertEquals(3, $this->deque->peekLast());
        $this->assertEquals(3, $this->deque->pop());
        $this->assertEquals(2, $this->deque->pop());
        $this->assertEquals(1, $this->deque->pop());
    }

    /**
     * Queueとしての振る舞い（継承確認）
     */
    public function testDequeAsQueueWorksCorrectly(): void
    {
        // Given: Queue操作を実行
        $this->deque->push(1);
        $this->deque->push(2);
        $this->deque->push(3);

        // When & Then: FIFO動作
        $this->assertEquals(1, $this->deque->peekFirst());
        $this->assertEquals(1, $this->deque->poll());
        $this->assertEquals(2, $this->deque->poll());
        $this->assertEquals(3, $this->deque->poll());
    }

    /**
     * 複雑なシナリオ：両端操作とStack/Queue操作の混合
     */
    public function testDequeComplexScenario(): void
    {
        // Given: 複雑な操作シーケンス
        $this->deque->addFirst(10);     // [10]
        $this->deque->push(20);         // [10, 20]
        $this->deque->addFirst(5);      // [5, 10, 20]
        $this->deque->push(30);         // [5, 10, 20, 30]

        // When & Then: 各操作が正しく動作する
        $this->assertEquals(5, $this->deque->peekFirst());   // 最初
        $this->assertEquals(30, $this->deque->peekLast());   // 最後

        // Queue操作（前から）
        $this->assertEquals(5, $this->deque->poll());        // [10, 20, 30]

        // Stack操作（後ろから）
        $this->assertEquals(30, $this->deque->pop());        // [10, 20]

        // 残りの確認
        $this->assertEquals(10, $this->deque->peekFirst());
        $this->assertEquals(20, $this->deque->peekLast());
    }

    /**
     * 単一要素での両端操作
     */
    public function testDequeSingleElementBothEndsPointToSame(): void
    {
        // Given: 単一要素
        $this->deque->addFirst(42);

        // When & Then: 両端が同じ要素を指す
        $this->assertEquals(42, $this->deque->peekFirst());
        $this->assertEquals(42, $this->deque->peekLast());

        // どちらの操作でも同じ要素が取得される
        $this->deque->addFirst(100);  // [100, 42]
        $this->assertEquals(42, $this->deque->pop());    // [100]
        $this->assertEquals(100, $this->deque->poll());  // []

        // 空になる
        $this->assertNull($this->deque->peekFirst());
        $this->assertNull($this->deque->peekLast());
    }
}
