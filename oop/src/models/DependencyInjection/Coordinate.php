<?php

namespace App\Models\DependencyInjection;

/**
 * 座標クラス
 * 生物の座標を管理します
 */
class Coordinate
{
    /** @var int X座標 */
    public int $x;

    /** @var int Y座標 */
    public int $y;

    /** @var int Z座標 */
    public int $z;

    /**
     * 座標を初期化
     * 
     * @param int $x X座標
     * @param int $y Y座標
     * @param int $z Z座標
     */
    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * 座標を文字列として表現
     * 
     * @return string 座標の文字列表現
     */
    public function __toString(): string
    {
        return "{x:" . $this->x . ",y:" . $this->y . ",z:" . $this->z . "}";
    }
}
