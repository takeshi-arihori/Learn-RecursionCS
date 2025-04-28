<?php

class RGB
{
    private $red;
    private $green;
    private $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    // カラーコードを16進数で返す
    public function getHexCode(): string
    {
        return '#' . str_pad(dechex($this->red), 2, '0', STR_PAD_LEFT)
            . str_pad(dechex($this->green), 2, '0', STR_PAD_LEFT)
            . str_pad(dechex($this->blue), 2, '0', STR_PAD_LEFT);
    }

    // カラーコードを2進数で返す
    public function getBits(): string
    {
        // カラーコードを16進数として取得（#を除去）
        $hexCode = ltrim($this->getHexCode(), '#');
        // 16進数を2進数に変換
        $binaryCode = decbin(hexdec($hexCode));
        return $binaryCode;
    }

    // カラーコードを2進数で返す（ビット演算を使用）
    public function getBitsLogic(): string
    {
        // 10進数を16進数に変換するメソッド
        $decimalToHex = function ($decimal) {
            $hexChars = '0123456789abcdef';
            $hex = '';
            do {
                $remainder = $decimal % 16;
                $hex = $hexChars[$remainder] . $hex;
                $decimal = intdiv($decimal, 16);
            } while ($decimal > 0);

            // 2桁に揃える
            return str_pad($hex, 2, '0', STR_PAD_LEFT);
        };

        // 16進数を2進数に変換するメソッド
        $hexToBinary = function ($hex) {
            $binaryMap = [
                '0' => '0000',
                '1' => '0001',
                '2' => '0010',
                '3' => '0011',
                '4' => '0100',
                '5' => '0101',
                '6' => '0110',
                '7' => '0111',
                '8' => '1000',
                '9' => '1001',
                'a' => '1010',
                'b' => '1011',
                'c' => '1100',
                'd' => '1101',
                'e' => '1110',
                'f' => '1111',
            ];
            $binary = '';
            for ($i = 0; $i < strlen($hex); $i++) {
                $binary .= $binaryMap[$hex[$i]];
            }
            return ltrim($binary, '0'); // 先頭の余分な0を削除
        };

        // RGB値を16進数に変換
        $redHex = $decimalToHex($this->red);
        $greenHex = $decimalToHex($this->green);
        $blueHex = $decimalToHex($this->blue);

        // 全体の16進数カラーコードを生成
        $hexCode = $redHex . $greenHex . $blueHex;

        // 16進数カラーコードを2進数に変換
        return $hexToBinary($hexCode);
    }


    // 赤、青、緑でどの色が濃いのかを返す
    public function getColorShade(): string
    {
        if ($this->red === $this->green && $this->green === $this->blue) return 'grayscale';

        if ($this->red < $this->green) {
            if ($this->green < $this->blue) return 'blue';
            else return 'green';
        }
        return 'red';
    }
}
