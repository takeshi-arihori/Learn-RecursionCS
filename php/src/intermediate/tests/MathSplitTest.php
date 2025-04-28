<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../MathSplit.php';

class MathSplitTest extends TestCase
{
    public function testRecursiveDigitsAdded()
    {
        $this->assertEquals(5, recursiveDigitsAdded(5));
        $this->assertEquals(8, recursiveDigitsAdded(8));
        $this->assertEquals(3, recursiveDigitsAdded(12));
        $this->assertEquals(25, recursiveDigitsAdded(98));
        $this->assertEquals(27, recursiveDigitsAdded(3528));
        $this->assertEquals(132, recursiveDigitsAdded(99999999999884));
        $this->assertEquals(25, recursiveDigitsAdded(5462));
        $this->assertEquals(43, recursiveDigitsAdded(45622943));
        $this->assertEquals(48, recursiveDigitsAdded(9514599));
    }
}

// 実行方法
// $ php vendor/bin/phpunit --testdox tests/MathSplitTest.php