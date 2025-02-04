<?php

class Card
{
    public $suit;
    public $value;
    public $intValue;
    public function __construct(string $suit, string $value, int $intValue)
    {
        $this->suit = $suit;
        $this->value = $value;
        $this->intValue = $intValue;
    }

    // インスタンス化されたカード情報を返す関数
    public function getCardString(): string
    {
        return $this->suit . $this->value . "(" . $this->intValue . ")";
    }
}
