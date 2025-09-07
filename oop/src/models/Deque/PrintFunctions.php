<?php

declare(strict_types=1);

namespace App\Models\Deque;

/**
 * Print関数群クラス
 *
 * 各データ構造の要素を特定の順序で出力する静的メソッドを提供します。
 * ポリモーフィズムの実践例として、同一のオブジェクトを異なるインターフェース型で処理します。
 */
class PrintFunctions
{
    /**
     * Queue要素をFIFO順序で取り出して出力します
     *
     * @param Queue $q 出力するQueueオブジェクト
     * @return string 出力された要素の文字列表現
     */
    public static function queuePrint(Queue $q): string
    {
        $output = [];

        while (($value = $q->poll()) !== null) {
            $output[] = (string)$value;
        }

        $result = 'Queue (FIFO): ' . implode(' ', $output);
        echo $result . PHP_EOL;

        return $result;
    }

    /**
     * Stack要素をLIFO順序で取り出して出力します
     *
     * @param Stack $s 出力するStackオブジェクト
     * @return string 出力された要素の文字列表現
     */
    public static function stackPrint(Stack $s): string
    {
        $output = [];

        while (($value = $s->pop()) !== null) {
            $output[] = (string)$value;
        }

        $result = 'Stack (LIFO): ' . implode(' ', $output);
        echo $result . PHP_EOL;

        return $result;
    }

    /**
     * Deque要素を前から1つ、後ろから1つの順に交互に取り出して出力します
     *
     * @param Deque $d 出力するDequeオブジェクト
     * @return string 出力された要素の文字列表現
     */
    public static function dequePrint(Deque $d): string
    {
        $output = [];
        $fromFront = true;

        while (!self::isDequeEmpty($d)) {
            if ($fromFront) {
                $value = $d->poll(); // 前から取得
            } else {
                $value = $d->pop();  // 後ろから取得
            }

            if ($value !== null) {
                $output[] = (string)$value;
                $fromFront = !$fromFront; // 次は反対側から
            }
        }

        $result = 'Deque (alternating): ' . implode(' ', $output);
        echo $result . PHP_EOL;

        return $result;
    }

    /**
     * AbstractListInteger の全要素を順序通りに出力します
     *
     * @param AbstractListInteger $l 出力するリストオブジェクト
     * @return string 出力された要素の文字列表現
     */
    public static function abstractListIntegerPrint(AbstractListInteger $l): string
    {
        $output = [];
        $array = $l->toArray();

        foreach ($array as $value) {
            $output[] = (string)$value;
        }

        $result = 'AbstractList: [' . implode(', ', $output) . ']';
        echo $result . PHP_EOL;

        return $result;
    }

    /**
     * Dequeが空かどうかをチェックするヘルパーメソッド
     *
     * @param Deque $d チェックするDeque
     * @return bool 空の場合true
     */
    private static function isDequeEmpty(Deque $d): bool
    {
        // AbstractListIntegerを実装している場合のチェック
        if ($d instanceof AbstractListInteger) {
            return $d->isEmpty();
        }

        // peek操作で空かどうか判定
        return $d->peekFirst() === null && $d->peekLast() === null;
    }
}
