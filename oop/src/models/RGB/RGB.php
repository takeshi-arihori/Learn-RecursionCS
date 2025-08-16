<?php

namespace App\Models\Rgb;

/**
 * RGBクラスはRGB色空間を表現するクラス
 */
class RGB {
    // 赤、青、緑の色成分を保持する。値の範囲は0から255
    private int $red;
    private int $green;
    private int $blue;

    // RGB色成分を直接指定するコンストラクタ
    public function __construct(int $red, int $green, int $blue) {
        $this->red = $this->clamp($red);
        $this->green = $this->clamp($green);
        $this->blue = $this->clamp($blue);
    }

    /**
     * 赤成分の値を取得
     */
    public function getRed(): int
    {
        return $this->red;
    }

    /**
     * 緑成分の値を取得
     */
    public function getGreen(): int
    {
        return $this->green;
    }

    /**
     * 青成分の値を取得
     */
    public function getBlue(): int
    {
        return $this->blue;
    }

    /**
     * 16進数文字列として色を取得
     */
    public function toHex(): string
    {
        return sprintf('#%02X%02X%02X', $this->red, $this->green, $this->blue);
    }

    /**
     * 文字列表現を取得
     */
    public function __toString(): string
    {
        return sprintf('rgb(%d, %d, %d)', $this->red, $this->green, $this->blue);
    }

    /**
     * 他のRGBオブジェクトと加算
     */
    public function add(RGB $other): RGB
    {
        return new RGB(
            $this->red + $other->red,
            $this->green + $other->green,
            $this->blue + $other->blue
        );
    }

    /**
     * 他のRGBオブジェクトから減算
     */
    public function subtract(RGB $other): RGB
    {
        return new RGB(
            $this->red - $other->red,
            $this->green - $other->green,
            $this->blue - $other->blue
        );
    }

    /**
     * 他のRGBオブジェクトと等しいかどうかを判定
     */
    public function equals(RGB $other): bool
    {
        return $this->red === $other->red 
            && $this->green === $other->green 
            && $this->blue === $other->blue;
    }

    /**
     * 値を0-255の範囲に制限
     */
    private function clamp(int $value): int
    {
        return max(0, min(255, $value));
    }
}
