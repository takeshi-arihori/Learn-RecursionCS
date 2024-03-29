# 2024 年 03 月 24 日

## 本日の目標(朝一番に確認してから学習開始)

-   **React, TypeScript**: 9H
-   **読書**: 1H

## 目標振り返り

### React, TypeScript: 9H

-   **Netflix Tutorial**
-   認証の設定
-   frontpage の作成

-   **RecursionCS React**

-   **読書: オブジェクト指向でなぜつくるのか**: 1H
    アジャイル開発の代表的なプラクティス

1. TDD: テストコードを先に書いてから本体コードを開発する。
2. CI: コンパイル・ビルド・単体テストを定常的に自動実行する。
3. リファクタリング: 完成したプログラムの内部構造を変えずに、後から改善する。

-   反復型開発プロセス
    「要件定義」、「設計」、「実装」、「テスト」、「中間リリース」のサイクルを繰り返す -> イテレーション。開発手法の特徴がメンバー視点。
-   手法

1. XP

-   -   4 つの価値
        1. コミュニケーション
        2. 単純さ
        3. フィードバック
        4. 勇気
-   -   12 のプラクティス
        1. 計画ゲーム
        2. 小さなリリース
        3. メタファー
        4. シンプルデザイン
        5. テスティング
        6. リファクタリング
        7. ペアプログラミング
        8. 共同所有権
        9. 継続的インテグレーション
        10. 40 時間労働週間
        11. オンサイト顧客
        12. コーディング標準

2. Scrum
   チームの視点。最終的にプロダクトを作るために必要な作業内容や進捗状況を見える化する「マネジメントの視点」も重視。
   [スクラムガイド](https://scrumguides.org/docs/scrumguide/v2020/2020-Scrum-Guide-Japanese.pdf)

-   チームに参加するメンバーの役割

1. プロダクトオーナー

-   -   プロダクトの最終責任者。顧客の立場で、プロダクトバックログの優先順位を決定する権限を持つが、開発チームの作業に干渉してはいけない。

2. 開発チーム

-   -   実際の開発を行うチームで、自己組織化されたチームのメンバーが機能横断的に作業を進めることを基本とする。(個々のメンバーにリーダーやアーキテクト、プログラマーなど特定の役割を定義しない。)

3. スクラムマスター

-   -   スクラム手法を用いてチームの作業が円滑に進むように支援するコーチ役。主体は開発チーム。

-   TDD の作業手順

1. テストコードを書く(準備作業)
2. コンパイルを通す。(準備作業)
3. テストを実行して、失敗することを確認する。(準備作業)
4. コードを記述して、テストを成功させる。
5. コードの重複を取り除く。

クラスやメソッドを開発する際は、1 ~ 5 までを数分から 10 分程度の短いサイクルで何回も繰り返しながら少しずつ機能を追加していく。

-   リファクタリング 「関数の抽出」の手順

1. 適切な名前の新しい関数を作成する。
2. 抽出したいロジックを新しい関数にコピーする。
3. 抽出したロジックが使う変数を新しい関数に適合させるため、必要に応じて引数や戻り値に変更する。
4. コンパイルする。
5. 元の関数を変更して、新しい関数を呼び出すようにする。
6. コンパイルしてテストする。

## 合計学習時間

-   10H

## 明日の目標（TODO 目標/できるようになりたいこと）

-   **React, TypeScript**: 4H
-   **読書**: 1H
