# 2024 年 04 月 11 日

## 本日の目標(朝一番に確認してから学習開始)

-   **React**: 4H
-   **TypeScript**: 1H
-   **Algorithm**: 1H
-   **Reading**: 1H

## 目標振り返り

### React: 4H

-   **RecursionCS React**

-   **Udemy 【2023 年最新】React(v18)完全入門ガイド** sec240 ~
-   コンポーネントのテスト
-   -   Arrange, Act, Assert の書き方
-   -   describe()を使用してテストをグループ化

#### テスト例:

-   コンポーネントテスト

```
    describe("ボタン制御のテスト", () => {
        test("「カウントアップ」押下で「現在のカウント」が+1されるか", () => {
            render(<Counter originCount={0} />);
            // Arrange
            const spanElBeforeUpdate = screen.getByText("現在のカウント:0");
            expect(spanElBeforeUpdate).toBeInTheDocument();

            // Act
            const btn = screen.getByRole("button", { name: "カウントアップ" });
            fireEvent.click(btn);

            // Assert
            const spanEl = screen.getByText("現在のカウント:1");
            expect(spanEl).toBeInTheDocument();
        });
    });
```

-   関数をテストする場合: Reducer を使用

```
import { counterReducer } from "./counterReducer";
const initState = { count: 0, step: 1 };

describe("counterReducerの動作確認", () => {
    test("up", () => {
        const newState = counterReducer(initState, { type: "up" });
        expect(newState).toEqual({ count: 1, step: 1 });
    });
    test("down", () => {
        const newState = counterReducer(initState, { type: "down" });
        expect(newState).toEqual({ count: -1, step: 1 });
    });
    test("changeStep -> up", () => {
        let newState = counterReducer(initState, {
            type: "changeStep",
            payload: 2,
        });
        expect(newState).toEqual({ count: 0, step: 2 });

        newState = counterReducer(newState, { type: "up" });
        expect(newState).toEqual({ count: 2, step: 2 });
    });
});

```

-   非同期処理のテスト

### Algorithm: 1H

-   [k 番目の要素 medium](https://recursionist.io/dashboard/problems/submissions/791304)

## 合計学習時間

-   5H

## 明日の目標（TODO 目標/できるようになりたいこと）

-   **React**: 3H
-   **Algorithm**: 1H
-   **Reading**: 1H
