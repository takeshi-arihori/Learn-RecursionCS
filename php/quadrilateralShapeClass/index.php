<?php

// Pointクラス
// very easy
// x-y 平面上の全ての点は (x,y) と表現することができます。以下に従って、Point クラスを作成し、テストケースを出力してください。

// double x: x 軸上の座標
// double y: y 軸上の座標

// テストケース
// a = new Point(3,1)
// b = new Point(3,6)

// a.x --> 3
// a.y --> 1
// b.x --> 3
// b.y --> 6

class Point
{
	public float $x;
	public float $y;

	function __construct($x, $y)
	{
		$this->x = $x;
		$this->y = $y;
	}
}

$a = new Point(3, 1);
$b = new Point(3, 6);

echo $a->x . "\n"; // 出力: 3
echo $a->y . "\n"; // 出力: 1
echo $b->x . "\n"; // 出力: 3
echo $b->y . "\n"; // 出力: 6

// x-y 平面上の線は、始点と終点によって定義することができます。この Line クラスには、2 つの Point オブジェクトを引数として受け取るコンストラクタがあり、Line オブジェクトの始点および終点に代入されます。以下に従って、Line クラスを作成し、テストケースを出力してください。

// Point startPoint: 線の始点
// Point endPoint: 線の終点
// double getLength(): 線の長さを返します。


class Line
{
	public Point $startPoint;
	public Point $endPoint;

	public function __construct(Point $startPoint, Point $endPoint)
	{
		$this->startPoint = $startPoint;
		$this->endPoint = $endPoint;
	}

	public function getLength(): float
	{
		$dx = $this->endPoint->x - $this->startPoint->x;
		$dy = $this->endPoint->y - $this->startPoint->y;
		return sqrt(pow($dx, 2) + pow($dy, 2));
	}
}


$a = new Point(3, 1);
$b = new Point(3, 6);
$lineAB = new Line($a, $b);
echo $lineAB->getLength() . PHP_EOL; // --> 5


$c = new Point(1, 3);
$d = new Point(6, 15);
$lineCD = new Line($c, $d);
echo $lineCD->getLength() . PHP_EOL; // --> 13
