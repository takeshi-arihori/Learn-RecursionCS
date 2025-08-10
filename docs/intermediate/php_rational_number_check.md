# PHPで有理数の平方根を判定する方法

## 問題の背景

PHPで数値の平方根が整数であるかを判定する際、単純な剰余演算子（`%`）では正確な結果が得られません。これは、PHPの剰余演算子の動作が浮動小数点数に対して期待通りに機能しないためです。

## 解決策：`fmod()`関数の活用

最適な解決方法は、`fmod()`関数を使用することです。

```php
function isRationalNumber(int $number): bool {
    return fmod(sqrt($number), 1) == 0;
}
```

### 重要なポイント

- `%` 演算子は、オペランドを最初に整数に変換（小数点以下を切り捨て）してから演算を行います。
- `fmod()` 関数は、浮動小数点数の剰余を正確に計算します。
- この関数は、平方根が整数（有理数）であるかを正確に判定できます。

## 使用例

```php
echo json_encode(isRationalNumber(1));   // true
echo json_encode(isRationalNumber(4));   // true
echo json_encode(isRationalNumber(9));   // true
echo json_encode(isRationalNumber(16));  // true
echo json_encode(isRationalNumber(2));   // false
```

## 注意点

- 整数の完全平方数（1, 4, 9, 16など）のみがtrueを返します。
- 小数点以下を持つ平方根の場合はfalseを返します。
