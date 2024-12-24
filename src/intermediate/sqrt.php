<?php

// バビロンの平方根

// √2 の近似値をxとする(2乗すると2になる数がx): x^2 ≒ 2
// ここで両辺を x(≠ 0) で割ると $x ≒ 2 / $x
// 試しに先ほど求めた近似値 1.4 を x に代入してみると、
// （左辺）= 1.4
// （右辺）= 2 / 1.4 = 1.42857…
// 1.4 と 2 / 1.4 = 1.42857... -> 両者の値が少しずれている。この2つの値の間に正しい平方根があると推定。
// 2つの値 x と 2/x の平均値を x’ とすると、x’ = (x + 2/x) / 2
// 先ほど計算した左辺と右辺の値を代入して計算してみると x’ = (1.4 + 1.42857) / 2 = 1.414285 となり、新しい近似値が得られる
// 次はこの 1.414285 を x ≒ 2 / x へ代入します。
// （左辺）= 1.414285
// （右辺）= 2 / 1.414285 = 1.41414213...
// 同様に 2 つの平均値 x' を計算して、x' = (1.414285 + 1.41414213) / 2 = 1.414213565 となり、新しい近似値が得られる
// コンピュータでは小数計算は有限のため、正確な値を計算することはできず、ベースケースを設定しておかないと無限に計算してしまいます。
// そこで 2 つの近似値がかけ離れていない場合を相対誤差で表現し、それをベースケースとします。
// 相対誤差とは、測定した値と理論値の差を、理論値で割った値を使って表す誤差のことです。この値をパーセントで表すことができます。たとえば、1000 kg と 1001 kg の差を求めたい場合、次のように計算できます。

// まず、測定値と理論値の差を求めます。
// 1001 - 1000 = 1

// 次に、この差を理論値で割ります。
// 1 / 1000 = 0.001

// この値をパーセントに変換するために、100をかけます。
// 0.001 * 100 = 0.1%

// この結果から、1000 kg と 1001 kg の間には 0.1% の相対誤差があることがわかります。つまり、測定値が理論値から 0.1% だけずれているということになる。


/**
 * isSquareRootCloseEnough(a, b) は相対誤差を計算する関数
 * 相対誤差が0.1%未満であれば true, 0.01%以上であれば false を返す
 *
 * @param float $a
 * @param float $b
 * @return boolean
 */
function isSquareRootCloseEnough(float $a, float $b): bool
{
    // 誤差 |a-b| を計算するために、abs関数を使用。abs(x) は x の絶対値を返す
    // return 100 * abs(($a - $b) / $b) < 0.01;
    $result = 100 * abs(($a - $b) / $b);
    echo "result : " . strval($result) . PHP_EOL;
    return $result < 0.01;
}

/**
 * バビロンの平方根を計算する
 * 可読性を高めるために、近似値 guess、新しい近似値を newGuess とする
 *
 * @param float $x
 * @param float $guess
 * @return float
 */
function squareRootHelper(float $x, float $guess): float
{
    // 新しい近似値は、2つの近似値の平均から求める
    $newGuess = ($guess + $x / $guess) / 2;

    echo "guess : " . strval($guess) . PHP_EOL;
    echo "newGuess : " . strval($newGuess) . PHP_EOL;

    // 相対誤差が0.01%未満であることがベースケース
    if (isSquareRootCloseEnough($newGuess, $guess)) {
        return $newGuess;
    }

    // 再帰的に計算を繰り返す
    return squareRootHelper($x, ($guess + $x / $guess) / 2);
}

/**
 * 平方根の近似値を求める関数
 * 
 */
function squareRoot(float $x): float
{
    // 初期値は 1
    return squareRootHelper($x, 1);
}
