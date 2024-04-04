# 2024 年 03 月 31 日

## 本日の目標(朝一番に確認してから学習開始)

-   **React**: 2H
-   **Algorithm**: 1H
-   **読書**: 1H

## 目標振り返り

### React: 2H

-   **Udemy 【2023 年最新】React(v18)完全入門ガイド**

-   useState: 状態の更新の仕方は利用側に託す。
    複数人で開発をしている際、state だけを定義されていると、それぞれの開発者は何のための state なのかわからない。(思わぬバグが発生する可能性がある。)

-   useReducer: 状態の更新の仕方も状態側で担当する。
    更新の状態・管理も状態側で行うことができるので、利用する側も使いやすい。アクションの中に渡したい値を含めることもできる。

-   useContext とレンダリングの関係
-   -   課題:
        アプリケーションが大きくなってくると、useContext()を使用してステートを変更すると、ステートを使っているすべてのコンポーネントは再レンダリングされる。(パフォーマンスに影響が出る可能性がある)
-   -   解決:
        更新関数とステートを保持するコンテキストを別々に保持し、それぞれ必要なコンポーネントに渡すことで、再レンダリングを抑えることができる。

### Algorithm: 1H

-   整数上の平方根 [easy]
-   素数（再帰） [medium]

## 合計学習時間

-   3H

## 明日の目標（TODO 目標/できるようになりたいこと）

-   **React**: 2H
-   **TypeScript**: 2H
-   **Algorithm**: 1H