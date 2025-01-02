<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Complement.php';

class ComplementTest extends TestCase
{
    public function testTwosComplement()
    {
        $this->assertEquals('100000000', twosComplement('00000000'));
        $this->assertEquals('11111110', twosComplement('00000010'));
        $this->assertEquals('00000001', twosComplement('11111111'));
        $this->assertEquals('10001011', twosComplement('01110101'));
        $this->assertEquals('11111111', twosComplement('00000001'));
        $this->assertEquals('10000000', twosComplement('10000000'));
        $this->assertEquals('01010110', twosComplement('10101010'));
        $this->assertEquals('00000010', twosComplement('11111110'));
    }
}

// 実行方法
// php src/vendor/bin/phpunit --testdox src/intermediate/tests/ComplementTest.php