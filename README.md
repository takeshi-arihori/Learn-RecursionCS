# RecursionCS カリキュラム

## 概要
Recursion Curriculumでは、プログラミングの基礎から応用まで、段階的に学習できるようにトピック別に構成されています。初級・中級・上級のレベル別学習と、特定分野に特化した専門トピックで構成されています。

## ディレクトリ構造

```
/
├── beginner/          # 基礎レベル - プログラミングの基本概念
├── intermediate/      # 中級レベル - アルゴリズムと問題解決
├── advanced/         # 上級レベル - 高度なデータ構造とアルゴリズム
├── oop/             # オブジェクト指向プログラミング（Docker環境付き）
├── lang-training/   # 言語別トレーニング
├── database/        # データベースプログラミング
├── video-compressor/# ネットワークプログラミングと動画処理
└── daily/          # 学習ログと日記
```

## 使用言語と技術スタック
```
- PHP（基礎〜上級、OOP、Webフレームワーク）
- Java（高度なアルゴリズムとデータ構造）
- Go（Web API サーバー開発）
- TypeScript（型安全なJavaScript開発）
- Python（ネットワークプログラミング、UDP通信）
- C++（データベースプログラミング）
- SQL（データベース設計）
```

## 学習トピック

### 🟢 Beginner（基礎）
- プログラミング基本概念
- PHP言語基礎
- 変数、関数、制御構造

### 🟡 Intermediate（中級）  
- アルゴリズム実装
- 複雑な問題解決
- テスト駆動開発（TDD）

### 🔴 Advanced（上級）
- データ構造（二分木、連結リスト）
- Javaによる高度なアルゴリズム
- 計算量最適化

### ⚙️ 専門分野
- **OOP**: オブジェクト指向設計とDocker環境
- **Lang-training**: Go/TypeScript言語習得
- **Database**: C++によるデータベースプログラミング
- **Video-compressor**: Pythonネットワーキングとリアルタイム通信

## 🛠️ 開発ルールと手法

### 開発手法
本プロジェクトでは **テスト駆動開発（TDD: Test-Driven Development）** を基本方針としています。

#### TDD開発サイクル
1. **Red** - 失敗するテストを書く
2. **Green** - テストを通す最小限のコードを書く  
3. **Refactor** - コードを改善する

#### 実装手順
```bash
# 1. テストファイルを先に作成
touch tests/NewFeatureTest.php

# 2. テストケースを記述（この時点では失敗する）
# 3. 実装コードを作成してテストを通す
# 4. リファクタリングで品質向上
```

### 使用ツール

#### 設計・ドキュメント作成
- **PlantUML** - UML図作成（クラス図、シーケンス図、コンポーネント図）
  ```bash
  # インストール: brew install plantuml
  # 使用例: plantuml diagram.puml
  ```

- **dbdiagram.io** - データベース設計とER図作成
  - URL: https://dbdiagram.io/
  - 使用言語: DBML (Database Markup Language)

#### 品質管理
- **PHPUnit** - PHPテスティングフレームワーク
- **PHPStan** - 静的解析ツール
- **Docker** - 開発環境の統一

### ディレクトリ別開発ガイドライン

#### beginner/ - 初級開発
```
beginner/php/
├── src/          # 実装ファイル
├── tests/        # テストファイル
├── docs/         # ドキュメント
└── main.php      # エントリーポイント
```

#### intermediate/ - 中級開発  
```
intermediate/php/
├── src/          # アルゴリズム実装
├── tests/        # 包括的テストスイート
├── docs/         # 技術解説文書
└── main.php      # 実行環境
```

#### advanced/ - 上級開発
```
advanced/
├── php/          # PHP高度実装
├── java/         # Java実装
└── docs/         # 理論解説
```

### コーディング規約

#### PHP Standards
- **PSR-4** オートローディング準拠
- **PSR-12** コーディングスタイル準拠
- **DocBlock** による詳細なドキュメント

#### テスト規約
```php
<?php
// テストファイル命名: {ClassName}Test.php
class CalculatorTest extends PHPUnit\Framework\TestCase 
{
    /**
     * @test
     * テストメソッド命名: test{機能名}_{条件}_{期待結果}
     */
    public function test_add_positiveNumbers_returnsSum() 
    {
        // Given (準備)
        $calculator = new Calculator();
        
        // When (実行)
        $result = $calculator->add(2, 3);
        
        // Then (検証)
        $this->assertEquals(5, $result);
    }
}
```

## 📋 コミットルール

### 基本ルール
- 変更した理由（内容、詳細）を明確に記述
- 各コミットは一つの論理的な変更単位とする
- TDDサイクル完了後にコミットする

### コミットタイプ
```bash
- fix：バグ修正
- hotfix：クリティカルなバグ修正  
- add：新規（ファイル）機能追加
- update：機能修正（バグではない）
- change：仕様変更
- clean：整理（リファクタリング等）
- disable：無効化（コメントアウト等）
- remove：削除（ファイル）
- upgrade：バージョンアップ
- revert：変更取り消し
- docs：ドキュメント更新
- test：テスト追加・修正
```

### コミットメッセージ例
```bash
add: ✨ ユーザー登録機能を追加

- ユーザー情報バリデーション実装
- データベーステーブル設計（PlantUML）
- TDDサイクルでテスト完全通過
- PHPUnit テストカバレッジ95%達成

Co-Authored-By: Claude <noreply@anthropic.com>
```
