<?php


function sumOfAllPrimes(int $n): int
{
    $totalPrime = 0;
    $isPrime = array_fill(0, $n + 1, true); // 素数かどうかの判定用配列を初期化

    $isPrime[0] = $isPrime[1] = false; // 0と1は素数ではない

    for ($i = 2; $i * $i <= $n; $i++) {
        if ($isPrime[$i]) {
            // iの倍数を素数ではないとマーク
            for ($j = $i * $i; $j <= $n; $j += $i) {
                $isPrime[$j] = false;
            }
        }
    }

    // 素数を合計
    for ($i = 2; $i <= $n; $i++) {
        if ($isPrime[$i]) {
            $totalPrime += $i;
        }
    }

    return $totalPrime;
}
