<?php

declare(strict_types=1);

namespace App\Models\Audible;

interface PhysicsObjectInterface
{
    /**
     * メートル単位の距離 m を引数として受け取り、そのオブジェクトを m メートル移動させるために必要なエネルギー（ジュール）を計算します。
     */
    public function workToMove(float $meters): float;

    /**
     * このオブジェクトの密度を返します。密度 d は質量 M と体積 V によって d = M/V で計算されます。
     * 密度は、1立方センチメートルあたりのグラム数として与えられます。
     */
    public function density(): float;

    /**
     * 重力値を受け取り、そのオブジェクトの重量（ニュートン単位 kg/m2）を、その質量と重力を掛け合わせて計算します。
     */
    public function weight(float $gravity): float;
}
