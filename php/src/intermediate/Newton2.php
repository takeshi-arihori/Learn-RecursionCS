<?php

print("関数の合成を使ったエネルギーの計算");
print("<br>");

// 先ほどの処理を関数化しましょう。物体の重さがポンド単位で、移動する距離がメートル単位で、そして物体が存在する惑星の名前が与えられたとき、その物体を指定した距離だけ動かすのに必要なエネルギーを計算する関数を作成します。
// この関数は energyMovingPoundsByPlanet であり、物体の重さ（ポンド）、移動する距離、惑星の名前をパラメータとして受け取ります。


function forceNewtons2($kg, $mpss)
{
    return $kg * $mpss;
}

function planetGravityMpss2($planet)
{
    if ($planet == "Earth") {
        return 9.80665;
    }

    if ($planet == "Jupiter") {
        return 24.79;
    }

    if ($planet == "Neptune") {
        return 11.15;
    }

    return 0;
}

function poundsToKg2($pounds)
{
    return $pounds * 0.453592;
}

function joulesByWork2($newtons, $meters)
{
    return $newtons * $meters;
}


//　関数の合成を使って新しい関数を定義します
//　関数の合成を使うことによって、各関数が再利用可能でデバッグしやすくなり、さらにソフトウェアの複雑度を下げることができます。
//　以下の関数を関数の合成を使わずに全ての処理を入れてしまうと、関数内の処理が複雑化し、デバッグしづらく、可読性の低いコードになってしまいます。
function energyMovingPoundsByPlanet2($planet, $pounds, $meters)
{
    return joulesByWork2(forceNewtons2(poundsToKg2($pounds), planetGravityMpss2($planet)), $meters);
}

// 木星で 65lb の物体を 35m 移動するのに必要なエネルギー量を返します。
echo energyMovingPoundsByPlanet2("Jupiter", 65, 35) . PHP_EOL;
