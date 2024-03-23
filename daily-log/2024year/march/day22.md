# 2024 年 03 月 22 日

## 本日の目標(朝一番に確認してから学習開始)

-   **React, TypeScript**: 3H

## 目標振り返り

### React, TypeScript: 2H

-   **Udemy**
-   props のルール

1. props の流れは一方通行(親から子)
2. props は読み取り専用
   props が読み取り専用であることを確認する方法:
   Object.getOwnPropertyDescriptor() メソッドを使用して、props が読み取り専用であることを確認できる。
   console.log の結果:

```
configurable: false // 設定可能でない
enumerable:true // 列挙可能
value:"" // 値
writable:false // 書き込み可能でない

```

-   React 17 以前の JSX から JavaScript への変換プロセス
    `[JSXコード] → [Babel変換] → React.createElement()呼び出し`

    1. 開始点: JSX コード。これは、HTML に似た構文を使い、React エレメントを宣言します。
    2. 変換ステップ: Babel は JSX 構文を解析し、React.createElement()関数呼び出しに変換します。この関数は、タイプ（例えば div や span）、プロパティ（props）、そして子要素を引数として受け取ります。
    3. 結果: 生成された JavaScript コード。このコードは、React ライブラリを使ってブラウザで実行可能な形式です。

-   React 17 以降の JSX から JavaScript への変換プロセス
    `[JSXコード] → [Babel変換] → _jsx() / _jsxs()呼び出し`

    1.  開始点: JSX コード。React 17 以前と同じく、HTML に似た構文です。
    2.  変換ステップ: React 17 以降では、Babel は新しい JSX 変換を利用します。これにより、React.createElement()の代わりに\_jsx()や\_jsxs()関数呼び出しへと変換されます。これらの関数は react/jsx-runtime からインポートされ、パフォーマンスの向上とバンドルサイズの削減を目的としています。
    3.  結果: 生成された JavaScript コードは、以前と同様にブラウザで実行可能ですが、内部的な処理が最適化されています。

-   **RecursionCS React**
-   デストラクチャリング (分割代入)
-   イベントハンドリング(1)
    イベントの認識:ウェブページ上でユーザーが行う操作、例えばボタンをクリックしたり、マウスを動かしたり、キーボードを操作したりすることは全てイベントと認識される。
    「合成イベント」:React の独自のイベントシステム。ブラウザ間の差異を抽象化し、すべてのブラウザで一貫したイベント処理を可能にする。実際のブラウザのイベントをラップしていて、React のイベントハンドラ内でブラウザ固有の挙動を心配することなく、イベントを扱えるように設計されている。

    -   -   onClick: クリックイベント
    -   -   onChange, onSubmit: フォームの入力や送信に関するイベント
    -   -   onSubmit: フォームの送信時に発生するイベント

-   イベントハンドリング(2)
-   -   onMouseOver、onMouseOut、onMouseMove: マウスカーソルが要素に乗ったり離れたり、移動したりするときに発生するイベント

## 合計学習時間

-   2H

## 明日の目標（TODO 目標/できるようになりたいこと）

-   **React, TypeScript**: 9H
-   **読書**: 1H

Diving deeper into the React mechanism. Before React 17, there were several performance improvements and simplification methods that couldn't be achieved with the React.createElement transpiler. Therefore, starting from React 17, two new entry points have been introduced.
