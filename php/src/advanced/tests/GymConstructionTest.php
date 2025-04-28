<?php

use PHPUnit\Framework\TestCase;

// Test Command
// ./php/src/vendor/bin/phpunit --testdox php/src/advanced/tests/GymConstructionTest.php

require_once __DIR__ . '/../GymConstruction.php';

class GymConstructionTest extends TestCase
{
    public function testLargestRectangle()
    {
        $gym = new GymConstruction();
        $this->assertEquals(9, $gym->largestRectangle([1, 2, 3, 4, 5, 1]));
        $this->assertEquals(6, $gym->largestRectangle([3, 2, 3]));
        $this->assertEquals(10, $gym->largestRectangle([1, 2, 5, 2, 3, 4]));
        $this->assertEquals(9, $gym->largestRectangle([1, 2, 3, 4, 5]));
        $this->assertEquals(16, $gym->largestRectangle([3, 4, 5, 8, 10, 2, 1, 3, 9]));
        $this->assertEquals(10, $gym->largestRectangle([1, 2, 1, 3, 5, 2, 3, 4]));
        $this->assertEquals(50, $gym->largestRectangle([11, 11, 10, 10, 10]));
        $this->assertEquals(26152, $gym->largestRectangle([8979, 4570, 6436, 5083, 7780, 3269, 5400, 7579, 2324, 2116]));
    }
}
