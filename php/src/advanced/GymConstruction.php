<?php

class GymConstruction
{
    // スタックのカウントを行うメソッド
    private function stackCounter(array $arr): array
    {
        $stack = [];
        $results = array_fill(0, count($arr), 0);
        $i = 0;
        foreach ($arr as $x) {
            $total = 1;
            while (count($stack) != 0 && $arr[$stack[count($stack) - 1]] >= $x) {
                $j = array_pop($stack);
                $total += $results[$j];
            }

            $stack[] = $i;
            $results[$i] = $total;
            $i++;
        }

        return $results;
    }

    public function largestRectangle(array $h): int
    {
        $left = $this->stackCounter($h);
        $reversed = array_reverse($h);
        $right = array_reverse($this->stackCounter($reversed));
        $total = [];

        for ($i = 0; $i < count($h); $i++) {
            $total[] = ($left[$i] + $right[$i] - 1) * $h[$i];
        }

        return max($total);
    }
}
