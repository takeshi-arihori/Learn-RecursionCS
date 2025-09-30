<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../forloop.php';

class ForLoopFibonacchTest extends TestCase
{
    public function testFibonacciNumberTail()
    {
        $this->assertEquals(0, fibonacciNumberTail(0));
        $this->assertEquals(1, fibonacciNumberTail(1));
        $this->assertEquals(1, fibonacciNumberTail(2));
        $this->assertEquals(2, fibonacciNumberTail(3));
        $this->assertEquals(3, fibonacciNumberTail(4));
        $this->assertEquals(5, fibonacciNumberTail(5));
        $this->assertEquals(8, fibonacciNumberTail(6));
        $this->assertEquals(13, fibonacciNumberTail(7));
        $this->assertEquals(21, fibonacciNumberTail(8));
        $this->assertEquals(34, fibonacciNumberTail(9));
        $this->assertEquals(55, fibonacciNumberTail(10));
        $this->assertEquals(89, fibonacciNumberTail(11));
        $this->assertEquals(144, fibonacciNumberTail(12));
        $this->assertEquals(233, fibonacciNumberTail(13));
        $this->assertEquals(377, fibonacciNumberTail(14));
        $this->assertEquals(610, fibonacciNumberTail(15));
        $this->assertEquals(987, fibonacciNumberTail(16));
        $this->assertEquals(1597, fibonacciNumberTail(17));
        $this->assertEquals(2584, fibonacciNumberTail(18));
        $this->assertEquals(4181, fibonacciNumberTail(19));
        $this->assertEquals(6765, fibonacciNumberTail(20));
    }

    public function testFibonacchNumberForLoopIteration()
    {
        $this->assertEquals(0, fibonacchNumberForLoopIteration(0));
        $this->assertEquals(1, fibonacchNumberForLoopIteration(1));
        $this->assertEquals(1, fibonacchNumberForLoopIteration(2));
        $this->assertEquals(2, fibonacchNumberForLoopIteration(3));
        $this->assertEquals(3, fibonacchNumberForLoopIteration(4));
        $this->assertEquals(5, fibonacchNumberForLoopIteration(5));
        $this->assertEquals(8, fibonacchNumberForLoopIteration(6));
        $this->assertEquals(13, fibonacchNumberForLoopIteration(7));
        $this->assertEquals(21, fibonacchNumberForLoopIteration(8));
        $this->assertEquals(34, fibonacchNumberForLoopIteration(9));
        $this->assertEquals(55, fibonacchNumberForLoopIteration(10));
        $this->assertEquals(89, fibonacchNumberForLoopIteration(11));
        $this->assertEquals(144, fibonacchNumberForLoopIteration(12));
        $this->assertEquals(233, fibonacchNumberForLoopIteration(13));
        $this->assertEquals(377, fibonacchNumberForLoopIteration(14));
        $this->assertEquals(610, fibonacchNumberForLoopIteration(15));
        $this->assertEquals(987, fibonacchNumberForLoopIteration(16));
        $this->assertEquals(1597, fibonacchNumberForLoopIteration(17));
        $this->assertEquals(2584, fibonacchNumberForLoopIteration(18));
        $this->assertEquals(4181, fibonacchNumberForLoopIteration(19));
        $this->assertEquals(6765, fibonacchNumberForLoopIteration(20));
    }
}
