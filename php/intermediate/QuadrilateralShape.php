<?php

class Point
{
    public $x;
    public $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}

class Line
{
    public $startPoint;
    public $endPoint;

    public function __construct(Point $startPoint, Point $endPoint)
    {
        $this->startPoint = $startPoint;
        $this->endPoint = $endPoint;
    }

    public function getLength(): float
    {
        $x = $this->endPoint->x - $this->startPoint->x;
        $y = $this->endPoint->y - $this->startPoint->y;

        return sqrt(pow($x, 2) + pow($y, 2));
    }
}

class QuadrilateralShape
{
    public $lineAB;
    public $lineBC;
    public $lineCD;
    public $lineDA;

    public function __construct(Line $lineAB, Line $lineBC, Line $lineCD, Line $lineDA)
    {
        $this->lineAB = $lineAB;
        $this->lineBC = $lineBC;
        $this->lineCD = $lineCD;
        $this->lineDA = $lineDA;
    }

    // 四角形の周囲の長さを返す
    public function getPerimeter(): int
    {
        return floor(
            $this->lineAB->getLength() +
                $this->lineBC->getLength() +
                $this->lineCD->getLength() +
                $this->lineDA->getLength()
        );
    }

    // 四角形の面積を返す
    public function getArea(): int
    {
        $points = [
            $this->lineAB->startPoint,
            $this->lineAB->endPoint,
            $this->lineBC->endPoint,
            $this->lineCD->endPoint,
        ];

        $area = 0;
        $n = count($points);

        for ($i = 0; $i < $n; $i++) {
            $x1 = $points[$i]->x;
            $y1 = $points[$i]->y;
            $x2 = $points[($i + 1) % $n]->x;
            $y2 = $points[($i + 1) % $n]->y;

            $area += ($x1 * $y2) - ($y1 * $x2);
        }

        return floor(abs($area) / 2);
    }
}
