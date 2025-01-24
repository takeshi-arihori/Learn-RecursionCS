<?php

/**
 * タビュレーションとメモ化の実践
 */
class TabulationAndMemo
{
    /**
     * タビュレーションとは動的計画法において、過去に解いた部分問題の結果を表に格納して問題を解く手法
     * 基本ケースから始めて目的の結果に至るまで、ボトムアップ方式を用いて問題を解く
     * 以前に解いた部分問題の結果を保存するテーブルを作成し、ループを使って、ベースケースから目的の結果までテーブルを埋めていく
     * タビュレーションは、再帰的な関数呼び出しを回避し、アルゴリズムの時間計算量を低減することを目的としている
     *
     * @param integer $n
     * @return integer
     */
    // 木構造の結果を下から上にキャッシュする方法をタビュレーションと呼ぶ
    public function tabulationFib(int $n): int
    {
        // これはキャッシュであり、計算済みのフィボナッチ数を全て保存
        $cache = array_fill(0, $n, -1);

        // fib0 は 0, fib1 は 1 であり、他のすべての数は、fib(n) = fib(n-1) + fib(n-2) を使って求めることができる
        $cache[0] = 0;
        $cache[1] = 1;

        // 反復を使って全ての数を求める
        for ($i = 2; $i <= $n; $i++) {
            $cache[$i] = $cache[$i - 1] + $cache[$i - 2];
        }

        // n番目のフィボナッチ数を返す
        return $cache[$n];
    }

    /**
     * メモ化とは、元の問題から始めて、サブ問題を順に解いていき、それぞれのサブ問題を解きながら、キャッシュやルックアップテーブルに解を保存していく方法
     * 「トップダウン」のアプローチであり、再帰的な関数呼び出しを使って問題を解く
     */
    // メモ化は、木構造の上から下へと続くアルゴリズムでのキャッシング
    // n から始まり、n-1, n-2, n-3 と下に向かって計算していく
    public function memoizationFib(int $totalFibNumbers): int
    {
        // キャッシュ内にすでに計算したフィボナッチ数を全て保存
        $cache = array_fill(0, $totalFibNumbers + 1, null);

        // ローカル関数を用いてキャッシュを更新する
        $innerMemoizationFib = function ($n) use (&$cache, &$innerMemoizationFib) {

            // キャッシュに値が保存されていないときは再起処理
            if ($cache[$n] == null) {
                if ($n == 0) {
                    $cache[$n] = 0;
                } elseif ($n == 1) {
                    $cache[$n] = 1;
                } else {
                    $cache[$n] = $innerMemoizationFib($n - 1) + $innerMemoizationFib($n - 2);
                }
            }
            // キャッシュに値が保存されているときはその値を返す
            return $cache[$n];
        };

        return $innerMemoizationFib($totalFibNumbers);
    }
}
