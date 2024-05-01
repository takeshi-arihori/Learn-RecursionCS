<?php
// バビロンの平方根

// isSquareRootCloseEnough関数は、相対誤差を計算する関数
// 相対誤差が0.01%未満であればtrue、0.01%以上であればfalseを返す
function isSquareRootCloseEnough(float $a, float $b): bool
{
	// 誤差「a-b」を計算するために、abs関数を使用。abs(x)はxの絶対値を返す
	return abs($a - $b) < 0.0001;
}

// 可読性を高めるために、近似値をguess、新しい近似値をnewGuessとして定義
function squareRootHelper(float $x, float $guess): float
{
	// 新しい近似値は、2つの近似値の平均から求める
	$newGuess = ($guess + $x / $guess) / 2;

	echo "guess : " . strval($guess) . '  ';
	echo "new guess : " . strval($newGuess) . '  ';
	echo '<br>';

	// 相対誤差が0.01%未満であることがベースケース
	if (isSquareRootCloseEnough($guess, $newGuess)) return $newGuess;

	// 再帰的に計算を繰り返す
	return squareRootHelper($x, ($guess + $x / $guess) / 2);
}

// 平方根の近似値を求める関数
function squareRoot(int $x): float
{
	// 近似値の初期値として1を設定
	// 引数を増やして、squareRootHelper関数で再帰処理を行う
	return squareRootHelper($x, 1);
}

// 関数の呼び出し
echo squareRoot(65) . PHP_EOL;
