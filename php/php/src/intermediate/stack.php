<?php

// まずはじめに、subtract(4,10) の呼び出しが、コールスタックに push され、そこでは myResult の作成と計算が行われます。
// 関数の計算が終了すると、subtract（4,10）はコールスタックから pop され、呼び出しの中にある myResult や仮引数の中にあるデータを含めた全てのものは破壊され、-6 が返されます。
// つづいて、コンピュータは次に優先順位の高い、powerFunc(2,5) を実行します。
// powerFunc(2,5) の呼び出しは、同様にコールスタックに push され、関数の計算が終了すると、pop され、32 を返します。
// その後、式は -6 * 20 * 32 になり、-6 * 20 * 32 = -120 * 32 = -3840 を返します。

function subtract(int $x, int $y): int
{
    $myResult = $x - $y;
    return $myResult;
}

function powerFunc(int $base, int $power): int
{
    return $base ** $power;
}

echo subtract(4, 10) . PHP_EOL;
echo subtract(4, 10) * 20 . PHP_EOL;
echo powerFunc(2, 5) . PHP_EOL;
echo subtract(4, 10) * 20 * powerFunc(2, 5) . PHP_EOL;
