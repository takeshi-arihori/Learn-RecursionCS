
# PHPの論理演算子について

PHPには複数の論理演算子があり、条件を組み合わせたり判定したりする際に利用されます。以下にその一覧と機能を解説します。

---

## 論理演算子一覧

| 例         | 名前               | 結果                                                                 |
|------------|--------------------|----------------------------------------------------------------------|
| `$a and $b`| 論理積             | `$a` および `$b` が共に `true` の場合に `true`                      |
| `$a or $b` | 論理和             | `$a` または `$b` のどちらかが `true` の場合に `true`                |
| `$a xor $b`| 排他的論理和       | `$a` または `$b` のどちらかが `true` でかつ両方とも `true` でない場合に `true` |
| `!$a`      | 否定               | `$a` が `true` でない場合に `true`                                   |
| `$a && $b` | 論理積             | `$a` および `$b` が共に `true` の場合に `true`                      |
| `$a || $b` | 論理和             | `$a` または `$b` のどちらかが `true` の場合に `true`                |

---

## 排他的論理和 (XOR) とは？

排他的論理和 (XOR) は、2つの条件のうち「どちらか一方が `true` の場合に `true` を返す」論理演算子です。  
ただし、**両方が `true` または両方が `false` の場合には `false` を返します**。

---

### 真理値表での挙動

| `$a`  | `$b`  | `$a xor $b` | 説明                           |
|-------|-------|-------------|--------------------------------|
| true  | true  | false       | 両方が `true` の場合は `false` |
| true  | false | true        | 一方だけが `true`             |
| false | true  | true        | 一方だけが `true`             |
| false | false | false       | 両方が `false` の場合は `false`|

---

### 実例

#### イベントの発生を確認する例

```php
$eventA = true;  // イベントAが発生
$eventB = false; // イベントBが発生していない

if ($eventA xor $eventB) {
    echo "どちらか一方のイベントが発生しました。";
} else {
    echo "両方のイベントが発生したか、どちらも発生していません。";
}
```

- `$eventA = true; $eventB = false;` の場合：**"どちらか一方のイベントが発生しました。"**
- `$eventA = true; $eventB = true;` の場合：**"両方のイベントが発生したか、どちらも発生していません。"**

---

#### XORの論理を式で表す

XORは以下の式で表現できます：

```php
$a xor $b === ($a || $b) && !($a && $b);
```

---

### まとめ

排他的論理和 (XOR) は、「どちらか一方だけが成立しているか」を確認したい場合に便利です。

- **片方だけが `true` の場合に `true` を返す。**
- 両方が `true` または両方が `false` の場合は `false`。

PHPで複雑な条件判定を行う際に、ぜひXORを活用してみてください！
