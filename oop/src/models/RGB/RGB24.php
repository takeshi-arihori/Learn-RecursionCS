<?php

declare(strict_types=1);

namespace App\Models\Rgb;

class RGB24
{
    private int $red;
    private int $green;
    private int $blue;

    public function __construct(int|string $redOrInputString, ?int $green = null, ?int $blue = null)
    {
        if (is_string($redOrInputString)) {
            $this->initFromString($redOrInputString);
        } elseif ($green !== null && $blue !== null) {
            $this->red = $redOrInputString;
            $this->green = $green;
            $this->blue = $blue;
        } else {
            $this->setAsBlack();
        }
    }

    private function initFromString(string $inputString): void
    {
        $length = strlen($inputString);

        if ($length === 6) {
            $this->setColorsByHex($inputString);
        } elseif ($length === 24) {
            $this->setColorsByBin($inputString);
        } else {
            $this->setAsBlack();
        }
    }

    public function setColorsByHex(string $hex): void
    {
        if (strlen($hex) !== 6) {
            $this->setAsBlack();
        } else {
            $this->red = hexdec(substr($hex, 0, 2));
            $this->green = hexdec(substr($hex, 2, 2));
            $this->blue = hexdec(substr($hex, 4, 2));
        }
    }

    public function setColorsByBin(string $bin): void
    {
        if (strlen($bin) !== 24) {
            $this->setAsBlack();
        } else {
            $this->red = bindec(substr($bin, 0, 8));
            $this->green = bindec(substr($bin, 8, 8));
            $this->blue = bindec(substr($bin, 16, 8));
        }
    }

    public function setAsBlack(): void
    {
        $this->red = 0;
        $this->green = 0;
        $this->blue = 0;
    }

    public function getHex(): string
    {
        $hex = dechex($this->red);
        $hex .= dechex($this->green);
        $hex .= dechex($this->blue);

        return $hex;
    }

    public function getBits(): string
    {
        return decbin(hexdec($this->getHex()));
    }

    public function getColorShade(): string
    {
        if ($this->red === $this->green && $this->green === $this->blue) {
            return 'greyscale';
        }

        $colors = ['red' => $this->red, 'green' => $this->green, 'blue' => $this->blue];
        return array_keys($colors, max($colors))[0];
    }

    public function __toString(): string
    {
        return sprintf(
            'The color is rgb(%d,%d,%d). Hex: %s, binary: %s',
            $this->red,
            $this->green,
            $this->blue,
            $this->getHex(),
            $this->getBits()
        );
    }

    public function getRed(): int
    {
        return $this->red;
    }

    public function getGreen(): int
    {
        return $this->green;
    }

    public function getBlue(): int
    {
        return $this->blue;
    }
}