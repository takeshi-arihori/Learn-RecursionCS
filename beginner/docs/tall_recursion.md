# 末尾再帰

コンピュータには物理制限があるため、n が大きくなるとスタックオーバーフロー（stack overflow）が発生することがあります。  
これは、ベースケースが機能せず再帰関数が無限に呼び出されたり、空間計算量が大きいこと（O(2^n) 等）が原因です。
再帰関数を末尾再帰（tail recursion）と呼ばれる特殊な形に書き換えることによって、スタックオーバーフローを回避できる場合があります。末尾再帰とは、関数内の処理の末尾で再帰呼び出しを実行する再帰のことを指します。

再帰処理の中で、「return 再帰関数」という形で、再帰処理が全ての処理の最後に行われるものを末尾再帰と言います。例えば

```python
def f():
    return f()
```

このような末尾再帰では、関数が「f -> f -> ... -> f -> return 値」という流れで実行され、呼び出し元の関数に戻る必要がないため、通常の再帰計算よりも速く実行されます。

一方、「return c + 再帰関数」のような形は末尾再帰ではありません。これは関数呼び出し後に「+」演算子が実行されるため、再帰処理が関数の最後の処理になっていないからです。このタイプは「ヘッド再帰」と呼ばれます。

末尾再帰を利用する際には、計算の途中結果を保存するために蓄積値を表す引数を追加することがよくあります。そのために補助関数を使って、元の関数に引数を追加し、補助関数内で再帰処理を行います。

末尾呼び出し最適化（Tail Call Optimization）を利用することで、空間計算量を圧倒的に削減できます。末尾呼び出し最適化では、関数は自身を pop し、次の関数を同じフレーム内に push し、全ての計算を完結することができるため、空間計算量は O(1) になります。

例えば、PHP での末尾再帰の例を以下に示します。

```php
function factorial($n, $acc = 1) {
    if ($n <= 1) {
        return $acc;
    }
    return factorial($n - 1, $n * $acc);
}

echo factorial(5); // 120
```

この例では、`factorial` 関数が末尾再帰を利用しており、計算の途中結果を蓄積値 `$acc` に保存しています。これにより、スタックオーバーフローを回避し、効率的に計算を行うことができます。

## フィボナッチの例

```zsh
<?php
// 末尾再帰を使って、n 番目のフィボナッチを返す関数を作成します
function fibonacciNumberTailHelper($fn1, $fn2, $n){
    if($n < 1) {
        return $fn1;
    }

    return fibonacciNumberTailHelper($fn2, $fn1+$fn2, $n-1);
}

function fibonacciNumberTail($n){
    // 補助関数を使用し、初期値 0, 1 を追加します
    return fibonacciNumberTailHelper(0,1,$n);
}

echo fibonacciNumberTail(6). PHP_EOL;
echo fibonacciNumberTail(10). PHP_EOL;
```

また末尾再帰によって、自身を n 回呼び出すだけで n 項目を求めることができるようになったので、時間計算量が O(2^n) から O(n) に大幅に削減されました。空間計算量は O(n) から O(1) へ削減することができました。これがアルゴリズムのパワーです。`fibonacciNumber` と `fibonacciNumberTail` の計算量を比較してみましょう。

`fibonacciNumber`

-   時間計算量: O(2^n)
-   空間計算量: O(n)

`fibonacciNumberTail`

-   時間計算量: O(n)
-   空間計算量: O(1)
