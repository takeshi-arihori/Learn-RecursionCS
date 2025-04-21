<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../RoomChange.php';

class RoomChangeTest extends TestCase
{
    public function testRotateByTimes()
    {
        $roomChange = new RoomChange();

        $this->assertEquals([4, 5, 1, 2, 3], $roomChange->rotateByTimes([1, 2, 3, 4, 5], 2));
        $this->assertEquals([1, 2, 3, 4, 5], $roomChange->rotateByTimes([1, 2, 3, 4, 5], 5));
        $this->assertEquals([3, 4, 5, 10, 12], $roomChange->rotateByTimes([10, 12, 3, 4, 5], 3));
        $this->assertEquals([5002, 3, 4, 23, 104, 435], $roomChange->rotateByTimes([4, 23, 104, 435, 5002, 3], 26));
        $this->assertEquals([4, 23, 104, 435, 5002, 3], $roomChange->rotateByTimes([4, 23, 104, 435, 5002, 3], 0));
        $this->assertEquals([3, 4, 23, 104, 435, 5002], $roomChange->rotateByTimes([4, 23, 104, 435, 5002, 3], 1));
        $this->assertEquals([5002, 3, 4, 23, 104, 435], $roomChange->rotateByTimes([4, 23, 104, 435, 5002, 3], 2));
        $this->assertEquals([3, 2], $roomChange->rotateByTimes([2, 3], 1));

        // reverseを使った解き方
        $this->assertEquals([4, 5, 1, 2, 3], $roomChange->rotateByTimesReverse([1, 2, 3, 4, 5], 2));
        // $this->assertEquals([1, 2, 3, 4, 5], $roomChange->rotateByTimesReverse([1, 2, 3, 4, 5], 5));
        // $this->assertEquals([3, 4, 5, 10, 12], $roomChange->rotateByTimesReverse([10, 12, 3, 4, 5], 3));
        // $this->assertEquals([5002, 3, 4, 23, 104, 435], $roomChange->rotateByTimesReverse([4, 23, 104, 435, 5002, 3], 26));
        // $this->assertEquals([4, 23, 104, 435, 5002, 3], $roomChange->rotateByTimesReverse([4, 23, 104, 435, 5002, 3], 0));
        // $this->assertEquals([3, 4, 23, 104, 435, 5002], $roomChange->rotateByTimesReverse([4, 23, 104, 435, 5002, 3], 1));
        // $this->assertEquals([5002, 3, 4, 23, 104, 435], $roomChange->rotateByTimesReverse([4, 23, 104, 435, 5002, 3], 2));
        // $this->assertEquals([3, 2], $roomChange->rotateByTimesReverse([2, 3], 1));
    }
}

// php src/vendor/bin/phpunit --testdox src/intermediate/tests/RoomChangeTest.php