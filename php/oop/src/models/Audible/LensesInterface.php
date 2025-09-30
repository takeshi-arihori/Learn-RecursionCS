<?php

declare(strict_types=1);

namespace App\Models\Audible;

interface LensesInterface
{
    /**
     * このオブジェクトが検出できる光のスペクトル範囲（nm単位）の最小値と最大値をタプル（2要素の配列）で返します。
     *
     * @return array{0: int, 1: int}
     */
    public function lightRange(): array;

    /**
     * 指定したオブジェクトを見たときに、このオブジェクトがどのように見えるかを説明する文字列を出力します。
     *
     * @param object $object
     * @return string
     */
    public function see(object $object): string;
}
