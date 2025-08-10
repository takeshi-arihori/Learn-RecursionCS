# 2進数と10進数の求め方

## 概要
コンピュータは内部で2進数（バイナリ）を使用してデータを処理しています。プログラマーとして、2進数と10進数の相互変換を理解することは非常に重要です。この記事では、基本的な概念から実践的な変換方法まで詳しく解説します。

## 数値システムの基本

### 10進数（Decimal）
日常的に使用している数値システムで、0から9までの10個の数字を使用します。

- **基数（底）**: 10
- **使用数字**: 0, 1, 2, 3, 4, 5, 6, 7, 8, 9
- **位の重み**: 10の累乗（..., 10³, 10², 10¹, 10⁰）

### 2進数（Binary）
コンピュータが内部で使用する数値システムで、0と1の2個の数字のみを使用します。

- **基数（底）**: 2
- **使用数字**: 0, 1
- **位の重み**: 2の累乗（..., 2³, 2², 2¹, 2⁰）

## 10進数の理解

### 10進数の仕組み
10進数では、各桁の位置が10の累乗の重みを持ちます。

```
数値「37」の場合：
3 × 10¹ + 7 × 10⁰ = 30 + 7 = 37
```

```
数値「1234」の場合：
1 × 10³ + 2 × 10² + 3 × 10¹ + 4 × 10⁰
= 1000 + 200 + 30 + 4 = 1234
```

### 小数を含む10進数
```
数値「123.456」の場合：
1 × 10² + 2 × 10¹ + 3 × 10⁰ + 4 × 10⁻¹ + 5 × 10⁻² + 6 × 10⁻³
= 100 + 20 + 3 + 0.4 + 0.05 + 0.006 = 123.456
```

## 2進数の理解

### 2進数の仕組み
2進数では、各桁の位置が2の累乗の重みを持ちます。

```
2進数「101」の場合：
1 × 2² + 0 × 2¹ + 1 × 2⁰ = 4 + 0 + 1 = 5（10進数）
```

```
2進数「1011」の場合：
1 × 2³ + 0 × 2² + 1 × 2¹ + 1 × 2⁰
= 8 + 0 + 2 + 1 = 11（10進数）
```

### 小数を含む2進数
```
2進数「11101.1101」の場合：
1×2⁴ + 1×2³ + 1×2² + 0×2¹ + 1×2⁰ + 1×2⁻¹ + 1×2⁻² + 0×2⁻³ + 1×2⁻⁴
= 16 + 8 + 4 + 0 + 1 + 0.5 + 0.25 + 0 + 0.0625
= 29.8125（10進数）
```

## 変換方法

### 2進数 → 10進数変換

#### 基本的な方法
各桁に対応する2の累乗を計算して合計します。

```
例：2進数 1101 を 10進数に変換

位置：    3  2  1  0
数字：    1  1  0  1
重み：    8  4  2  1

計算：1×8 + 1×4 + 0×2 + 1×1 = 8 + 4 + 0 + 1 = 13
```

#### 実践例
```php
<?php
function binaryToDecimal($binary) {
    $decimal = 0;
    $length = strlen($binary);
    
    for ($i = 0; $i < $length; $i++) {
        $digit = $binary[$length - 1 - $i];
        $decimal += $digit * pow(2, $i);
    }
    
    return $decimal;
}

// テスト
$binaryNumbers = ['1101', '1010', '11111', '100000'];
foreach ($binaryNumbers as $binary) {
    $decimal = binaryToDecimal($binary);
    echo "2進数 {$binary} = 10進数 {$decimal}\n";
}
?>
```

出力：
```
2進数 1101 = 10進数 13
2進数 1010 = 10進数 10  
2進数 11111 = 10進数 31
2進数 100000 = 10進数 32
```

### 10進数 → 2進数変換

#### 除算による方法
10進数を2で割り続け、余りを記録します。

```
例：10進数 13 を 2進数に変換

13 ÷ 2 = 6  余り 1  ←最下位ビット
 6 ÷ 2 = 3  余り 0
 3 ÷ 2 = 1  余り 1
 1 ÷ 2 = 0  余り 1  ←最上位ビット

余りを下から読む：1101
```

#### 実践例
```php
<?php
function decimalToBinary($decimal) {
    if ($decimal == 0) return '0';
    
    $binary = '';
    while ($decimal > 0) {
        $binary = ($decimal % 2) . $binary;
        $decimal = intval($decimal / 2);
    }
    
    return $binary;
}

// テスト
$decimalNumbers = [13, 10, 31, 32, 255];
foreach ($decimalNumbers as $decimal) {
    $binary = decimalToBinary($decimal);
    echo "10進数 {$decimal} = 2進数 {$binary}\n";
}
?>
```

出力：
```
10進数 13 = 2進数 1101
10進数 10 = 2進数 1010
10進数 31 = 2進数 11111  
10進数 32 = 2進数 100000
10進数 255 = 2進数 11111111
```

## 小数の変換

### 2進数の小数 → 10進数

```php
<?php
function binaryDecimalToDecimal($binaryDecimal) {
    list($integerPart, $fractionalPart) = explode('.', $binaryDecimal);
    
    // 整数部分
    $decimal = binaryToDecimal($integerPart);
    
    // 小数部分
    for ($i = 0; $i < strlen($fractionalPart); $i++) {
        $digit = $fractionalPart[$i];
        $decimal += $digit * pow(2, -($i + 1));
    }
    
    return $decimal;
}

// テスト
$binaryDecimals = ['101.101', '11.01', '1.1111'];
foreach ($binaryDecimals as $binary) {
    $decimal = binaryDecimalToDecimal($binary);
    echo "2進数 {$binary} = 10進数 {$decimal}\n";
}
?>
```

### 10進数の小数 → 2進数

```php
<?php  
function decimalToBinaryDecimal($decimal, $precision = 8) {
    $integerPart = intval($decimal);
    $fractionalPart = $decimal - $integerPart;
    
    // 整数部分の変換
    $binaryInteger = decimalToBinary($integerPart);
    
    // 小数部分の変換
    $binaryFractional = '';
    for ($i = 0; $i < $precision && $fractionalPart > 0; $i++) {
        $fractionalPart *= 2;
        $bit = intval($fractionalPart);
        $binaryFractional .= $bit;
        $fractionalPart -= $bit;
    }
    
    return $binaryFractional ? $binaryInteger . '.' . $binaryFractional : $binaryInteger;
}

// テスト
$decimals = [5.625, 3.25, 1.9375];
foreach ($decimals as $decimal) {
    $binary = decimalToBinaryDecimal($decimal);
    echo "10進数 {$decimal} = 2進数 {$binary}\n";
}
?>
```

## 固定小数点と浮動小数点

### 固定小数点型
小数点以下の桁数が固定されているデータ形式です。

```
例：小数点以下4桁の固定小数点型

0.0625 = 1/16 の精度で表現可能
0.1875 = 3/16
0.3125 = 5/16
```

#### 特徴
- **精度**: 固定（例：0.0625刻み）
- **範囲**: 限定的
- **計算**: 高速
- **用途**: 金融計算、組み込みシステム

### 浮動小数点型
指数部と仮数部を使用して幅広い範囲の数値を表現します。

```
IEEE 754 単精度（32bit）の例：
符号部(1bit) + 指数部(8bit) + 仮数部(23bit)
```

#### 特徴
- **精度**: 可変（有効数字約7桁）
- **範囲**: 非常に広い
- **計算**: やや低速
- **用途**: 科学計算、一般的なプログラミング

## 実践的な応用

### ビット演算での活用
```php
<?php
// 2進数での権限管理
define('READ_PERMISSION', 1);    // 001
define('WRITE_PERMISSION', 2);   // 010  
define('EXECUTE_PERMISSION', 4); // 100

function hasPermission($userPermissions, $requiredPermission) {
    return ($userPermissions & $requiredPermission) === $requiredPermission;
}

$userPerms = READ_PERMISSION | WRITE_PERMISSION; // 011 (3)

echo "読み取り権限: " . (hasPermission($userPerms, READ_PERMISSION) ? "あり" : "なし") . "\n";
echo "書き込み権限: " . (hasPermission($userPerms, WRITE_PERMISSION) ? "あり" : "なし") . "\n";
echo "実行権限: " . (hasPermission($userPerms, EXECUTE_PERMISSION) ? "あり" : "なし") . "\n";
?>
```

### IPアドレスの変換
```php
<?php
function ipToBinary($ip) {
    $parts = explode('.', $ip);
    $binary = '';
    
    foreach ($parts as $part) {
        $binary .= str_pad(decimalToBinary($part), 8, '0', STR_PAD_LEFT) . '.';
    }
    
    return rtrim($binary, '.');
}

$ip = '192.168.1.1';
$binaryIp = ipToBinary($ip);
echo "IPアドレス: {$ip}\n";
echo "2進数: {$binaryIp}\n";
?>
```

### カラーコードの変換  
```php
<?php
function hexToBinary($hex) {
    $decimal = hexdec($hex);
    return str_pad(decimalToBinary($decimal), 8, '0', STR_PAD_LEFT);
}

$colorCodes = ['FF', '80', '00', 'A5'];
foreach ($colorCodes as $hex) {
    $binary = hexToBinary($hex);
    $decimal = hexdec($hex);
    echo "16進数: {$hex} = 10進数: {$decimal} = 2進数: {$binary}\n";
}
?>
```

## 変換表（クイックリファレンス）

| 10進数 | 2進数 | 16進数 | 備考 |
|--------|-------|--------|------|
| 0 | 0000 | 0 | |
| 1 | 0001 | 1 | |
| 2 | 0010 | 2 | |
| 3 | 0011 | 3 | |
| 4 | 0100 | 4 | |
| 5 | 0101 | 5 | |
| 8 | 1000 | 8 | 2³ |
| 15 | 1111 | F | 4ビット最大 |
| 16 | 10000 | 10 | 2⁴ |
| 32 | 100000 | 20 | 2⁵ |
| 64 | 1000000 | 40 | 2⁶ |
| 128 | 10000000 | 80 | 2⁷ |
| 255 | 11111111 | FF | 8ビット最大 |

## まとめ

### 重要なポイント
1. **基数の理解**: 10進数は基数10、2進数は基数2
2. **位の重み**: 各桁は基数の累乗の重みを持つ
3. **変換方法**: 
   - 2進数→10進数：各桁の重みを合計
   - 10進数→2進数：2で割り続けて余りを記録
4. **小数の処理**: 負の指数を使用して小数部分を表現
5. **実用性**: ビット演算、権限管理、ネットワーク等で活用

### 学習のコツ
- **パターン認識**: 2の累乗（1, 2, 4, 8, 16, ...）を覚える
- **練習**: 小さな数から始めて徐々に大きな数に挑戦
- **実践**: プログラミングでの具体的な用途を理解する
- **ツール活用**: 計算機を使って検証する

2進数と10進数の変換は、コンピュータサイエンスの基礎として非常に重要です。これらの概念をしっかりと理解することで、より効率的なプログラムの作成や、システムレベルでの理解が深まります。