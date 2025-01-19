<?php

// エラストテネスの篩
// 1). サイズ n のブール値 true のリストを生成します。
// 2). 最初の素数を 2 と設定します。
// 3). 1~n の中から 2 で割り切れるものを全て false にします。
// 4). 素数 3 に対しても同じ処理を行います。
// 5). これを √n まで繰り返します。
// 6). キャッシュ内に残った全ての真の値のインデックスは素数になります。

/**
 * 与えられた数値 $n までの素数を全て配列で返す
 *
 * @param integer $n
 * @return array
 */
function allNPrimesSieve(int $n): array
{
    // サイズ n のブール値 true を持つリストを生成する キャッシュ
    $cache = array_fill(0, $n, true);

    // ステップを √n 繰り返す。nが素数でないと仮定すると、n = a * b と表すことができるので、a と b の両方が √n 以上になることはありえない。
    // したがって、√n * √n = n は最大合成組み合わせとなる。
    for ($currentPrime = 2; $currentPrime <= ceil(sqrt($n)); $currentPrime++) {
        // キャッシュ内の素数(p)の倍数を全て false にする
        // iは2からスタート
        if (!$cache[$currentPrime]) continue;
        $i = 2;
        $ip = $i * $currentPrime;
        while ($ip < $n) {
            $cache[$ip] = false;
            # i*pをアップデート
            $i++;
            $ip = $i * $currentPrime;
        }
    }

    // キャッシュ内の全ての true のインデックスは素数
    $primeNumbers = [];

    for ($i = 2; $i < count($cache); $i++) {
        $predicate = $cache[$i];
        if ($predicate) {
            $primeNumbers[] = $i;
        }
    }

    return $primeNumbers;
}
