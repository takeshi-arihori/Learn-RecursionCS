<?php

declare(strict_types=1);

use App\Models\Animal\BMI;
use PHPUnit\Framework\TestCase;

class BMITest extends TestCase
{
    public function testToString(): void
    {
        $bmi = new BMI(1.75, 70);
        $this->assertEquals('1.75 meters, 70kg, BMI:22.86', $bmi->toString());
    }
}
