<?php

declare(strict_types=1);

namespace Tests\Deque;

use App\Models\Deque\DequeImpl;
use App\Models\Deque\Stack;
use PHPUnit\Framework\TestCase;

/**
 * Stack インターフェースの振る舞いをテスト（LIFO動作）
 */
class StackTest extends TestCase
{
    private Stack $stack;

    protected function setUp(): void
    {
        $this->stack = new DequeImpl();
    }

    /**
     * 空のスタックからのpeekLastはnullを返す
     */
    public function testPeekLastEmptyStackReturnsNull(): void
    {
        // Given: 空のスタック

        // When: peekLastを呼び出す
        $result = $this->stack->peekLast();

        // Then: nullが返される
        $this->assertNull($result);
    }

    /**
     * 空のスタックからのpopはnullを返す
     */
    public function testPopEmptyStackReturnsNull(): void
    {
        // Given: 空のスタック

        // When: popを呼び出す
        $result = $this->stack->pop();

        // Then: nullが返される
        $this->assertNull($result);
    }

    /**
     * pushした要素がpeekLastで取得できる
     */
    public function testPeekLastAfterPushReturnsLastElement(): void
    {
        // Given: 値をpushしたスタック
        $this->stack->push(42);

        // When: peekLastを呼び出す
        $result = $this->stack->peekLast();

        // Then: pushした値が返される
        $this->assertEquals(42, $result);
    }

    /**
     * pushした要素がpopで取得できる
     */
    public function testPopAfterPushReturnsAndRemovesLastElement(): void
    {
        // Given: 値をpushしたスタック
        $this->stack->push(42);

        // When: popを呼び出す
        $result = $this->stack->pop();

        // Then: pushした値が返される
        $this->assertEquals(42, $result);

        // And: 要素は削除されている
        $this->assertNull($this->stack->peekLast());
    }

    /**
     * LIFO動作の確認：後に入れた要素が先に出る
     */
    public function testStackFollowsLIFOOrder(): void
    {
        // Given: 複数の要素をpush
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);

        // When & Then: LIFO順序で取得される
        $this->assertEquals(3, $this->stack->pop()); // 最後にpushした要素
        $this->assertEquals(2, $this->stack->pop());
        $this->assertEquals(1, $this->stack->pop()); // 最初にpushした要素
        $this->assertNull($this->stack->pop()); // 空になった
    }

    /**
     * peekLastは要素を削除しない
     */
    public function testPeekLastDoesNotRemoveElement(): void
    {
        // Given: 要素をpush
        $this->stack->push(42);

        // When: 複数回peekLastを呼び出す
        $first = $this->stack->peekLast();
        $second = $this->stack->peekLast();

        // Then: 同じ値が返され、要素は残っている
        $this->assertEquals(42, $first);
        $this->assertEquals(42, $second);
        $this->assertEquals(42, $this->stack->pop()); // まだ存在している
    }
}
