<?php

declare(strict_types=1);

namespace App\Models\Audible;

// Audibleという名前のインターフェースを定義します。
// 音を出すオブジェクトが持つべきメソッドを定義します。
interface AudibleInterface
{
    public function makeNoise(): void; // 音を出す
    public function soundFrequency(): float; // 音の周波数を返す
    public function soundLevel(): float; // 音の音量を返す
}
