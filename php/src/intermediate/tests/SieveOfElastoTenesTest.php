<?php


use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../sieveOfElastoTenes.php';

class SieveOfElastoTenesTest extends TestCase
{
    public function testSumOfAllPrimes()
    {
        $this->assertEquals([2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97], allNPrimesSieve(100));
    }

    public function testPrimesUpTo10()
    {
        $this->assertEquals([2, 3, 5, 7], allNPrimesSieve(10));
    }

    public function testPrimesUpTo50()
    {
        $this->assertEquals([2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47], allNPrimesSieve(50));
    }

    public function testPrimesUpTo30()
    {
        $this->assertEquals([2, 3, 5, 7, 11, 13, 17, 19, 23, 29], allNPrimesSieve(30));
    }

    public function testPrimesUpTo20()
    {
        $this->assertEquals([2, 3, 5, 7, 11, 13, 17, 19], allNPrimesSieve(20));
    }

    public function testPrimesUpTo5()
    {
        $this->assertEquals([2, 3], allNPrimesSieve(5));
    }

    public function testPrimesUpTo2()
    {
        $this->assertEquals([], allNPrimesSieve(2));
    }

    public function testPrimesUpTo1()
    {
        $this->assertEquals([], allNPrimesSieve(1));
    }

    public function testPrimesUpTo0()
    {
        $this->assertEquals([], allNPrimesSieve(0));
    }

    public function testPrimesUpTo200()
    {
        $this->assertEquals([2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199], allNPrimesSieve(200));
    }
}


// 実行方法
// php src/vendor/bin/phpunit --testdox src/intermediate/tests/SieveOfElastoTenesTest.php