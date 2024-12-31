<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../sqrt.php';

class SqrtTest extends TestCase
{
    public function testIsSquareRootCloseEnough()
    {
        $this->assertTrue(isSquareRootCloseEnough(1.41421356, 1.41421356));
        $this->assertTrue(isSquareRootCloseEnough(1.41421356, 1.41421357));
        $this->assertTrue(isSquareRootCloseEnough(1.41421356, 1.41421358));
    }

    public function testSquareRootHelper()
    {
        $this->assertEqualsWithDelta(1.41421356, squareRootHelper(2, 1.4), 0.000001);
        $this->assertEqualsWithDelta(1.41421356, squareRootHelper(2, 1.414285), 0.000001);
    }
}

// 実行方法
// $ php vendor/bin/phpunit --testdox tests/SqrtTest.php