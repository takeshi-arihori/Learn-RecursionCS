# ブランチ戦略

## 📋 概要

本プロジェクトでは、**Git Flow**をベースとした柔軟なブランチ戦略を採用しています。学習カリキュラムの特性を考慮し、段階的な学習進行と品質管理を両立させます。

## 🌳 ブランチ構造

### メインブランチ

#### `main` ブランチ
- **役割**: 本番相当の安定版コード
- **保護**: 直接pushは禁止、PRのみマージ可能
- **品質**: すべてのテストが通り、レビュー済みのコード
- **タグ**: リリース時にバージョンタグを付与

#### `develop` ブランチ（オプション）
- **役割**: 開発統合ブランチ
- **用途**: 複数機能の統合テスト
- **大規模機能**: 複数のfeatureブランチを統合する場合のみ使用

### 開発ブランチ

#### `feature/` ブランチ
```bash
feature/[学習レベル]-[機能名]
feature/oop-mutable-string
feature/intermediate-binary-tree
feature/advanced-sliding-window
```

- **作成元**: `main`ブランチから分岐
- **命名規則**: `feature/[学習レベル]-[機能名]`
- **マージ先**: `main`ブランチ（または`develop`）
- **削除**: マージ後は削除

#### `fix/` ブランチ
```bash
fix/[対象範囲]-[修正内容]
fix/rgb24-hex-conversion
fix/wallet-balance-validation
fix/api-error-handling
```

- **作成元**: `main`ブランチから分岐
- **命名規則**: `fix/[対象範囲]-[修正内容]`
- **緊急度**: 重要度に応じて優先的にレビュー・マージ

#### `refactor/` ブランチ
```bash
refactor/[対象範囲]-[リファクタ内容]
refactor/oop-psr4-compliance
refactor/test-structure-optimization
```

- **作成元**: `main`ブランチから分岐
- **目的**: コード品質向上、技術的負債の解消
- **影響**: 機能には影響せず、内部構造のみ変更

#### `docs/` ブランチ
```bash
docs/[ドキュメント種類]-[更新内容]
docs/api-documentation
docs/setup-guide-update
```

### 特別なブランチ

#### `hotfix/` ブランチ
```bash
hotfix/[緊急修正内容]
hotfix/security-vulnerability-fix
hotfix/critical-bug-fix
```

- **作成元**: `main`ブランチから分岐
- **用途**: 緊急修正（本番環境に影響する重要なバグ）
- **マージ先**: `main`と`develop`（存在する場合）に同時マージ

## 🔄 ワークフロー

### 1. 標準的な機能開発フロー

```bash
# 1. mainブランチを最新に更新
git checkout main
git pull origin main

# 2. 新機能ブランチを作成
git checkout -b feature/oop-rgb24-enhancement

# 3. TDDサイクルで開発
# Red -> Green -> Refactor

# 4. 定期的にコミット（コミット規約に従う）
git add .
git commit -m "test: 🧪 RGB24クラスの新規テストケースを追加"

# 5. 機能完成後、リモートにプッシュ
git push origin feature/oop-rgb24-enhancement

# 6. プルリクエストを作成
# GitHubのWeb UIまたはcli使用

# 7. レビュー・マージ後、ローカルブランチを削除
git checkout main
git pull origin main
git branch -d feature/oop-rgb24-enhancement
```

### 2. バグ修正フロー

```bash
# 1. バグ修正ブランチを作成
git checkout main
git pull origin main
git checkout -b fix/rgb24-conversion-bug

# 2. バグ修正（テストファーストで）
# まず失敗するテストを書く
# 修正を実装
# テストが通ることを確認

# 3. コミット
git commit -m "fix: 🐛 RGB24の16進数変換時の桁数不足を修正"

# 4. プッシュ・PR作成
git push origin fix/rgb24-conversion-bug
```

### 3. 緊急修正（Hotfix）フロー

```bash
# 1. hotfixブランチを作成
git checkout main
git checkout -b hotfix/security-fix

# 2. 修正実装
# 3. テスト
# 4. コミット

# 5. mainにマージ
git checkout main
git merge hotfix/security-fix
git push origin main

# 6. developにもマージ（存在する場合）
git checkout develop
git merge hotfix/security-fix
git push origin develop

# 7. タグ付け
git tag -a v1.2.1 -m "Hotfix: セキュリティ脆弱性の修正"
git push origin v1.2.1
```

## 📏 ブランチ命名規約

### パターン
```
<type>/<scope>-<description>
```

### タイプ
- `feature/`: 新機能・拡張
- `fix/`: バグ修正
- `refactor/`: リファクタリング
- `docs/`: ドキュメント
- `test/`: テスト改善
- `hotfix/`: 緊急修正

### スコープ（学習レベル対応）
- `beginner`: 初級レベル
- `intermediate`: 中級レベル
- `advanced`: 上級レベル
- `oop`: オブジェクト指向
- `api`: API関連
- `db`: データベース関連
- `network`: ネットワーク関連

### 例
```bash
feature/beginner-century-conversion
feature/intermediate-blackjack-game
feature/advanced-binary-tree
fix/oop-wallet-validation
refactor/intermediate-test-structure
docs/advanced-algorithm-explanation
```

## 🛡️ ブランチ保護ルール

### `main` ブランチ保護設定

```yaml
protection_rules:
  main:
    required_status_checks:
      - "tests/phpunit"
      - "tests/java-compile"
      - "tests/go-test"
    required_pull_request_reviews:
      required_approving_review_count: 1
    restrictions:
      push: false  # 直接pushを禁止
    enforce_admins: true
    allow_force_pushes: false
    allow_deletions: false
```

### PR要件
- [ ] すべてのテストが通る
- [ ] 最低1人のレビュアー承認
- [ ] コンフリクトの解決
- [ ] ブランチが最新のmainから分岐している

## 🏷️ タグ戦略

### バージョニング
[Semantic Versioning](https://semver.org/)に従う：

```
v<major>.<minor>.<patch>
v1.0.0, v1.1.0, v1.1.1
```

### タグ付けルール
- **Major**: 破壊的変更、大規模なアーキテクチャ変更
- **Minor**: 新機能追加、後方互換性あり
- **Patch**: バグ修正、小規模改善

### 学習マイルストーン
```bash
v1.0.0  # 基礎PHP完成
v1.1.0  # 中級アルゴリズム追加
v1.2.0  # OOP機能追加
v2.0.0  # 多言語対応（Java, Go等）
```

## 🔄 レビュープロセス

### レビュー基準
1. **機能性**: 要件を満たしているか
2. **テスト**: 適切なテストカバレッジ
3. **コード品質**: 可読性、保守性
4. **規約準拠**: コーディング規約、コミット規約
5. **ドキュメント**: 必要な更新が行われているか

### レビュアー指定
- **自動指定**: CODEOWNERSファイルによる自動アサイン
- **手動指定**: 専門領域に応じた指定
- **学習レベル**: 対象レベルに詳しいレビュアー

## 📊 ブランチ管理ツール

### 推奨コマンド
```bash
# 現在のブランチ状況確認
git branch -vv

# リモートブランチの同期
git remote prune origin

# マージ済みブランチの一覧
git branch --merged main

# マージ済みブランチの削除
git branch --merged main | grep -v "main" | xargs -n 1 git branch -d
```

### Git エイリアス設定
```bash
git config --global alias.co checkout
git config --global alias.br branch
git config --global alias.ci commit
git config --global alias.st status
git config --global alias.last 'log -1 HEAD'
git config --global alias.visual '!gitk'
```

## 🚨 緊急時の対応

### 問題のあるコミットの対処

#### 1. 直前のコミットを修正
```bash
git commit --amend -m "正しいコミットメッセージ"
```

#### 2. pushしていないコミットの取り消し
```bash
git reset --soft HEAD~1  # コミットのみ取り消し
git reset --hard HEAD~1  # 変更も含めて取り消し
```

#### 3. push済みの場合（慎重に）
```bash
git revert <commit-hash>  # 安全な取り消し
```

### ブランチが壊れた場合
```bash
# 作業を一時保存
git stash

# mainから新しいブランチを作成
git checkout main
git checkout -b feature/recovery-branch

# 作業を復元
git stash pop
```

## 📚 学習段階別の推奨フロー

### 初学者向け
1. まずは`feature/beginner-*`ブランチで小さな変更
2. コミットメッセージの練習
3. PRの作成・レビューに慣れる

### 中級者向け
1. 複数コミットからなるfeatureブランチ
2. コンフリクト解決の練習
3. レビューコメントへの対応

### 上級者向け
1. 複雑な機能のブランチ設計
2. リベース・チェリーピックの活用
3. ブランチ戦略の最適化提案

この戦略により、段階的な学習と高品質なコードベースの維持を両立させます。