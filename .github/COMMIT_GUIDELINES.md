# コミットガイドライン

本プロジェクトでは、一貫性のあるコミットメッセージを維持するために以下のルールに従ってください。

## コミットメッセージの構造

```
<type>: <emoji> <subject>

<body>（必要に応じて）

<footer>（必要に応じて）
```

## コミットタイプ

| タイプ | 絵文字 | 説明 | 例 |
|--------|--------|------|-----|
| `fix` | 🐛 | バグ修正 | `fix: 🐛 RGB24クラスの16進数変換バグを修正` |
| `add` | ✨ | 新規機能追加 | `add: ✨ MutableStringクラスの新規実装` |
| `update` | 🔧 | 既存機能の修正・改善 | `update: 🔧 バイナリツリーの挿入処理を最適化` |
| `change` | 🔄 | 仕様変更 | `change: 🔄 API仕様をREST準拠に変更` |
| `clean` | 🏗️ | リファクタリング | `clean: 🏗️ OOPクラスをPSR-4準拠に再構造化` |
| `remove` | 🗑️ | 不要ファイル・機能の削除 | `remove: 🗑️ 使用されていないテストファイルを削除` |
| `docs` | 📚 | ドキュメント関連 | `docs: 📚 README.mdにセットアップ手順を追加` |
| `test` | 🧪 | テスト関連 | `test: 🧪 MutableStringのテストケースを追加` |
| `style` | 🎨 | コードスタイル修正 | `style: 🎨 PSR-12準拠にコードフォーマット` |
| `perf` | ⚡ | パフォーマンス改善 | `perf: ⚡ アルゴリズムの計算量を改善` |

## サブジェクト（subject）のルール

1. **50文字以内**で簡潔に記述
2. **現在形**を使用（「修正した」ではなく「修正」）
3. **最初の文字は小文字**
4. **末尾にピリオドは付けない**

## ボディ（body）のルール（オプション）

- 72文字で改行
- 「何を」変更したかではなく、「なぜ」変更したかを説明
- 複数の変更がある場合は箇条書きを使用

## フッター（footer）のルール（オプション）

- **Breaking Changes**: `BREAKING CHANGE: <説明>`
- **Issue参照**: `Closes #123`, `Fixes #456`
- **Co-authored-by**: `Co-authored-by: Name <email>`

## コミット例

### 良いコミット例

```bash
# シンプルな修正
git commit -m "fix: 🐛 RGB24クラスの16進数変換バグを修正"

# 詳細な説明付き
git commit -m "add: ✨ MutableStringクラスを新規実装

- 文字列の可変操作機能を追加
- substring、append、insert、deleteメソッドを実装
- 包括的なテストスイートを追加

Closes #42"

# 破壊的変更
git commit -m "change: 🔄 API仕様をREST準拠に変更

BREAKING CHANGE: エンドポイントのパス構造が変更されました
- /api/user -> /api/users
- /api/data -> /api/datasets"
```

### 悪いコミット例

```bash
# NG: タイプが不明確
git commit -m "update stuff"

# NG: 絵文字なし、説明が不十分
git commit -m "fix bug"

# NG: 過去形を使用
git commit -m "fixed: バグを修正した"

# NG: 長すぎる件名
git commit -m "fix: 非常に長いコミットメッセージでこれは50文字を大幅に超えているので良くない例です"
```

## コミット前のチェックリスト

- [ ] 適切なタイプを選択した
- [ ] 絵文字を含めた
- [ ] 件名が50文字以内
- [ ] テストが通る
- [ ] コードスタイルが準拠している
- [ ] 関連するIssueを参照した（該当する場合）

## TDD（テスト駆動開発）でのコミット例

```bash
# Red: テストを追加
git commit -m "test: 🧪 MutableString#insertメソッドのテストを追加"

# Green: テストを通すための実装
git commit -m "add: ✨ MutableString#insertメソッドを実装"

# Refactor: リファクタリング
git commit -m "clean: 🏗️ MutableString#insertの処理を最適化"
```

## 注意事項

- **一つのコミット**には**一つの論理的変更**のみを含める
- WIPコミットは避け、完成した単位でコミットする
- コミットメッセージは**日本語**で記述する
- 定期的にcommit履歴を確認し、一貫性を保つ