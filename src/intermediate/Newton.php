<?php

// 惑星 planet に存在する質量 m の物体に働く重力の大きさを計算してみます。
// F[N] を物体に働く力、m[kg] を物体の質量、a[m/s2] を物体に働く加速度とすると、惑星上での物体に働く重力の大きさは、運動方程式 F = ma によって求めることができます。
// 例えば、地球に存在する 100[kg] の物体 X に働く重力を計算してみます。地球の重力加速度は 9.8[m/s2] なので、物体の X の重量は 100 × 9.8 = 980[N] になります。
// それでは、同じ物体が月面に存在する場合を考えましょう。月の重力加速度は 1.6[m/s2] なので、物体 X の重量は 100 × 1.6 = 160[N] になります。
// 月の重力は地球の重力の約 1/6 であるため、物体をある高さから落下させたとき、月では物体がはるかにゆっくり落ちていくことになります。
// ただし、変わっているのはあくまでも重量（重さ）であって、質量は変わらないことに注意してください。

// f = m * a
// 物体に働く力 = 質量 * 加速度
function forceNewtons(float $kg, float $mpss): float
{
    return $kg * $mpss;
}

// 地球上で質量 80kg の物体には 784N の重力がかかります。
// 地球の重力加速度は 9.807
echo forceNewtons(80, 9.807);
echo "<br>";

// 惑星名 planet を文字列で受け取り、重力加速度を返す関数を定義します。
// デフォルトで無重力とします。
function planetGravityMpss(string $planet): float
{
    switch ($planet) {
        case "Earth":
            return 9.80665;
        case "Jupiter":
            return 24.79;
        case "Neptune":
            return 11.15;
        default:
            return 0;
    }
}

echo planetGravityMpss("Neptune");
echo "<br>";



// 関数を合成します。
// 関数の呼び出しが出力がデータを返すとき、データとして扱われるのでそれを別の関数の入力として使用することができます。

// 地球上で質量 80kg の物体に働く重力
echo forceNewtons(80, 9.80665);
echo "<br>";
echo forceNewtons(80, planetGravityMpss("Earth"));
echo "<br>";
// 木星上で質量 80kg の物体に働く重力
echo forceNewtons(80, planetGravityMpss("Jupiter"));
echo "<br>";
// 海王星上で質量 100kg の物体に働く重力を計算してみましょう。(1115)
echo forceNewtons(100, planetGravityMpss("Neptune"));
echo "<br>";
// 無重力状態の質量 100kg の物体の重さを計算してみましょう。(0)
echo forceNewtons(100, planetGravityMpss(""));
echo "<br>";



// ポンドを受け取ってキログラムを返す関数 poundsToKg を新しく定義します
// ポンド * 0.453592 = キロ
function poundsToKg($pounds)
{
    return $pounds * 0.453592;
}

// 海王星上の 80 キロの物体に働く力
echo forceNewtons(80, planetGravityMpss("Neptune"));
echo "<br>";
// 海王星上の 80 ポンドの物体に働く力
echo forceNewtons(poundsToKg(80), planetGravityMpss("Neptune"));
echo "<br>";
// 木星上の 100 ポンドの物体に働く重力を計算してみましょう(1124.454568)
echo forceNewtons(poundsToKg(100), planetGravityMpss("Jupiter"));
echo "<br>";
// 地球上の 55 ポンドの物体に働く重力を計算してみましょう(244.651989274)
echo forceNewtons(poundsToKg(55), planetGravityMpss("Earth"));
echo "<br>";


// エネルギーの計算
// ニュートン * メートルによって、ジュールを求めることができます。
function joulesByWork($newtons, $meters)
{
    return $newtons * $meters;
}


// 地球上で質量 80kg の物体に働く重力[N]
echo forceNewtons(80, planetGravityMpss("Earth"));
echo "<br>";

// 地球上で 80kg を 10m 移動するのに必要なエネルギー量[J]
echo joulesByWork(forceNewtons(80, planetGravityMpss("Earth")), 10);
echo "<br>";

// 地球上で 80lb(ポンド) を 10m 移動するのに必要なエネルギー量
echo joulesByWork(forceNewtons(poundsToKg(80), planetGravityMpss("Earth")), 10);
echo "<br>";


// 海王星上で 10kg を 100m 移動するのに必要なエネルギー量を計算してください。(11150)
echo joulesByWork(forceNewtons(10, planetGravityMpss("Neptune")), 100);
echo "<br>";

// 地球上で 50lb を 100m 移動するのに必要なエネルギー量を計算してください。(22241.089934)
echo joulesByWork(forceNewtons(poundsToKg(50), planetGravityMpss("Earth")), 100);
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
