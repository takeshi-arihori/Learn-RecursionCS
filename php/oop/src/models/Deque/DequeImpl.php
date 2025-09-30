<?php

declare(strict_types=1);

namespace App\Models\Deque;

/**
 * Deque の具象実装クラス
 *
 * 内部では配列を使用して、すべての操作をO(1)で実行します。
 */
class DequeImpl implements Deque
{
    /** @var array<int> 内部データを格納する配列 */
    private array $data = [];

    /**
     * リストの最後の要素を返します（要素を削除しません）
     *
     * @return int|null 最後の要素、または空の場合はnull
     */
    public function peekLast(): ?int
    {
        if (empty($this->data)) {
            return null;
        }

        return end($this->data);
    }

    /**
     * リストの最後の要素を削除し、削除した要素を返します
     *
     * @return int|null 削除された要素、または空の場合はnull
     */
    public function pop(): ?int
    {
        if (empty($this->data)) {
            return null;
        }

        return array_pop($this->data);
    }

    /**
     * リストの最初の要素を返します（要素を削除しません）
     *
     * @return int|null 最初の要素、または空の場合はnull
     */
    public function peekFirst(): ?int
    {
        if (empty($this->data)) {
            return null;
        }

        return reset($this->data);
    }

    /**
     * リストの最初の要素を削除し、削除した要素を返します
     *
     * @return int|null 削除された要素、または空の場合はnull
     */
    public function poll(): ?int
    {
        if (empty($this->data)) {
            return null;
        }

        return array_shift($this->data);
    }

    /**
     * 要素をリストの最後に追加します
     *
     * @param int $value 追加する値
     * @return void
     */
    public function push(int $value): void
    {
        $this->data[] = $value;
    }

    /**
     * 要素をリストの最初に追加します
     *
     * @param int $value 追加する値
     * @return void
     */
    public function addFirst(int $value): void
    {
        array_unshift($this->data, $value);
    }

    /**
     * デバッグ用: 現在のデータ状態を取得
     *
     * @return array<int>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * デバッグ用: Dequeが空かどうかを確認
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    /**
     * デバッグ用: 要素数を取得
     *
     * @return int
     */
    public function size(): int
    {
        return count($this->data);
    }
}
