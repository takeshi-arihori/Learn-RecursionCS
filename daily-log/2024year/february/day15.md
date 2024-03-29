# 2024 年 02 月 15 日

## 本日の目標(朝一番に確認してから学習開始)

- [ ] バックエンドプロジェクト・Video Compressor: 3H
- [ ] 独習 PHP: 2H

## 目標振り返り

- 16:00 ~ 17:30: 独習 PHP: 1.5H
- 21:00 ~ 22:30: JavaScript Primer: 1.5H

## 合計学習時間

- 3H

## カリキュラム

## 解いた問題

## 学んだこと

- JavaScript の静的スコープの変数参照と多言語の動的スコープの変数参照の違い
- クロージャがなぜ動くのか: クロージャとは以下の 2 つの仕組みを利用して、関数ないから特定の変数を参照し続けることで関数が状態を持てる仕組みのこと

1. 静的スコープ: ある変数がどの値を参照するかは静的に決まる
2. メモリ管理の仕組み: 参照されなくなったデータはガベージコレクションにより解放される

- クロージャの用途

1. 関数に状態を持たせる手段として
2. 外から参照できない変数を定義する手段として
3. グローバル変数を減らす手段として
4. 高階関数の一部分として

- 実行コンテキスト: Script と Module

1. "Script"の実行コンテキストは、多くの実行環境ではデフォルトの実行コンテキスト。
   "Script"の実行コンテキストでは、デフォルトは strict mode ではありません。

2. "Module"の実行コンテキストは、JavaScript をモジュールとして実行するために、ECMAScript 2015 で導入されたものです。
   "Module"の実行コンテキストでは、デフォルトが strict mode となり、古く安全でない構文や機能は一部禁止されています。 また、モジュールの機能は"Module"の実行コンテキストでしか利用できません。

## 課題

- プロジェクトの次のステップが JavaScript なので、JavaScript の学習を優先的に進める必要がある。
- 要件定義についての理解を深める必要がある。

## 明日の目標（TODO 目標/できるようになりたいこと）

- [ ] バックエンドプロジェクト・Video Compressor: 2H
- [ ] JavaScript Primer: 2H
