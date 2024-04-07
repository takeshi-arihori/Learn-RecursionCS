# 2024 年 04 月 05 日

## 本日の目標(朝一番に確認してから学習開始)

-   **React**: 4H

-   **Algorithm**: 1H

## 目標振り返り

### React: 4H

-   **Udemy 【2023 年最新】React(v18)完全入門ガイド** sec137 ~ 159

-   Action Creator
-   Immer
    Redux では、ミュータブルに書いたものもイミュータブルとして扱われる。
-   -   immutable: 書き換えが不可(元の値は変わらない): 文字列、数値、真偽値、null、undefined、シンボル
-   -   mutable: 書き換えが可能(元の値が変わる): オブジェクト、Array
-   Immutability とは、配列などでデータの変更を行う際に、元のデータを変更せずに新しいデータを生成すること

-   副作用を使用する際は、middleware を使用する。

-   React が画面を更新する流れ

1. トリガー: 何らかの契機にレンダリングを予約すること
2. レンダリング: コンポーネントを実行すること
3. コミット: DOM への更新を行うこと

-   **Algorithm**: 1H

-   PHP
-   -   match 式 8.0 から導入された新しい構文:
        switch 分との違い

1. `===` と同じように使える
2. ブロックを抜けるための `break` が不要
3. `=>` の右辺には単一の式
4. `=>` の右辺には任意の指揮を指定できる

-   -   array_merge の特徴 (「+」で連結するのに比べて)

1. 連想配列のキーが重複している場合には、「後者」が優先される
2. インデックス「番号」が重複している場合には、新たなインデックス番号が振られるため、上書きされることはない

-   -   array_merge_recursive の特徴
        配列のキーが重複した場合に、入れ子の配列を生成する。

## 合計学習時間

-   5H

## 明日の目標（TODO 目標/できるようになりたいこと）

-   **React**: 4H
-   **TypeScript**: 2H
-   **Algorithm**: 1H