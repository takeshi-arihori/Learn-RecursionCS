<?php

/************************************************************
 ************************** 関数の分解前 **********************
 ************************************************************
 */


// function calculateVolumeFromEquation(int $a, int $b, int $c): float
// {
//     /**
//      * 二次方程式の解を求める
//      */
//     // 判別式（discriminant）を計算 ( b^2 - 4ac )
//     $discriminant = $b ** 2 - 4 * $a * $c;
//     // 判別式が負の場合、実数解がないため、null を返す
//     if ($discriminant < 0) {
//         return null; // 解が実数ではない場合
//     }

//     // 判別式が非負の場合、2つの解 ( x1 ) と ( x2 ) を計算する
//     $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
//     $x2 = (-$b - sqrt($discriminant)) / (2 * $a);


//     /**
//      * 大きい方の解を選ぶ
//      */
//     // max() 関数を使って、2つの解のうち大きい方を選びます。
//     $x = max($x1, $x2);

//     /**
//      * 球の体積を計算する
//      */
//     //選ばれた解を半径として、球の体積を計算します。
//     $volume = (4 / 3) * pi() * pow($x, 3);
//     return $volume;
// }


// // 使用例
// $a = 1;
// $b = -3;
// $c = 2;
// $volume = calculateVolumeFromEquation($a, $b, $c);
// if ($volume !== null) {
//     echo "球の体積は: " . $volume;
// } else {
//     echo "実数解がありません。";
// }



/************************************************************
 ************************** 関数の分解後 **********************
 ************************************************************
 */


/**
 * * 二次方程式の解を求める
 * @param int $a 
 * @param int $b
 * @param int $c
 * @return float 二次方程式の解
 */
function solveQuadraticEquation(int $a, int $b, int $c): float
{
    return max((-$b + ($b ** 2 - 4 * $a * $c) ** 0.5) / (2 * $a), (-$b - ($b ** 2 - 4 * $a * $c) ** 0.5) / (2 * $a));
}

/**
 * 球の体積を求める
 * @param float $r
 * @return float 球の体積を計算した結果
 */
function calculateVolume(float $r): float
{
    return 4 / 3 * 3.14159 * $r ** 3;
}

function calculateVolumeFromEquation(int $a, int $b, int $c): float
{
    $r = solveQuadraticEquation($a, $b, $c);
    return calculateVolume($r);
}


// 使用例
$a = 1;
$b = -3;
$c = 2;

$volume = calculateVolumeFromEquation($a, $b, $c);
if ($volume !== null) {
    echo "球の体積は: " . $volume;
} else {
    echo "実数解がありません。";
}
