<?php

declare(strict_types=1);

namespace App\Models\Deque;

/**
 * ノードクラス（IntegerLinkedListで使用）
 */
class Node
{
    public function __construct(
        public int $value,
        public ?Node $next = null,
        public ?Node $prev = null,
    ) {
    }
}

/**
 * IntegerLinkedList クラス
 *
 * 連結リストによる実装で、Stack、Queue、Deque、AbstractListIntegerの
 * すべてのインターフェースを実装します。
 *
 * ポリモーフィズムを活用して、同一のインスタンスを異なる型として扱えます。
 */
class IntegerLinkedList implements Deque, AbstractListInteger
{
    private ?Node $head = null;
    private ?Node $tail = null;
    private int $size = 0;

    /**
     * リストのサイズ（要素数）を取得します
     *
     * @return int リストの要素数
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * リストが空かどうかを確認します
     *
     * @return bool 空の場合true、要素がある場合false
     */
    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    /**
     * 指定されたインデックスの要素を取得します
     *
     * @param int $index 取得する要素のインデックス（0ベース）
     * @return int|null 要素の値、または存在しない場合はnull
     */
    public function get(int $index): ?int
    {
        if ($index < 0 || $index >= $this->size) {
            return null;
        }

        $current = $this->head;

        for ($i = 0; $i < $index; $i++) {
            $current = $current?->next;
        }

        return $current?->value;
    }

    /**
     * リストの全要素を配列として取得します
     *
     * @return array<int> リストの全要素を含む配列
     */
    public function toArray(): array
    {
        $result = [];
        $current = $this->head;

        while ($current !== null) {
            $result[] = $current->value;
            $current = $current->next;
        }

        return $result;
    }

    /**
     * 要素をリストの最後に追加します（Stack・Queue共通操作）
     *
     * @param int $value 追加する値
     * @return void
     */
    public function push(int $value): void
    {
        $newNode = new Node($value);

        if ($this->isEmpty()) {
            $this->head = $this->tail = $newNode;
        } else {
            $newNode->prev = $this->tail;

            if ($this->tail !== null) {
                $this->tail->next = $newNode;
            }
            $this->tail = $newNode;
        }

        $this->size++;
    }

    /**
     * 要素をリストの最初に追加します（Deque独自操作）
     *
     * @param int $value 追加する値
     * @return void
     */
    public function addFirst(int $value): void
    {
        $newNode = new Node($value);

        if ($this->isEmpty()) {
            $this->head = $this->tail = $newNode;
        } else {
            $newNode->next = $this->head;

            if ($this->head !== null) {
                $this->head->prev = $newNode;
            }
            $this->head = $newNode;
        }

        $this->size++;
    }

    /**
     * リストの最後の要素を削除し、削除した要素を返します（Stack操作）
     *
     * @return int|null 削除された要素、または空の場合はnull
     */
    public function pop(): ?int
    {
        if ($this->isEmpty()) {
            return null;
        }

        $value = $this->tail?->value;

        if ($this->size === 1) {
            $this->head = $this->tail = null;
        } else {
            $this->tail = $this->tail?->prev;

            if ($this->tail !== null) {
                $this->tail->next = null;
            }
        }

        $this->size--;

        return $value;
    }

    /**
     * リストの最初の要素を削除し、削除した要素を返します（Queue操作）
     *
     * @return int|null 削除された要素、または空の場合はnull
     */
    public function poll(): ?int
    {
        if ($this->isEmpty()) {
            return null;
        }

        $value = $this->head?->value;

        if ($this->size === 1) {
            $this->head = $this->tail = null;
        } else {
            $this->head = $this->head?->next;

            if ($this->head !== null) {
                $this->head->prev = null;
            }
        }

        $this->size--;

        return $value;
    }

    /**
     * リストの最後の要素を返します（要素を削除しません）
     *
     * @return int|null 最後の要素、または空の場合はnull
     */
    public function peekLast(): ?int
    {
        return $this->tail?->value;
    }

    /**
     * リストの最初の要素を返します（要素を削除しません）
     *
     * @return int|null 最初の要素、または空の場合はnull
     */
    public function peekFirst(): ?int
    {
        return $this->head?->value;
    }
}
