<?php

# 補数表現

// 補数の目的
// 1. その桁数で最大値を得るために補う数
// 2. 次の桁に繰り上がるために補う数

## 解き方
// 8bitのみ = 00000000 ~ 11111111 (0以上のプラスの数)
// 1と0だけでマイナスの数を表す方法 -> 2の補数表現
// 取り扱える情報の桁数が固定されていて、その桁数を超えた情報は消える (8bitでデータを取り扱うなら9bit目に桁上がりしたデータは消える)
// 例: 11111111 は、マイナス1である。
//  => 11111111 に 00000001 を足す
//  => 結果は 9bit目に桁上がりして100000000 になるがデータは8bitのため 9bit目の 1 が消えて 00000000 になるため。
// 上記のことからわかる2進数の表現の仕組みは、「ある数に足してゼロになる数は、もとの数のマイナスの数であるとみなせる」

// 整数型において、2 の補数表現を用いると加算で整数の減算が可能になり、正負の符号に 1 ビットを扱う方法よりもハードウェアの構成が簡単になるため広く扱われています。


// twosComplement
// onesComplement
// 1 add

// 例: "00011100"
// onesComplement => "11100011"

// "11100011" + 1
// "11100010" carryOut 1
// "11100000" carryOut 1
// "11100100" carryOut 0

// 例2: "000"
// onesComplement => "111"
// "110" carryOut 1
// "100" carryOut 1
// "000" carryOut 1
// "1000" carryOut 0



/**
 * 2の補数を計算する関数
 *
 * @param string $binary バイナリ文字列
 * @return string 2の補数のバイナリ文字列
 */
function twosComplement($binary)
{
    // 1の補数を計算
    $onesComplement = onesComplement($binary);
    $twosComplement = "";

    // 1の補数の各ビットを右から左に処理
    for ($i = strlen($onesComplement) - 1; $i >= 0; $i--) {
        // 最初に出会う '0' を '1' に変える
        if ($onesComplement[$i] === '0') {
            return substr($onesComplement, 0, $i) . '1' . $twosComplement;
        } else {
            // '1' の場合は '0' に変えて twosComplement に追加
            $twosComplement = '0' . $twosComplement;
        }
    }

    // すべてのビットが '1' の場合、先頭に '1' を追加
    return '1' . $twosComplement;
}

/**
 * 1の補数を計算する関数
 *
 * @param string $binary バイナリ文字列
 * @return string 1の補数のバイナリ文字列
 */
function onesComplement($binary)
{
    $result = '';
    // バイナリ文字列の各ビットを処理
    for ($i = 0; $i < strlen($binary); $i++) {
        // '0' を '1' に、'1' を '0' に変換
        $result .= $binary[$i] === '0' ? '1' : '0';
    }
    // 変換後の1の補数を返す
    return $result;
}
