# 2024 年 03 月 30 日

## 本日の目標(朝一番に確認してから学習開始)

-   **React**: 8H
-   **Algorithm**: 1H
-   **読書**: 1H

## 目標振り返り

### React: 8H

-   **Udemy 【2023 年最新】React(v18)完全入門ガイド**

セクション 8: React で DOM 操作を行う方法

-   useRef の仕組み: ref オブジェクトを生成、current プロパティに 対して ref 属性で渡した際に、値を取得できる。
-   他のコンポーネントに対して ref を渡し、その ref 属性 を親コンポーネントから子コンポーネントに渡して DOM を操作。
-   current には、ref 属性で渡した値が格納されるため、意図しない挙動になる可能性がある。-> 解決: useImparativeHandle で制御する。

-   ref を使った DOM 操作

1. ref オブジェクトを生成
   `const inputRef = useRef(null);`

2. 操作したい DOM に対応する JSX の ref 属性に渡す
   `<input ref={inputRef} />`

3. React は DOM への参照を inputRef.current に格納する

4. イベントハンドラなどで DOM にアクセスする
   `inputRef.current.focus();`

5. イベントハンドラを<button>のクリックイベントなどで発火させる

-   他のコンポーネントの DOM の操作
    React のデフォルトでは、コンポーネントが他のコンポーネントの DOM にアクセスすることはできない。アクセスされる側のコンポーネントがそれを許すかどうかを決めることができる。`forwardRef` を使って、親コンポーネントから子コンポーネントに ref を渡すことでアクセス許可を与えることができる。

-   useRef の使用上の注意

1. Ref はレンダリングに使用しない値を保持するための逃げ道である。頻繁に使わない。
2. レンダリング中は ref.current を参照・変更してはならない。(画面描写に必要なものを入れない)
3. DOM を手動で追加・削除する場合は React の 機能で基本は対処する

-   useImperativeHandle の使用
    forwardRef と共に使用。親から受け取った ref オブジェクトをカスタマイズできる。

-   debug

    -   React Developer Tools
    -   -   ルートコンポーネント・サブコンポーネントが表示される
    -   -   ツリーでコンポーネントを一つ選択すると、右側のパネルで現在の props と state をチェック、修正できる。
    -   -   レンダリングの箇所を確認できる
    -   React Profiler
    -   -   レンダリングのパフォーマンス情報を記録できる。

-   関数型プログラミングの重要なキーワード

1. 状態管理と処理を分離
2. 純粋関数 (副作用を排除する)
3. 不変性(Immutability)

-   useState と useReducer の違いや使い方について

1. useState:状態の更新の仕方は利用側に託す。
2. useReducer:状態の更新の仕方も状態側で担当する。

### Algorithm: 1H

-   [RecursionCS 再帰関数](https://recursionist.io/dashboard/course/2/lesson/133)

-   文字列の圧縮 [medium]

### TypeScript: 1H

-   **「プロを目指す人のための TypeScript」**

sec01, 02 環境構築、基本の型

## 合計学習時間

-   10H

## 明日の目標（TODO 目標/できるようになりたいこと）

-   **React**: 8H
-   **Algorithm**: 1H
-   **読書**: 1H
