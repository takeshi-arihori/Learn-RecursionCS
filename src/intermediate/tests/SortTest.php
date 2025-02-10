<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Sort.php';

class SortTest extends TestCase
{
    public function testSelectionSort()
    {
        $sortTest = new Sort();
        $this->assertEquals([1, 2, 3, 6, 8, 32, 34, 34, 45, 56, 76, 566, 4546], $sortTest::selectionSort([34, 4546, 32, 3, 2, 8, 6, 76, 56, 45, 34, 566, 1]));
        $this->assertEquals([-32, 6, 8, 13, 21, 31, 34, 45, 46, 56, 76, 3309, 5663], $sortTest::selectionSort([3309, 46, -32, 13, 21, 8, 6, 76, 56, 45, 34, 5663, 31]));
    }
}

// phpunit --testdox intermediate/tests/SortTest.php;