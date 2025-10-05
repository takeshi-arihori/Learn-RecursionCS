<?php

declare(strict_types=1);

namespace App\Models\Deque;

/**
 * Deque インターフェース (両端キュー - Double-ended queue)
 *
 * Deque インターフェースは、Stack と Queue の両方から拡張されます。
 * Deque は、Stack と Queue のすべての振る舞いを持ち、
 * さらにリストの前に要素を追加する能力（addFirst）を持つインターフェースです。
 *
 * PHPでは、インターフェースの複数継承が可能です。
 */
interface Deque extends Stack, Queue
{
    /**
     * 要素をリストの最初に追加します
     *
     * @param int $value 追加する値
     * @return void
     */
    public function addFirst(int $value): void;
}
