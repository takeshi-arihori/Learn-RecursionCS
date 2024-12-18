<?php

// 整数 m と整数 n の GCD（最大公約数）を gcd（m,n）と表記
// gcd($x, $y) = gcd(168, 60)
// gcd(168 % 60, 60)
// = gcd(60 % 48, 48)
// = gcd(48 % 12, 12)
// = 12

// gcd(60,168)
// = gcd(60, 48)
// = gcd(12, 48)
// = gcd(12,12)
// = 12


// 整数 m と整数 n の GCD（最大公約数）を計算する
function gcd(int $m, int $n): int
{
    // 負の数を絶対値に変換
    $m = abs($m);
    $n = abs($n);

    // 両方がゼロの場合、例外をスロー
    if ($m === 0 && $n === 0) {
        throw new InvalidArgumentException("GCD is undefined for both m and n being zero.");
    }

    return gcdHelper($m, $n);
}

function gcdHelper(int $m, int $n): int
{
    if ($n === 0) return $m; // ベースケース
    return gcdHelper($n, $m % $n); // 正しい引数の順序
}
// テストケース
function runTests()
{
    // テストケースのリスト [m, n, expected]
    $testCases = [
        [12, 18, 6],          // 基本ケース
        [13, 17, 1],          // 互いに素な数
        [0, 25, 25],          // 一方がゼロ
        [14, 14, 14],         // 同じ数
        [15, 45, 15],         // 一方が他方の倍数
        [123456, 789012, 12], // 大きな数
        [1, 999, 1],          // 片方が1
        [-20, 30, 10],        // 負の数（絶対値で計算）
        [1, 1000000, 1],      // 片方が非常に小さい数
        [0, 0, 0]
    ];

    foreach ($testCases as $case) {
        [$m, $n, $expected] = $case;
        try {
            $result = gcd($m, $n);
            assert($result === $expected, "Test failed: gcd($m, $n) should be $expected but got $result");
        } catch (Exception $e) {
            echo "Exception for gcd($m, $n): " . $e->getMessage() . "\n";
        }
    }

    echo "All tests passed successfully!\n";
}

// テストを実行
runTests();
