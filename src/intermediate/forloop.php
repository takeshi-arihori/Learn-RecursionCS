<?php

// 再帰
function fibonacciNumberTailHelper(int $fn1, int $fn2, int $n): int
{
    if ($n < 1) return $fn1;

    return fibonacciNumberTailHelper($fn2, $fn1 + $fn2, $n - 1);
}

function fibonacciNumberTail($n)
{
    // helper 関数のおかげで、この関数は 1 つのパラメータしか受け取りません
    // 0 と 1 からスタートします
    return fibonacciNumberTailHelper(0, 1, $n);
}


// 反復
function fibonacchNumberForLoopIteration($n): int
{
    $fn1 = 0;
    $fn2 = 1;

    for ($i = 0; $i < $n; $i++) {
        // 前の fn1 を保存し、fn1とfn2をアップデート
        $tmp = $fn1;
        $fn1 = $fn2;
        $fn2 = $tmp + $fn2;
    }

    return $fn1;
}
