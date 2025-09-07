<?php

declare(strict_types=1);

namespace App\Models\Deque;

/**
 * Stack インターフェース (LIFO - Last-In First-Out)
 *
 * スタックは LIFO 形式に従うリストです。
 * 後ろにプッシュ（追加）、後ろからポップ（削除）、後ろの要素を返すピークが
 * すべて O(1) で実行できなければなりません。
 */
interface Stack
{
    /**
     * リストの最後の要素を返します（要素を削除しません）
     *
     * @return int|null 最後の要素、または空の場合はnull
     */
    public function peekLast(): ?int;

    /**
     * リストの最後の要素を削除し、削除した要素を返します
     *
     * @return int|null 削除された要素、または空の場合はnull
     */
    public function pop(): ?int;

    /**
     * 要素をリストの最後に追加します
     *
     * @param int $value 追加する値
     * @return void
     */
    public function push(int $value): void;
}
