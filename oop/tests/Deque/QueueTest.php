<?php

declare(strict_types=1);

namespace Tests\Deque;

use App\Models\Deque\DequeImpl;
use App\Models\Deque\Queue;
use PHPUnit\Framework\TestCase;

/**
 * Queue インターフェースの振る舞いをテスト（FIFO動作）
 */
class QueueTest extends TestCase
{
    private Queue $queue;

    protected function setUp(): void
    {
        $this->queue = new DequeImpl();
    }

    /**
     * 空のキューからのpeekFirstはnullを返す
     */
    public function testPeekFirstEmptyQueueReturnsNull(): void
    {
        // Given: 空のキュー

        // When: peekFirstを呼び出す
        $result = $this->queue->peekFirst();

        // Then: nullが返される
        $this->assertNull($result);
    }

    /**
     * 空のキューからのpollはnullを返す
     */
    public function testPollEmptyQueueReturnsNull(): void
    {
        // Given: 空のキュー

        // When: pollを呼び出す
        $result = $this->queue->poll();

        // Then: nullが返される
        $this->assertNull($result);
    }

    /**
     * pushした要素がpeekFirstで取得できる（最初の要素）
     */
    public function testPeekFirstAfterPushReturnsFirstElement(): void
    {
        // Given: 値をpushしたキュー
        $this->queue->push(42);

        // When: peekFirstを呼び出す
        $result = $this->queue->peekFirst();

        // Then: pushした値が返される
        $this->assertEquals(42, $result);
    }

    /**
     * pushした要素がpollで取得できる
     */
    public function testPollAfterPushReturnsAndRemovesFirstElement(): void
    {
        // Given: 値をpushしたキュー
        $this->queue->push(42);

        // When: pollを呼び出す
        $result = $this->queue->poll();

        // Then: pushした値が返される
        $this->assertEquals(42, $result);

        // And: 要素は削除されている
        $this->assertNull($this->queue->peekFirst());
    }

    /**
     * FIFO動作の確認：先に入れた要素が先に出る
     */
    public function testQueueFollowsFIFOOrder(): void
    {
        // Given: 複数の要素をpush
        $this->queue->push(1);
        $this->queue->push(2);
        $this->queue->push(3);

        // When & Then: FIFO順序で取得される
        $this->assertEquals(1, $this->queue->poll()); // 最初にpushした要素
        $this->assertEquals(2, $this->queue->poll());
        $this->assertEquals(3, $this->queue->poll()); // 最後にpushした要素
        $this->assertNull($this->queue->poll()); // 空になった
    }

    /**
     * peekFirstは要素を削除しない
     */
    public function testPeekFirstDoesNotRemoveElement(): void
    {
        // Given: 要素をpush
        $this->queue->push(42);

        // When: 複数回peekFirstを呼び出す
        $first = $this->queue->peekFirst();
        $second = $this->queue->peekFirst();

        // Then: 同じ値が返され、要素は残っている
        $this->assertEquals(42, $first);
        $this->assertEquals(42, $second);
        $this->assertEquals(42, $this->queue->poll()); // まだ存在している
    }

    /**
     * 複数要素でのFIFO動作確認
     */
    public function testQueueMultipleElementsMaintainsFIFOOrder(): void
    {
        // Given: 複数の要素をpush
        $this->queue->push(10);
        $this->queue->push(20);

        // When: 一つ取り出してさらに追加
        $this->assertEquals(10, $this->queue->poll());
        $this->queue->push(30);

        // Then: 正しい順序で取得される
        $this->assertEquals(20, $this->queue->peekFirst());
        $this->assertEquals(20, $this->queue->poll());
        $this->assertEquals(30, $this->queue->poll());
    }
}
