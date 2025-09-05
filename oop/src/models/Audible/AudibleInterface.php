<?php

declare(strict_types=1);

namespace App\Models\Audible;

// Audibleという名前のインターフェースを定義します。
// 音を出すオブジェクトが持つべきメソッドを定義します。
interface AudibleInterface
{
    public function makeNoise(): void;
    public function soundFrequency(): float;
    public function soundLevel(): float;
}
