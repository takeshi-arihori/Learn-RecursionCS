<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Sort.php';

class SortTest extends TestCase
{
    private Sort $sortTest;

    public function setUp(): void
    {
        parent::setUp(); // PHPUnitのセットアップを実行
        $this->sortTest = new Sort(); // Sortのインスタンスを作成
    }

    public function testSelectionSort()
    {
        $this->assertEquals([1, 2, 3, 6, 8, 32, 34, 34, 45, 56, 76, 566, 4546], $this->sortTest->selectionSort([34, 4546, 32, 3, 2, 8, 6, 76, 56, 45, 34, 566, 1]));
        $this->assertEquals([-32, 6, 8, 13, 21, 31, 34, 45, 46, 56, 76, 3309, 5663], $this->sortTest->selectionSort([3309, 46, -32, 13, 21, 8, 6, 76, 56, 45, 34, 5663, 31]));
        $this->assertEquals([], $this->sortTest->selectionSort([])); // 空の配列
        $this->assertEquals([42], $this->sortTest->selectionSort([42])); // 要素1つ
        $this->assertEquals([-99, -76, -34, -8, -1], $this->sortTest->selectionSort([-34, -8, -76, -1, -99])); // 負の数のみ
        $this->assertEquals([7, 7, 7, 7, 7], $this->sortTest->selectionSort([7, 7, 7, 7, 7])); // すべて同じ要素
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $this->sortTest->selectionSort([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])); // すでにソート済み
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $this->sortTest->selectionSort([10, 9, 8, 7, 6, 5, 4, 3, 2, 1])); // 逆順
        $this->assertEquals([1.1, 2.2, 3.3, 4.4, 5.5], $this->sortTest->selectionSort([3.3, 1.1, 5.5, 4.4, 2.2])); // 小数を含む
        $this->assertEquals([1, 2, 3, 10, 15, 20], $this->sortTest->selectionSort([3, "10", 2, "15", 1, 20])); // 文字列を含む
        $this->assertEquals([1, 123456789, 987654321], $this->sortTest->selectionSort([987654321, 1, 123456789])); // 大きな数
        $this->assertEquals([5, 12, 17, 23, 42, 99], $this->sortTest->selectionSort([42, 5, 99, 23, 17, 12])); // 乱数
    }

    public function testInsertionSort()
    {
        $this->assertEquals([1, 2, 3, 6, 8, 32, 34, 34, 45, 56, 76, 566, 4546], $this->sortTest->selectionSort([34, 4546, 32, 3, 2, 8, 6, 76, 56, 45, 34, 566, 1]));
        $this->assertEquals([-32, 6, 8, 13, 21, 31, 34, 45, 46, 56, 76, 3309, 5663], $this->sortTest->selectionSort([3309, 46, -32, 13, 21, 8, 6, 76, 56, 45, 34, 5663, 31]));
        $this->assertEquals([], $this->sortTest->selectionSort([])); // 空の配列
        $this->assertEquals([42], $this->sortTest->selectionSort([42])); // 要素1つ
        $this->assertEquals([-99, -76, -34, -8, -1], $this->sortTest->selectionSort([-34, -8, -76, -1, -99])); // 負の数のみ
        $this->assertEquals([7, 7, 7, 7, 7], $this->sortTest->selectionSort([7, 7, 7, 7, 7])); // すべて同じ要素
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $this->sortTest->selectionSort([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])); // すでにソート済み
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $this->sortTest->selectionSort([10, 9, 8, 7, 6, 5, 4, 3, 2, 1])); // 逆順
        $this->assertEquals([1.1, 2.2, 3.3, 4.4, 5.5], $this->sortTest->selectionSort([3.3, 1.1, 5.5, 4.4, 2.2])); // 小数を含む
        $this->assertEquals([1, 2, 3, 10, 15, 20], $this->sortTest->selectionSort([3, "10", 2, "15", 1, 20])); // 文字列を含む
        $this->assertEquals([1, 123456789, 987654321], $this->sortTest->selectionSort([987654321, 1, 123456789])); // 大きな数
        $this->assertEquals([5, 12, 17, 23, 42, 99], $this->sortTest->selectionSort([42, 5, 99, 23, 17, 12])); // 乱数
    }
}

// phpunit --testdox intermediate/tests/SortTest.php;