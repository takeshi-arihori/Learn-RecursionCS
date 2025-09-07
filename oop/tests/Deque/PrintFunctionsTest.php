<?php

declare(strict_types=1);

namespace Tests\Deque;

use App\Models\Deque\IntegerLinkedList;
use App\Models\Deque\PrintFunctions;
use PHPUnit\Framework\TestCase;

/**
 * PrintFunctions クラスのテスト
 */
class PrintFunctionsTest extends TestCase
{
    /**
     * queuePrint のテスト
     */
    public function testQueuePrint(): void
    {
        $list = new IntegerLinkedList();
        $list->push(1);
        $list->push(2);
        $list->push(3);

        // FIFO順序での出力をテスト
        ob_start();
        $result = PrintFunctions::queuePrint($list);
        $output = ob_get_clean();

        $this->assertEquals('Queue (FIFO): 1 2 3', $result);
        $this->assertEquals('Queue (FIFO): 1 2 3' . PHP_EOL, $output);
        $this->assertTrue($list->isEmpty()); // 破壊的操作の確認
    }

    /**
     * stackPrint のテスト
     */
    public function testStackPrint(): void
    {
        $list = new IntegerLinkedList();
        $list->push(1);
        $list->push(2);
        $list->push(3);

        // LIFO順序での出力をテスト
        ob_start();
        $result = PrintFunctions::stackPrint($list);
        $output = ob_get_clean();

        $this->assertEquals('Stack (LIFO): 3 2 1', $result);
        $this->assertEquals('Stack (LIFO): 3 2 1' . PHP_EOL, $output);
        $this->assertTrue($list->isEmpty()); // 破壊的操作の確認
    }

    /**
     * dequePrint のテスト
     */
    public function testDequePrint(): void
    {
        $list = new IntegerLinkedList();
        $list->push(1);
        $list->push(2);
        $list->push(3);
        $list->push(4);

        // 前後交互の取り出しをテスト
        // 前から: 1, 後ろから: 4, 前から: 2, 後ろから: 3
        ob_start();
        $result = PrintFunctions::dequePrint($list);
        $output = ob_get_clean();

        $this->assertEquals('Deque (alternating): 1 4 2 3', $result);
        $this->assertEquals('Deque (alternating): 1 4 2 3' . PHP_EOL, $output);
        $this->assertTrue($list->isEmpty()); // 破壊的操作の確認
    }

    /**
     * dequePrint 奇数個要素のテスト
     */
    public function testDequePrintOddNumberOfElements(): void
    {
        $list = new IntegerLinkedList();
        $list->push(1);
        $list->push(2);
        $list->push(3);

        // 前から: 1, 後ろから: 3, 前から: 2
        ob_start();
        $result = PrintFunctions::dequePrint($list);
        $output = ob_get_clean();

        $this->assertEquals('Deque (alternating): 1 3 2', $result);
        $this->assertTrue($list->isEmpty());
    }

    /**
     * abstractListIntegerPrint のテスト
     */
    public function testAbstractListIntegerPrint(): void
    {
        $list = new IntegerLinkedList();
        $list->push(1);
        $list->push(2);
        $list->push(3);

        // 非破壊的操作での出力をテスト
        ob_start();
        $result = PrintFunctions::abstractListIntegerPrint($list);
        $output = ob_get_clean();

        $this->assertEquals('AbstractList: [1, 2, 3]', $result);
        $this->assertEquals('AbstractList: [1, 2, 3]' . PHP_EOL, $output);
        $this->assertFalse($list->isEmpty()); // 非破壊的操作の確認
        $this->assertEquals([1, 2, 3], $list->toArray());
    }

    /**
     * 空のリストでの各Print関数のテスト
     */
    public function testPrintFunctionsWithEmptyList(): void
    {
        $emptyList = new IntegerLinkedList();

        // queuePrint
        ob_start();
        $result1 = PrintFunctions::queuePrint($emptyList);
        $output1 = ob_get_clean();
        $this->assertEquals('Queue (FIFO): ', $result1);

        // stackPrint
        $emptyList2 = new IntegerLinkedList();
        ob_start();
        $result2 = PrintFunctions::stackPrint($emptyList2);
        $output2 = ob_get_clean();
        $this->assertEquals('Stack (LIFO): ', $result2);

        // dequePrint
        $emptyList3 = new IntegerLinkedList();
        ob_start();
        $result3 = PrintFunctions::dequePrint($emptyList3);
        $output3 = ob_get_clean();
        $this->assertEquals('Deque (alternating): ', $result3);

        // abstractListIntegerPrint
        $emptyList4 = new IntegerLinkedList();
        ob_start();
        $result4 = PrintFunctions::abstractListIntegerPrint($emptyList4);
        $output4 = ob_get_clean();
        $this->assertEquals('AbstractList: []', $result4);
    }

    /**
     * 単一要素での各Print関数のテスト
     */
    public function testPrintFunctionsWithSingleElement(): void
    {
        // queuePrint
        $list1 = new IntegerLinkedList();
        $list1->push(42);
        ob_start();
        $result1 = PrintFunctions::queuePrint($list1);
        ob_get_clean();
        $this->assertEquals('Queue (FIFO): 42', $result1);

        // stackPrint
        $list2 = new IntegerLinkedList();
        $list2->push(42);
        ob_start();
        $result2 = PrintFunctions::stackPrint($list2);
        ob_get_clean();
        $this->assertEquals('Stack (LIFO): 42', $result2);

        // dequePrint
        $list3 = new IntegerLinkedList();
        $list3->push(42);
        ob_start();
        $result3 = PrintFunctions::dequePrint($list3);
        ob_get_clean();
        $this->assertEquals('Deque (alternating): 42', $result3);

        // abstractListIntegerPrint
        $list4 = new IntegerLinkedList();
        $list4->push(42);
        ob_start();
        $result4 = PrintFunctions::abstractListIntegerPrint($list4);
        ob_get_clean();
        $this->assertEquals('AbstractList: [42]', $result4);
    }
}
