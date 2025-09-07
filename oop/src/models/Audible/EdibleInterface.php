<?php

declare(strict_types=1);

namespace App\Models\Audible;

// Edibleという名前のインターフェースを定義します。
// 食べられるオブジェクトが持つべきメソッドを定義します。
interface EdibleInterface
{
    public function howToPrepare(): string; // 調理方法を返す
    public function calories(): float; // カロリーを返す
}
