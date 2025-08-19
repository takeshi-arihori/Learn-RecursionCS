# 貢献ガイド

このプロジェクトへの貢献を検討していただき、ありがとうございます。このガイドでは、効果的で一貫性のある貢献を行うためのガイドラインを提供します。

## 📋 目次

- [プロジェクト概要](#プロジェクト概要)
- [開発環境のセットアップ](#開発環境のセットアップ)
- [貢献の流れ](#貢献の流れ)
- [コーディング規約](#コーディング規約)
- [テスト駆動開発（TDD）](#テスト駆動開発tdd)
- [コミット規約](#コミット規約)
- [プルリクエストのガイドライン](#プルリクエストのガイドライン)
- [課題の報告](#課題の報告)

## 🎯 プロジェクト概要

本プロジェクトは、複数言語（PHP、Java、JavaScript/TypeScript、Go、Python、C++、C）を用いた学習カリキュラムリポジトリです。

### 学習レベル構造
- **beginner/**: 基本的なプログラミング演習
- **intermediate/**: 中級アルゴリズムと概念
- **advanced/**: 高度なアルゴリズムとデータ構造
- **oop/**: オブジェクト指向プログラミング（Docker環境付き）
- **lang-training/**: 言語特化トレーニング
- **database/**: データベース関連演習
- **video-compressor/**: 動画圧縮とネットワーク通信

## 🛠️ 開発環境のセットアップ

### 必要なツール
- **PHP** (>=7.4) + Composer
- **Java** (>=11)
- **Go** (>=1.19)
- **Node.js** + npm
- **Python** (>=3.8)
- **Docker** + Docker Compose
- **PlantUML** (`brew install plantuml`)

### セットアップ手順

1. **リポジトリのクローン**
   ```bash
   git clone https://github.com/your-username/recursionCurriculum.git
   cd recursionCurriculum
   ```

2. **PHP環境の準備（OOP section）**
   ```bash
   cd oop
   composer install
   docker-compose up -d
   ```

3. **Go環境の準備**
   ```bash
   cd lang-training/go
   go mod tidy
   ```

4. **開発ツールの確認**
   ```bash
   # PHPUnit
   ./vendor/bin/phpunit --version
   
   # Go
   go version
   
   # Java
   javac -version
   ```

## 🔄 貢献の流れ

### 1. Issue の確認・作成
- 既存のIssueを確認し、重複がないかチェック
- 新しい機能や修正が必要な場合は、Issueを作成
- ラベルを適切に設定（`bug`, `enhancement`, `documentation`など）

### 2. フォーク・ブランチの作成
```bash
# フォークしたリポジトリをクローン
git clone https://github.com/your-username/recursionCurriculum.git
cd recursionCurriculum

# メインブランチから新しいブランチを作成
git checkout -b feature/your-feature-name
# または
git checkout -b fix/your-bug-fix
```

### 3. 開発・テスト
- [TDDプロセス](#テスト駆動開発tdd)に従って開発
- 適切なテストカバレッジを確保
- [コーディング規約](#コーディング規約)に従ってコーディング

### 4. コミット
- [コミット規約](#コミット規約)に従ってコミット
- 論理的な単位でコミットを分割

### 5. プルリクエストの作成
- [プルリクエストテンプレート](pull_request_template.md)を使用
- 詳細な説明とテスト結果を記載

## 📏 コーディング規約

### PHP
- **PSR-4**: 自動読み込み規約準拠
- **PSR-12**: コーディングスタイル規約準拠
- **DocBlock**: すべてのクラス・メソッドに詳細なドキュメント

```php
<?php

namespace RecursionCurriculum\Models;

/**
 * RGB24色を表現するクラス
 * 
 * @package RecursionCurriculum\Models
 * @author Your Name
 * @since 1.0.0
 */
class RGB24
{
    /**
     * RGB値を設定する
     * 
     * @param int $red 赤色成分（0-255）
     * @param int $green 緑色成分（0-255）
     * @param int $blue 青色成分（0-255）
     * @throws InvalidArgumentException 値が範囲外の場合
     */
    public function setRGB(int $red, int $green, int $blue): void
    {
        // 実装
    }
}
```

### Go
- `gofmt`でコードフォーマット
- パッケージレベルのドキュメント
- エラーハンドリングの徹底

### Java
- Java標準規約に準拠
- JavaDocの記載
- オブジェクト指向設計パターンの適用

### その他の言語
- 各言語の標準的な規約に従う
- 可読性と保守性を重視

## 🧪 テスト駆動開発（TDD）

### TDDサイクル

1. **Red**: 失敗するテストを書く
```php
public function testRgbToHexConversion(): void
{
    $rgb = new RGB24(255, 0, 0);
    $this->assertEquals('#FF0000', $rgb->toHex());
}
```

2. **Green**: テストが通る最小限の実装
```php
public function toHex(): string
{
    return sprintf('#%02X%02X%02X', $this->red, $this->green, $this->blue);
}
```

3. **Refactor**: コード品質の改善

### テスト実行
```bash
# PHP（OOP section）
cd oop && ./vendor/bin/phpunit

# PHP（Intermediate section）
cd intermediate/php && ./vendor/bin/phpunit tests/

# Go
cd lang-training/go && go test

# Java
cd advanced/java && javac *.java && java TestRunner
```

### テストガイドライン
- **Given-When-Then** パターンを使用
- テストメソッド名は動作を明確に表現
- 境界値テスト・異常系テストを含める
- モックやスタブを適切に使用

## 📝 コミット規約

詳細は[COMMIT_GUIDELINES.md](COMMIT_GUIDELINES.md)を参照してください。

### 基本形式
```
<type>: <emoji> <subject>

<body>

<footer>
```

### タイプ一覧
| タイプ | 絵文字 | 説明 |
|--------|--------|------|
| `fix` | 🐛 | バグ修正 |
| `add` | ✨ | 新規機能追加 |
| `update` | 🔧 | 既存機能の修正・改善 |
| `change` | 🔄 | 仕様変更 |
| `clean` | 🏗️ | リファクタリング |
| `remove` | 🗑️ | 不要ファイル・機能の削除 |
| `docs` | 📚 | ドキュメント関連 |
| `test` | 🧪 | テスト関連 |

## 📋 プルリクエストのガイドライン

### プルリクエスト作成前チェックリスト

- [ ] 関連するIssueを参照している
- [ ] [プルリクエストテンプレート](pull_request_template.md)を使用している
- [ ] すべてのテストが通っている
- [ ] コーディング規約に準拠している
- [ ] 適切なドキュメント更新を行っている
- [ ] 破壊的変更がある場合は明記している

### レビュープロセス

1. **自動チェック**: CI/CDパイプラインでのテスト実行
2. **コードレビュー**: 最低1人のレビュアーによる承認
3. **品質確認**: コード品質、テスト、ドキュメントの確認
4. **マージ**: スカッシュマージを基本とする

### マージ後

- 不要になったブランチは削除
- 関連するIssueのクローズ
- リリースノートの更新（必要に応じて）

## 🐛 課題の報告

### バグレポートの作成

**タイトル**: `[BUG] 簡潔な問題の説明`

**テンプレート**:
```markdown
## 🐛 バグの概要
<!-- バグの内容を簡潔に説明 -->

## 📋 再現手順
1. 
2. 
3. 

## ✅ 期待される動作
<!-- 本来あるべき動作 -->

## ❌ 実際の動作
<!-- 実際に発生した問題 -->

## 🖥️ 環境情報
- OS: 
- PHP Version: 
- Go Version: 
- Java Version: 

## 📸 スクリーンショット
<!-- あれば添付 -->

## 📝 追加情報
<!-- 他に関連する情報 -->
```

### 機能リクエスト

**タイトル**: `[FEATURE] 機能の簡潔な説明`

**テンプレート**:
```markdown
## 🎯 機能の概要
<!-- 提案する機能の説明 -->

## 🤔 動機・背景
<!-- なぜこの機能が必要か -->

## 📋 詳細な仕様
<!-- 具体的な実装内容 -->

## 💡 代替案
<!-- 他の解決方法があれば -->

## ✅ 受け入れ基準
- [ ] 
- [ ] 
- [ ]
```

## 🤝 コミュニティガイドライン

### 行動規範

1. **尊重**: すべての参加者を尊重する
2. **建設的**: 建設的なフィードバックを提供する
3. **協力的**: チームワークを重視する
4. **学習志向**: 学習と成長を促進する

### コミュニケーション

- **日本語**: 基本的なコミュニケーション言語
- **技術用語**: 適切な技術用語を使用
- **礼儀正しさ**: 丁寧で建設的な議論
- **明確性**: 曖昧さを避け、明確に表現

## 🙏 謝辞

このプロジェクトに貢献していただき、ありがとうございます。皆さんの貢献により、より良い学習リソースを提供できます。

---

質問やサポートが必要な場合は、Issueを作成するか、メンテナーにお気軽にお声かけください。