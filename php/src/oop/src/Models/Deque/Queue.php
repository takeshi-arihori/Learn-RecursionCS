<?php

declare(strict_types=1);

namespace App\Models\Deque;

/**
 * Queue インターフェース (FIFO - First-In First-Out)
 *
 * キューは FIFO 形式に従うリストです。
 * 後ろにエンキュー（追加）、前からデキュー（削除）、最初の要素を返すピークが必要です。
 */
interface Queue
{
    /**
     * リストの最初の要素を返します（要素を削除しません）
     *
     * @return int|null 最初の要素、または空の場合はnull
     */
    public function peekFirst(): ?int;

    /**
     * リストの最初の要素を削除し、削除した要素を返します
     *
     * @return int|null 削除された要素、または空の場合はnull
     */
    public function poll(): ?int;

    /**
     * 要素をリストの最後に追加します
     *
     * @param int $value 追加する値
     * @return void
     */
    public function push(int $value): void;
}
