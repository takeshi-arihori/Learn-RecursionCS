<?php


use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../sieveOfElastoTenes.php';

class SieveOfElastoTenesTest extends TestCase
{
    public function testSumOfAllPrimes()
    {
        $this->assertEquals(17, sumOfAllPrimes(10));
        $this->assertEquals(77, sumOfAllPrimes(20));
        $this->assertEquals(1060, sumOfAllPrimes(100));
        $this->assertEquals(76127, sumOfAllPrimes(1000));
        $this->assertEquals(5736396, sumOfAllPrimes(10000));
    }
}

// 実行方法
// php src/vendor/bin/phpunit --testdox src/intermediate/tests/SieveOfElastoTenesTest.php