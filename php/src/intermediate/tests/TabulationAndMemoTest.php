<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../TabulationAndMemo.php';

class TabulationAndMemoTest extends TestCase
{
    public function testTabulationAndMemo()
    {
        $tabulationAndMemo = new TabulationAndMemo();
        // タビュレーション
        $this->assertEquals(0, $tabulationAndMemo->tabulationFib(0));
        $this->assertEquals(1, $tabulationAndMemo->tabulationFib(1));
        $this->assertEquals(1, $tabulationAndMemo->tabulationFib(2));
        $this->assertEquals(2, $tabulationAndMemo->tabulationFib(3));
        $this->assertEquals(3, $tabulationAndMemo->tabulationFib(4));
        $this->assertEquals(5, $tabulationAndMemo->tabulationFib(5));
        $this->assertEquals(8, $tabulationAndMemo->tabulationFib(6));
        $this->assertEquals(13, $tabulationAndMemo->tabulationFib(7));
        $this->assertEquals(21, $tabulationAndMemo->tabulationFib(8));
        $this->assertEquals(34, $tabulationAndMemo->tabulationFib(9));
        $this->assertEquals(55, $tabulationAndMemo->tabulationFib(10));
        $this->assertEquals(12586269025, $tabulationAndMemo->tabulationFib(50));

        // メモ化
        $this->assertEquals(0, $tabulationAndMemo->memoizationFib(0));
        $this->assertEquals(1, $tabulationAndMemo->memoizationFib(1));
        $this->assertEquals(1, $tabulationAndMemo->memoizationFib(2));
        $this->assertEquals(2, $tabulationAndMemo->memoizationFib(3));
        $this->assertEquals(3, $tabulationAndMemo->memoizationFib(4));
        $this->assertEquals(5, $tabulationAndMemo->memoizationFib(5));
        $this->assertEquals(8, $tabulationAndMemo->memoizationFib(6));
        $this->assertEquals(13, $tabulationAndMemo->memoizationFib(7));
        $this->assertEquals(21, $tabulationAndMemo->memoizationFib(8));
        $this->assertEquals(34, $tabulationAndMemo->memoizationFib(9));
        $this->assertEquals(55, $tabulationAndMemo->memoizationFib(10));
        $this->assertEquals(12586269025, $tabulationAndMemo->memoizationFib(50));
    }
}
