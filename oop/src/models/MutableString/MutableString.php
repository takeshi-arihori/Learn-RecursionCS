<?php

declare(strict_types=1);

namespace App\Models\MutableString;

use InvalidArgumentException;

/**
 * MutableString クラス
 * 
 */
class MutableString
{
    /**
     * 内部文字列の状態を保持
     * private にして外部からの直接変更を防ぐ
     */
    private string $value;

    /**
     * コンストラクタ
     * 
     * 初期文字列を設定します。nullの場合は空文字列を設定。
     * 
     * 設計上の考慮：
     * - nullable string を受け取ることで柔軟性を提供
     * - 内部状態は常に valid な string を保証
     * - null coalescing operator (??) で安全にデフォルト値を設定
     * 
     * @param string|null $initialValue 初期文字列値（null許可）
     */
    public function __construct(?string $initialValue = null)
    {
        // null の場合は空文字列を設定
        // これにより内部状態は常に string 型を保証
        $this->value = $initialValue ?? '';
    }

    /**
     * 文字列の末尾に文字を追加
     * 
     * 不変性とのトレードオフを考慮した実装：
     * - 新しいオブジェクトを作成せず、内部状態を直接変更
     * - パフォーマンス優先：O(1) の時間複雑度で追加
     * - メモリ効率：既存の文字列バッファを再利用
     * 
     * 注意事項：
     * - このオブジェクトを他のコードで参照している場合、
     *   そのコードからも変更が見える（副作用）
     * - マルチスレッド環境では競合状態の可能性
     * 
     * @param string $c 追加する文字
     * @return void オブジェクト自体を変更（mutate）
     */
    public function append(string $c): void
    {
        // PHPの文字列結合演算子 (.=) を使用
        // 内部的にはバッファの再割り当てが発生する可能性があるが、
        // 新しいオブジェクト作成よりは効率的
        $this->value .= $c;
    }

    /**
     * 文字列表現を取得
     * 
     * __toString() マジックメソッドにより、オブジェクトを
     * 文字列として扱えるようになる
     * 
     * @return string 現在の文字列値
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * 現在の文字列値を取得（明示的メソッド）
     * 
     * __toString() とは別に、明示的に文字列値を取得するメソッド
     * IDE の型推論やドキュメント生成で有用
     * 
     * @return string 現在の文字列値
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function substring(int $startIndex, ?int $endIndex = null): MutableString
    {
        $length = strlen($this->value);

        // 開始インデックスの検証
        if ($startIndex < 0 || $startIndex > $length) {
            throw new InvalidArgumentException("Start index out of bounds: $startIndex");
        }

        if ($endIndex !== null) {
            // 終了インデックスの検証
            if ($endIndex < 0 || $endIndex > $length) {
                throw new InvalidArgumentException("End index out of bounds: $endIndex");
            }
            if ($endIndex < $startIndex) {
                throw new InvalidArgumentException("End index cannot be less than start index");
            }

            $result = substr($this->value, $startIndex, $endIndex - $startIndex);
        } else {
            $result = substr($this->value, $startIndex);
        }

        // substr が false を返す場合の安全策
        return new MutableString($result === false ? '' : $result);
    }

    public function concat(array|string|MutableString $input): void
    {
        if (is_array($input)) {
            // 配列の要素が全て文字列かどうか検証
            foreach ($input as $item) {
                if (!is_string($item)) {
                    throw new InvalidArgumentException('Array must contain only strings');
                }
            }
            $this->value .= implode('', $input);
        } elseif (is_string($input)) {
            // 文字列の場合：直接結合
            $this->value .= $input;
        } elseif ($input instanceof MutableString) {
            // MutableStringの場合：valueプロパティを結合
            $this->value .= $input->getValue();
        }
    }

    public function length(): int
    {
        // 状態を変更しない読み取り専用操作
        return strlen($this->value);
    }
}
