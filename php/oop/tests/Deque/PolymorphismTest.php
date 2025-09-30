<?php

declare(strict_types=1);

namespace Tests\Deque;

use App\Models\Deque\AbstractListInteger;
use App\Models\Deque\Deque;
use App\Models\Deque\IntegerLinkedList;
use App\Models\Deque\PrintFunctions;
use App\Models\Deque\Queue;
use App\Models\Deque\Stack;
use PHPUnit\Framework\TestCase;

/**
 * ポリモーフィズムのテスト
 *
 * 同一のIntegerLinkedListインスタンスを異なるインターフェース型として扱い、
 * それぞれの契約に従った操作が正常に動作することを確認します。
 */
class PolymorphismTest extends TestCase
{
    /**
     * 単一インスタンスでのポリモーフィズムテスト
     */
    public function testPolymorphismWithSingleInstance(): void
    {
        // 単一のIntegerLinkedListインスタンスを作成
        $instance = new IntegerLinkedList();

        // 異なる型として同じインスタンスを参照
        $stack = $instance;        // Stack型として扱う
        $queue = $instance;        // Queue型として扱う
        $deque = $instance;        // Deque型として扱う
        $abstractList = $instance; // AbstractListInteger型として扱う

        // 要素を追加（Deque操作を使用）
        $deque->addFirst(1);  // [1]
        $deque->push(2);      // [1, 2]
        $deque->addFirst(0);  // [0, 1, 2]
        $deque->push(3);      // [0, 1, 2, 3]

        // 各インターフェースから同じデータが見えることを確認
        $this->assertEquals(3, $stack->peekLast());      // Stack視点：最後の要素
        $this->assertEquals(0, $queue->peekFirst());     // Queue視点：最初の要素
        $this->assertEquals(0, $deque->peekFirst());     // Deque視点：最初の要素
        $this->assertEquals(4, $abstractList->getSize()); // AbstractList視点：要素数

        // 配列表現での確認
        $this->assertEquals([0, 1, 2, 3], $abstractList->toArray());
    }

    /**
     * Print関数群を使ったポリモーフィズムのテスト
     */
    public function testPolymorphismWithPrintFunctions(): void
    {
        // 複数のインスタンスを作成して、各Print関数でテスト

        // Queue として使用
        $queueInstance = new IntegerLinkedList();
        $queueInstance->push(1);
        $queueInstance->push(2);
        $queueInstance->push(3);

        ob_start();
        $queueResult = PrintFunctions::queuePrint($queueInstance);
        ob_get_clean();
        $this->assertEquals('Queue (FIFO): 1 2 3', $queueResult);

        // Stack として使用
        $stackInstance = new IntegerLinkedList();
        $stackInstance->push(1);
        $stackInstance->push(2);
        $stackInstance->push(3);

        ob_start();
        $stackResult = PrintFunctions::stackPrint($stackInstance);
        ob_get_clean();
        $this->assertEquals('Stack (LIFO): 3 2 1', $stackResult);

        // Deque として使用
        $dequeInstance = new IntegerLinkedList();
        $dequeInstance->push(1);
        $dequeInstance->push(2);
        $dequeInstance->push(3);
        $dequeInstance->push(4);

        ob_start();
        $dequeResult = PrintFunctions::dequePrint($dequeInstance);
        ob_get_clean();
        $this->assertEquals('Deque (alternating): 1 4 2 3', $dequeResult);

        // AbstractListInteger として使用
        $listInstance = new IntegerLinkedList();
        $listInstance->push(1);
        $listInstance->push(2);
        $listInstance->push(3);

        ob_start();
        $listResult = PrintFunctions::abstractListIntegerPrint($listInstance);
        ob_get_clean();
        $this->assertEquals('AbstractList: [1, 2, 3]', $listResult);
    }

    /**
     * インターフェース型でのメソッド呼び出しテスト
     */
    public function testInterfaceMethodCalls(): void
    {
        $instance = new IntegerLinkedList();

        // Stack インターフェースとしての操作
        $this->performStackOperations($instance);

        // 新しいインスタンスでQueue操作
        $instance2 = new IntegerLinkedList();
        $this->performQueueOperations($instance2);

        // 新しいインスタンスでDeque操作
        $instance3 = new IntegerLinkedList();
        $this->performDequeOperations($instance3);

        // 新しいインスタンスでAbstractListInteger操作
        $instance4 = new IntegerLinkedList();
        $this->performAbstractListOperations($instance4);
    }

    /**
     * Stack操作のヘルパーメソッド
     */
    private function performStackOperations(Stack $stack): void
    {
        $stack->push(10);
        $stack->push(20);
        $stack->push(30);

        $this->assertEquals(30, $stack->peekLast());
        $this->assertEquals(30, $stack->pop());
        $this->assertEquals(20, $stack->pop());
        $this->assertEquals(10, $stack->pop());
        $this->assertNull($stack->pop());
    }

    /**
     * Queue操作のヘルパーメソッド
     */
    private function performQueueOperations(Queue $queue): void
    {
        $queue->push(100);
        $queue->push(200);
        $queue->push(300);

        $this->assertEquals(100, $queue->peekFirst());
        $this->assertEquals(100, $queue->poll());
        $this->assertEquals(200, $queue->poll());
        $this->assertEquals(300, $queue->poll());
        $this->assertNull($queue->poll());
    }

    /**
     * Deque操作のヘルパーメソッド
     */
    private function performDequeOperations(Deque $deque): void
    {
        $deque->addFirst(2);    // [2]
        $deque->push(3);        // [2, 3]
        $deque->addFirst(1);    // [1, 2, 3]
        $deque->push(4);        // [1, 2, 3, 4]

        $this->assertEquals(1, $deque->peekFirst());
        $this->assertEquals(4, $deque->peekLast());
        $this->assertEquals(1, $deque->poll());  // [2, 3, 4]
        $this->assertEquals(4, $deque->pop());   // [2, 3]
        $this->assertEquals(2, $deque->peekFirst());
        $this->assertEquals(3, $deque->peekLast());
    }

    /**
     * AbstractListInteger操作のヘルパーメソッド
     */
    private function performAbstractListOperations(AbstractListInteger $list): void
    {
        // IntegerLinkedListのpushメソッドを使うため、元の型にキャスト
        if ($list instanceof IntegerLinkedList) {
            $list->push(5);
            $list->push(10);
            $list->push(15);
        }

        $this->assertEquals(3, $list->getSize());
        $this->assertFalse($list->isEmpty());
        $this->assertEquals(5, $list->get(0));
        $this->assertEquals(10, $list->get(1));
        $this->assertEquals(15, $list->get(2));
        $this->assertEquals([5, 10, 15], $list->toArray());
    }

    /**
     * 型の安全性テスト
     */
    public function testTypeSafety(): void
    {
        $instance = new IntegerLinkedList();

        // インターフェース型での確認
        $this->assertInstanceOf(Stack::class, $instance);
        $this->assertInstanceOf(Queue::class, $instance);
        $this->assertInstanceOf(Deque::class, $instance);
        $this->assertInstanceOf(AbstractListInteger::class, $instance);
        $this->assertInstanceOf(IntegerLinkedList::class, $instance);
    }

    /**
     * 統合シナリオテスト
     */
    public function testIntegratedScenario(): void
    {
        // 実際の使用シナリオを想定したテスト
        $dataStructure = new IntegerLinkedList();

        // AbstractListIntegerとして初期化
        $abstractList = $dataStructure;
        $this->assertTrue($abstractList->isEmpty());

        // Dequeとして要素追加
        $deque = $dataStructure;
        $deque->addFirst(2);
        $deque->push(4);
        $deque->addFirst(1);
        $deque->push(5);
        // 結果: [1, 2, 4, 5]

        // AbstractListIntegerとして状態確認
        $this->assertEquals(4, $abstractList->getSize());
        $this->assertEquals([1, 2, 4, 5], $abstractList->toArray());

        // Stackとして一部取り出し
        $stack = $dataStructure;
        $this->assertEquals(5, $stack->pop()); // [1, 2, 4]

        // Queueとして一部取り出し
        $queue = $dataStructure;
        $this->assertEquals(1, $queue->poll()); // [2, 4]

        // 最終状態確認
        $this->assertEquals(2, $abstractList->getSize());
        $this->assertEquals([2, 4], $abstractList->toArray());
    }
}
