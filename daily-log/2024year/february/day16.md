# 2024 年 02 月 16 日

## 本日の目標(朝一番に確認してから学習開始)

- [ ] バックエンドプロジェクト・Video Compressor: 2H
- [ ] JavaScript Primer: 2H

## 目標振り返り

- 16:00 ~ 18:00: JavaScript Primer: 2H

## 合計学習時間

- 2H

## カリキュラム

## 解いた問題

## 学んだこと

- 関数宣言や関数式における `this` の挙動 (呼び出し方によって変わる)
- - ベースオブジェクトがないと, `this` は `undefined` になる
- - fn 関数はメソッドではないのでベースオブジェクトはない
    `fn();`
- - obj.method メソッドのベースオブジェクトは`obj`
    `obj.method();`
- - obj1.obj2.method メソッドのベースオブジェクトは`obj2`。ドット演算子、ブラケット演算子どちらも結果は同じ。
    `obj1.obj2.method();`
    `obj1["obj2"]["method"]();`

- this を含むメソッドを変数に代入した場合
- - 問題: そのまま実行すると、`this` は `undefined` になる
- - 解決: call, apply, bind メソッドを明示的に指定して、関数を実行する。

- Arrow Function は 常に外側の関数の `this` を参照する。

## 課題

## 明日の目標（TODO 目標/できるようになりたいこと）
