# 大きい数の結果が求められる理由

このプログラムは、1 と 2 を足し合わせて、ある数 `x` を作る方法の数を計算します。

例えば：

-   `x = 3` の場合、次の方法があります：
    -   `1 + 1 + 1`
    -   `1 + 2`
    -   `2 + 1`
        合計 **3 通り** です。

---

## コードの該当部分の動き

```javascript
for (let i = 3; i <= x; i++) {
    cache[i] = cache[i - 1] + cache[i - 2];
}
```

このループでは、次のように **1 つずつ計算を積み上げていく** 仕組みになっています。

---

## 具体例：`x = 6` の場合

1. **初期状態**  
   `cache[1] = 1`  
   `cache[2] = 2`

2. **ループで計算**

    - `i = 3` のとき：

        ```javascript
        cache[3] = cache[2] + cache[1] = 2 + 1 = 3
        ```

        `cache = {1: 1, 2: 2, 3: 3}`

    - `i = 4` のとき：

        ```javascript
        cache[4] = cache[3] + cache[2] = 3 + 2 = 5
        ```

        `cache = {1: 1, 2: 2, 3: 3, 4: 5}`

    - `i = 5` のとき：

        ```javascript
        cache[5] = cache[4] + cache[3] = 5 + 3 = 8
        ```

        `cache = {1: 1, 2: 2, 3: 3, 4: 5, 5: 8}`

    - `i = 6` のとき：
        ```javascript
        cache[6] = cache[5] + cache[4] = 8 + 5 = 13
        ```
        `cache = {1: 1, 2: 2, 3: 3, 4: 5, 5: 8, 6: 13}`

3. **結果を返す**  
   最終的に `cache[6]` が **13** になり、答えとして返されます。

---

## なぜ大きい数でも計算できる？

-   **前の結果を使うから効率的**  
    例えば、`x = 100` の場合でも、`cache[99]` と `cache[98]` の計算結果だけを使って `cache[100]` を求めます。

    -   計算を 1 からやり直す必要がないので、どんなに大きな `x` でも計算が速いです。

-   **計算の仕組みは変わらない**  
    ループはただ「前の 2 つの結果を足す」ことを繰り返しているだけなので、数が大きくなっても正確に計算できます。

---

## 試してみよう：`x = 10`

この場合、以下のように計算が進みます。

| `i` | `cache[i - 1]` | `cache[i - 2]` | `cache[i]` |
| --- | -------------- | -------------- | ---------- |
| 3   | 2              | 1              | 3          |
| 4   | 3              | 2              | 5          |
| 5   | 5              | 3              | 8          |
| 6   | 8              | 5              | 13         |
| 7   | 13             | 8              | 21         |
| 8   | 21             | 13             | 34         |
| 9   | 34             | 21             | 55         |
| 10  | 55             | 34             | 89         |

結果は `cache[10] = 89` です。

---

## 結論

-   大きい数でも計算が正確に行えるのは、**前の結果を効率的に再利用**しているからです。
-   この仕組みは「フィボナッチ数列」と同じ考え方で、数が大きくなっても問題ありません。