
# PHPで`float`と`double`の違いを理解する

PHPで`gettype`を使うと、浮動小数点数の型として`double`が表示されるのに対し、
型宣言では`float`を使用します。この違いについて解説します。

---

## `gettype`で`double`が返る理由

### 背景
1. **PHPの内部表現**  
   - PHPはC言語で実装されています。
   - C言語では、浮動小数点数の型を`double`として定義します。
   - そのため、PHPの浮動小数点数も内部的には`double`として扱われています。

2. **歴史的な経緯**  
   - 初期のPHPでは、浮動小数点数の型を「`double`」として参照していました。
   - 後に、プログラミングの一般的な慣習に合わせて、ドキュメントや型宣言では「`float`」を使うように統一されました。

3. **互換性のための仕様**  
   - `gettype`関数は古いバージョンから存在しており、互換性を保つために現在でも浮動小数点数の型を`double`として返します。

---

## 型宣言と`gettype`の違い

### 型宣言 (`float`)
PHPの型宣言（例: `function foo(): float`）では、現代的なプログラミング言語の標準に従い、
浮動小数点数を`float`として扱います。

### `gettype` の出力 (`double`)
一方、`gettype`はPHPの内部実装をそのまま反映するため、古い名称である`double`を返します。

---

## 実例

```php
<?php

$value = 3.14;

// 型を確認
echo gettype($value); // 出力: double

// 型宣言を使った関数
function calculateCircleArea(float $radius): float {
    return pi() * $radius ** 2;
}

echo calculateCircleArea($value); // 正常に動作
```
このように、`gettype`の結果が`double`であっても、型宣言の`float`と同じ型を指しています。

---

## まとめ

- **型宣言 (`float`)**: 現代的で、開発者が理解しやすい標準的な名前。
- **`gettype` の出力 (`double`)**: PHPの内部実装と歴史的な経緯を反映した名前。

どちらも同じ浮動小数点数を指しており、実際には区別する必要はありません。
「`float`」は開発者向けのわかりやすい名前、「`double`」は内部仕様を反映した名前と考えるとよいでしょう。
