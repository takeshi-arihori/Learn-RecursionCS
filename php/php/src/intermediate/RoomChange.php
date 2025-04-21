<?php

// 部屋替え
// Glover は定期的に部屋替えを行うルールがあるシェアハウスに住んでいます。
// くじ引きで数字をランダムに引いて、その数だけ住人が部屋をずらす仕組みです。
// 例えば、数字 2 を引いたとき、部屋番号 1 に住んでいる人は 3 に移動します。
// 住人たちの ID をまとめた ids と、くじ引きで引いた自然数 n が与えられるので、住人の位置をずらさせた配列を返す、rotateByTimes という関数を作成してください。

class RoomChange
{

    // [1, 2, 3, 4, 5], 2 => [4, 5, 1, 2, 3]
    // [3, 4, 5, 1, 2]

    // o(k)
    // deque, o(1) o(1)
    // [10,12,3,4,5],3 => [3,4,5,10,12]

    // [4,23,104,435,5002,3],26
    // 26%6 = 4, 24+2

    // 通常の解き方 O(n)
    public function rotateByTimes(array $ids, int $n): array
    {
        if ($n == 0) return $ids;
        if ($n > count($ids)) $n = $n % count($ids);
        for ($i = 0; $i < $n; $i++) array_unshift($ids, array_pop($ids));

        return $ids;
    }

    /**
     * reverseを使った解き方
     *
     * @param array $ids
     * @param integer $n
     * @return array
     */
    public function rotateByTimesReverse(array $ids, int $n): array
    {
        $r = $n % count($ids);
        if ($r == 0) return $ids;

        $l = count($ids) - 1;
        $this->reverseInPlace($ids, 0, $l);
        $this->reverseInPlace($ids, 0, $r - 1);
        $this->reverseInPlace($ids, $r, $l);

        return $ids;
    }

    /**
     * 配列を指定した範囲で反転させる
     *
     * @param array $arr
     * @param integer $start
     * @param integer $end
     * @return array
     */
    public function reverseInPlace(array &$arr, int $start, int $end): array
    {
        $middle = floor(($start + $end) / 2);

        for ($i = $start; $i <= $middle; $i++) {
            $opposite = $start + ($end - $i);
            $tmp = $arr[$i];

            $arr[$i] = $arr[$opposite];
            $arr[$opposite] = $tmp;
        }

        return $arr;
    }

    // 例: ['h','e','l','l','o']

    // swap
    // middle を手に入れる

    // $i = 1
    // ['h','e','l','l','o'] => ['o','e','l','l','h']
    // $i = 2
    // ['o','e','l','l','h'] => ['o','l','l','e','h']

    # 解き方
    // middle を手に入れる 5 => 2, 6 => 3のため floor()にて取得
    // current = i
    // opposite = l-i

}
