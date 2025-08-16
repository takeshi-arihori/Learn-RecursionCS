<?php

declare(strict_types=1);

namespace App\Models\RGB;

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
            $this->red = intval(substr($hex, 0, 2), 16);
            $this->green = intval(substr($hex, 2, 2), 16);
            $this->blue = intval(substr($hex, 4, 2), 16);
        }
    }

    public function setColorsByBin(string $bin): void
    {
        if (strlen($bin) !== 24) {
            $this->setAsBlack();
        } else {
            $this->red = intval(substr($bin, 0, 8), 2);
            $this->green = intval(substr($bin, 8, 8), 2);
            $this->blue = intval(substr($bin, 16, 8), 2);
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
        return decbin(intval($this->getHex(), 16));
    }

    public function getColorShade(): string
    {
        if ($this->red === $this->green && $this->green === $this->blue) {
            return 'greyscale';
        }

        $stringTable = ['red', 'green', 'blue'];
        $values = [$this->red, $this->green, $this->blue];

        $max = $values[0];
        $maxIndex = 0;
        for ($i = 1; $i < count($values); $i++) {
            if ($max <= $values[$i]) {
                $max = $values[$i];
                $maxIndex = $i;
            }
        }

        return $stringTable[$maxIndex];
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
}