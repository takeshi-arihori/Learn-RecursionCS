<?php

// 数字の分割
// medium
// 自然数 digits（0 < digits < 1015）が与えられるので、数字を 1 桁ずつ分解して、それぞれの値を合計し、その値が 1 桁になるまで同じ作業を繰り返した時、それぞれの合計値を足し合わせて得られる値を返す、recursiveDigitsAdded という関数を再帰を使って作成してください。
// 例えば、45622943 の場合、1 桁ずつ分解することによって、4 + 5 + 6 + 2 + 2 + 9 + 4 + 3 = 35 となりますが、値が 1 桁ではないので、もう一度 35 = 3 + 5 = 8 のように分解します。最後にそれぞれ足し合わせて 8 + 35 = 43 となります。
// 99999999999884 の場合は、9 + 9 + 9 + 9 + 9 + 9 + 9 + 9 + 9 + 9 + 9 + 8 + 8 + 4 = 119 となり、その後 1 + 1 + 9 = 11 となるので、119 + 11 + 2 = 132 となります。

## Case1: O(n^2)
// function recursiveDigitsAdded(int $digits): int
// {
//     $current = splitAndAdd($digits, 0);

//     if ($current < 10) return $current;
//     return $current + recursiveDigitsAdded($current);
// }

// function splitAndAdd(int $digits, int $sum): int
// {
//     if ($digits < 10) {
//         return $digits + $sum;
//     }
//     return splitAndAdd(floor($digits / 10), ($digits % 10) + $sum);
// }

## Case2: O(n)
function recursiveDigitsAdded(int $digits): int
{
    return recursiveDigitsAddedHelper($digits, 0, 0);
}

function recursiveDigitsAddedHelper(int $digits, int $sum, int $output): int
{
    // digits が 1 桁になるまで再帰的に呼び出す
    if ($digits < 10) {
        $sum += $digits;
        if ($sum < 10) {
            return $sum + $output;
        } else {
            return recursiveDigitsAddedHelper($sum, 0, $output + $sum);
        }
    }
    return recursiveDigitsAddedHelper(floor($digits / 10), ($digits % 10) + $sum, $output);
}

// Example usage
echo recursiveDigitsAdded(5) . PHP_EOL; // Output: 5
echo recursiveDigitsAdded(8) . PHP_EOL; // Output: 8
echo recursiveDigitsAdded(12) . PHP_EOL; // Output: 3
echo recursiveDigitsAdded(98) . PHP_EOL; // Output: 25
echo recursiveDigitsAdded(3528) . PHP_EOL; // Output: 27
echo recursiveDigitsAdded(99999999999884) . PHP_EOL; // Output: 132
echo recursiveDigitsAdded(5462) . PHP_EOL; // Output: 25
echo recursiveDigitsAdded(45622943) . PHP_EOL; // Output: 43
echo recursiveDigitsAdded(9514599) . PHP_EOL; // Output: 48