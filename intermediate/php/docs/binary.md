# 2進数と浮動小数点型 - 中級編

## 📖 基礎学習

2進数の基本的な概念と変換方法については、**初級コース**で詳しく解説されています：
> 参照: [beginner/php/docs/binary_decimal_conversion.md](../../beginner/php/docs/binary_decimal_conversion.md)

このドキュメントでは、中級レベルの浮動小数点型の詳細について学習します。

## 🔢 浮動小数点型の種類と特徴

### float型（単精度浮動小数点）
- **ビット数**: 32bit
- **有効桁数**: 約7桁
- **指数部**: 8bit
- **仮数部**: 23bit
- **符号部**: 1bit

#### 表現の範囲
- **負の値**: -3.4 × 10³⁸ から -1.2 × 10⁻³⁸
- **ゼロ**: 0
- **正の値**: 1.2 × 10⁻³⁸ から 3.4 × 10³⁸

### double型（倍精度浮動小数点）
- **ビット数**: 64bit
- **有効桁数**: 約15桁
- **指数部**: 11bit
- **仮数部**: 52bit
- **符号部**: 1bit

#### 表現の範囲
- **負の値**: -1.8 × 10³⁰⁸ から -2.2 × 10⁻³⁰⁸
- **ゼロ**: 0
- **正の値**: 2.2 × 10⁻³⁰⁸ から 1.8 × 10³⁰⁸

## ⚠️ 浮動小数点型の誤差問題

### 基本的な誤差例
初級では、浮動小数点型を用いることで少ないビットで膨大な数を扱えることを学びました。しかし、ビットパターンが限られているため、簡単な計算でも誤差が生じます。

```php
<?php
echo 0.1 + 0.2; // 0.30000000000000004 を出力
echo "\n";
echo (0.1 + 0.2) === 0.3 ? "等しい" : "等しくない"; // "等しくない"
?>
```

### 誤差の原因
2進数では多くの10進小数を正確に表現できません：
- `0.1` (10進) = `0.0001100110011...` (2進・無限循環)
- `0.2` (10進) = `0.001100110011...` (2進・無限循環)

## 💡 浮動小数点誤差の対処法

### PHP での対処方法

```php
<?php
// 誤差を考慮した比較
function floatEqual($a, $b, $epsilon = 0.00001) {
    return abs($a - $b) < $epsilon;
}

$result = 0.1 + 0.2;
echo floatEqual($result, 0.3) ? "ほぼ等しい" : "等しくない"; // "ほぼ等しい"

// BCMath拡張を使った高精度計算
$a = '0.1';
$b = '0.2';
$result = bcadd($a, $b, 10); // 小数点以下10桁まで
echo $result; // "0.3000000000"
?>
```

### 実用的な例

```php
<?php
// 金融計算での応用
class Money {
    private $cents;
    
    public function __construct($dollars) {
        // ドルをセント単位で内部保存（誤差を避けるため）
        $this->cents = intval(round($dollars * 100));
    }
    
    public function add($other) {
        $newMoney = new Money(0);
        $newMoney->cents = $this->cents + $other->cents;
        return $newMoney;
    }
    
    public function getDollars() {
        return $this->cents / 100.0;
    }
}

$price1 = new Money(0.1);
$price2 = new Money(0.2);
$total = $price1->add($price2);
echo $total->getDollars(); // 正確に 0.3
?>
```

## 🔤 文字と文字列の内部表現

### 言語による文字型の違い

| 言語 | 文字型 | ビット数 | エンコーディング | 特徴 |
|------|--------|----------|------------------|------|
| **PHP** | なし | - | UTF-8 | 文字列として扱う |
| **JavaScript** | なし | 16bit | UTF-16 | 内部はUTF-16 |
| **Python** | なし | - | Unicode | str型で統一 |
| **Java** | char | 16bit | UTF-16 | 算術演算可能 |
| **C++** | char | 8bit | ASCII/UTF-8 | バイト単位 |

### Javaの文字型の特殊性

Javaでは`char`型は16ビット（2バイト）の符号なし整数でUnicodeコードポイントを表します：

```java
// 文字と数値の直接比較
char letter = 'A';
int ascii = 65;
System.out.println(letter == ascii); // true

// 文字での算術演算
char a = 'A';
char z = (char)(a + 25); // 'Z'
```

## 💾 メモリとデータ表現の中級理解

### メモリレイアウトの詳細

**メモリセル**: コンピュータが1バイト単位でデータを格納する最小単位
- 各セルは固有のメモリアドレスを持つ
- アドレスは16進数で表現（例：0xFF1234A0）
- PHPは自動メモリ管理により、直接アクセスは制限される

### データ型によるメモリ使用量

```php
<?php
// PHPでのメモリ使用量確認
echo "整数: " . memory_get_usage() . " bytes\n";
$int = 12345;
echo "整数後: " . memory_get_usage() . " bytes\n";

echo "文字列: " . memory_get_usage() . " bytes\n";
$string = "Hello World";
echo "文字列後: " . memory_get_usage() . " bytes\n";

echo "配列: " . memory_get_usage() . " bytes\n";
$array = [1, 2, 3, 4, 5];
echo "配列後: " . memory_get_usage() . " bytes\n";
?>
```

### 文字列のメモリ配置例

| アドレス | データ | 文字 | 説明 |
|----------|--------|------|------|
| 0x1234 | 0x48 | 'h' | UTF-8: 72 |
| 0x1235 | 0x65 | 'e' | UTF-8: 101 |
| 0x1236 | 0x6C | 'l' | UTF-8: 108 |
| 0x1237 | 0x6C | 'l' | UTF-8: 108 |
| 0x1238 | 0x6F | 'o' | UTF-8: 111 |
| 0x1239 | 0x00 | null | 文字列終端 |

## 🔧 中級レベルでの言語特性比較

### 型システムとメモリ管理

| 言語 | 型付け | メモリ管理 | 変数宣言 | 定数宣言 | パフォーマンス |
|------|--------|------------|----------|-----------|----------------|
| **C++** | 静的 | 手動 | 型名必須 | `const` | 最高 |
| **Java** | 静的 | GC | 型名必須 | `final` | 高 |
| **PHP** | 動的 | GC | `$` | `const` | 中 |
| **JavaScript** | 動的 | GC | `let/var` | `const` | 中 |
| **Python** | 動的 | GC | なし | なし | 低 |

### 実践的な型変換例

```php
<?php
// PHP の柔軟な型変換
$str = "123";
$num = 456;

echo $str + $num;        // 579 (自動的に数値変換)
echo $str . $num;        // "123456" (文字列結合)
echo (int)$str;          // 123 (明示的型変換)
echo (string)$num;       // "456" (明示的型変換)

// 型の確認
echo gettype($str);      // "string"
echo is_numeric($str);   // true
?>
```

## 📚 中級学習のまとめ

### 重要な概念
1. **浮動小数点誤差**: 実数計算での精度問題とその対処法
2. **メモリ効率**: データ型選択がメモリ使用量に与える影響
3. **型システム**: 静的型付けと動的型付けの利点・欠点
4. **エンコーディング**: 文字データの内部表現方式

### 次のステップ
- **上級コース**: ビット演算、アルゴリズム最適化
- **実践応用**: データベース設計、API開発
- **パフォーマンス**: プロファイリング、メモリ最適化

> **関連学習**: 詳細な2進数変換については [beginner/php/docs/binary_decimal_conversion.md](../../beginner/php/docs/binary_decimal_conversion.md) を参照してください。
