<?php

declare(strict_types=1);

namespace App\Models\Deque;

/**
 * AbstractListInteger インターフェース
 *
 * 整数を扱うリスト構造の抽象的な操作を定義します。
 * このインターフェースは、リストのサイズ取得、インデックスアクセス、
 * 配列形式での取得機能を提供します。
 */
interface AbstractListInteger
{
    /**
     * リストのサイズ（要素数）を取得します
     *
     * @return int リストの要素数
     */
    public function getSize(): int;

    /**
     * 指定されたインデックスの要素を取得します
     *
     * @param int $index 取得する要素のインデックス（0ベース）
     * @return int|null 要素の値、または存在しない場合はnull
     */
    public function get(int $index): ?int;

    /**
     * リストの全要素を配列として取得します
     *
     * @return array<int> リストの全要素を含む配列
     */
    public function toArray(): array;

    /**
     * リストが空かどうかを確認します
     *
     * @return bool 空の場合true、要素がある場合false
     */
    public function isEmpty(): bool;
}
