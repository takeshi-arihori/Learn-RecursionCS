<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../QuadrilateralShape.php';

class QuadrilateralShapeTest extends TestCase
{
    public function testRhombus()
    {
        $lineA = new Line(new Point(4, 12), new Point(0, 6));
        $lineB = new Line(new Point(0, 6), new Point(4, 0));
        $lineC = new Line(new Point(4, 0), new Point(8, 6));
        $lineD = new Line(new Point(8, 6), new Point(4, 12));
        $rhombus = new QuadrilateralShape($lineA, $lineB, $lineC, $lineD);
        $this->assertEquals(28, $rhombus->getPerimeter());
        $this->assertEquals(48, $rhombus->getArea());
    }

    public function testParallelogram()
    {
        $lineE = new Line(new Point(0, 0), new Point(2, 2));
        $lineF = new Line(new Point(2, 2), new Point(2, 6));
        $lineG = new Line(new Point(2, 6), new Point(0, 4));
        $lineH = new Line(new Point(0, 4), new Point(0, 0));
        $parallelogram = new QuadrilateralShape($lineE, $lineF, $lineG, $lineH);
        $this->assertEquals(13, $parallelogram->getPerimeter());
        $this->assertEquals(8, $parallelogram->getArea());
    }

    public function testTrapezoid()
    {
        $lineI = new Line(new Point(0, 0), new Point(4, 0));
        $lineJ = new Line(new Point(4, 0), new Point(6, 2));
        $lineK = new Line(new Point(6, 2), new Point(6, 6));
        $lineL = new Line(new Point(6, 6), new Point(0, 0));
        $trapezoid = new QuadrilateralShape($lineI, $lineJ, $lineK, $lineL);
        $this->assertEquals(19, $trapezoid->getPerimeter());
        $this->assertEquals(16, $trapezoid->getArea());
    }

    public function testKite()
    {
        $lineM = new Line(new Point(0, 4), new Point(4, 10));
        $lineN = new Line(new Point(4, 10), new Point(8, 4));
        $lineO = new Line(new Point(8, 4), new Point(4, 0));
        $lineP = new Line(new Point(4, 0), new Point(0, 4));
        $kite = new QuadrilateralShape($lineM, $lineN, $lineO, $lineP);
        $this->assertEquals(25, $kite->getPerimeter());
        $this->assertEquals(40, $kite->getArea());
    }

    public function testOther()
    {
        $lineQ = new Line(new Point(0, 0), new Point(8, 0));
        $lineR = new Line(new Point(8, 0), new Point(10, 12));
        $lineS = new Line(new Point(10, 12), new Point(2, 6));
        $lineT = new Line(new Point(2, 6), new Point(0, 0));
        $other = new QuadrilateralShape($lineQ, $lineR, $lineS, $lineT);
        $this->assertEquals(36, $other->getPerimeter());
        $this->assertEquals(66, $other->getArea());
    }
}

// 実行方法
// php vendor/bin/phpunit --testdox tests/QuadrilateralShapeTest.php