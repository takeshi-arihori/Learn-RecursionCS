<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../RoundRobin.php';

class RoundRobinTest extends TestCase
{
    public function testChooseNFromBags2d()
    {
        $roundRobin = new RoundRobin();

        $unluckyBagOfNumbers = [292, 39, 78, 978, 668, 6, 66, 666, 662, 876, 276, 782, 879, 869, 478, 1968];

        $result = $roundRobin->chooseNFromBags1d(10, $unluckyBagOfNumbers, 4, 4);

        $this->assertCount(10, $result);
        foreach ($result as $number) {
            $this->assertContains($number, $unluckyBagOfNumbers);
        }
    }
}

// php src/vendor/bin/phpunit --testdox src/intermediate/tests/RoundRobinTest.php