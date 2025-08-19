# Claude Code フック設定

Claude Code実行前にコミットルールとブランチ戦略を自動読み込みするためのフック設定です。

## 📋 設定ファイル場所

### プロジェクト固有設定（推奨）
`.claude/settings.json` - このプロジェクトでのみ有効

### グローバル設定
`~/.claude/settings.json` - すべてのプロジェクトで有効

## ✅ プロジェクト固有設定（完了済み）

このプロジェクト専用の設定ファイルを既に作成済みです：
- **場所**: `.claude/settings.json`
- **対象**: このRecursion Curriculumプロジェクトのみ
- **効果**: 他のプロジェクトには影響しません

## ⚙️ 推奨フック設定

### 完全設定（コピー&ペースト用）

```json
{
  "hooks": {
    "UserPromptSubmit": [
      {
        "type": "command",
        "command": "PROJECT_ROOT=$(git rev-parse --show-toplevel 2>/dev/null); if [ -n \"$PROJECT_ROOT\" ] && [ -f \"$PROJECT_ROOT/.github/COMMIT_GUIDELINES.md\" ]; then COMMIT_RULES=$(cat \"$PROJECT_ROOT/.github/COMMIT_GUIDELINES.md\" 2>/dev/null); BRANCH_STRATEGY=$(cat \"$PROJECT_ROOT/.github/BRANCH_STRATEGY.md\" 2>/dev/null); echo '{\"hookSpecificOutput\":{\"hookEventName\":\"UserPromptSubmit\",\"additionalContext\":\"## 📋 プロジェクトルール\\n\\n### 🔄 コミット規約\\n```markdown\\n'$COMMIT_RULES'\\n```\\n\\n### 🌳 ブランチ戦略\\n```markdown\\n'$BRANCH_STRATEGY'\\n```\\n\"}}'; fi"
      }
    ],
    "PreToolUse": [
      {
        "type": "command",
        "condition": "test \"$1\" = \"Bash\" && echo \"$2\" | grep -E \"git (commit|checkout|branch|merge|rebase)\" >/dev/null 2>&1",
        "command": "PROJECT_ROOT=$(git rev-parse --show-toplevel 2>/dev/null); if [ -n \"$PROJECT_ROOT\" ]; then echo '🚨 Git操作前の確認'; echo '📋 コミット規約とブランチ戦略を確認してください:'; echo \"📁 プロジェクト: $(basename \"$PROJECT_ROOT\")\"; CURRENT_BRANCH=$(git branch --show-current 2>/dev/null); echo \"🌿 現在のブランチ: $CURRENT_BRANCH\"; if [ -f \"$PROJECT_ROOT/.github/COMMIT_GUIDELINES.md\" ]; then echo '📖 コミット規約: .github/COMMIT_GUIDELINES.md'; fi; if [ -f \"$PROJECT_ROOT/.github/BRANCH_STRATEGY.md\" ]; then echo '📖 ブランチ戦略: .github/BRANCH_STRATEGY.md'; fi; fi"
      }
    ]
  }
}
```

## 🔧 分割設定（段階的設定用）

### 1. ユーザープロンプト送信時の自動読み込み

```json
{
  "hooks": {
    "UserPromptSubmit": [
      {
        "type": "command",
        "command": "PROJECT_ROOT=$(git rev-parse --show-toplevel 2>/dev/null); if [ -n \"$PROJECT_ROOT\" ] && [ -f \"$PROJECT_ROOT/.github/COMMIT_GUIDELINES.md\" ]; then COMMIT_RULES=$(cat \"$PROJECT_ROOT/.github/COMMIT_GUIDELINES.md\" 2>/dev/null); BRANCH_STRATEGY=$(cat \"$PROJECT_ROOT/.github/BRANCH_STRATEGY.md\" 2>/dev/null); echo '{\"hookSpecificOutput\":{\"hookEventName\":\"UserPromptSubmit\",\"additionalContext\":\"## 📋 プロジェクトルール\\n\\n### 🔄 コミット規約\\n```markdown\\n'$COMMIT_RULES'\\n```\\n\\n### 🌳 ブランチ戦略\\n```markdown\\n'$BRANCH_STRATEGY'\\n```\\n\"}}'; fi"
      }
    ]
  }
}
```

### 2. Git操作前の確認メッセージ

```json
{
  "hooks": {
    "PreToolUse": [
      {
        "type": "command",
        "condition": "test \"$1\" = \"Bash\" && echo \"$2\" | grep -E \"git (commit|checkout|branch|merge|rebase)\" >/dev/null 2>&1",
        "command": "PROJECT_ROOT=$(git rev-parse --show-toplevel 2>/dev/null); if [ -n \"$PROJECT_ROOT\" ]; then echo '🚨 Git操作前の確認'; echo '📋 コミット規約とブランチ戦略を確認してください:'; echo \"📁 プロジェクト: $(basename \"$PROJECT_ROOT\")\"; CURRENT_BRANCH=$(git branch --show-current 2>/dev/null); echo \"🌿 現在のブランチ: $CURRENT_BRANCH\"; if [ -f \"$PROJECT_ROOT/.github/COMMIT_GUIDELINES.md\" ]; then echo '📖 コミット規約: .github/COMMIT_GUIDELINES.md'; fi; if [ -f \"$PROJECT_ROOT/.github/BRANCH_STRATEGY.md\" ]; then echo '📖 ブランチ戦略: .github/BRANCH_STRATEGY.md'; fi; fi"
      }
    ]
  }
}
```

## 🎯 フック動作説明

### UserPromptSubmit フック

**トリガー**: ユーザーがClaude Codeにプロンプトを送信した時

**動作**:
1. 現在のディレクトリがGitリポジトリかチェック
2. `.github/COMMIT_GUIDELINES.md`と`.github/BRANCH_STRATEGY.md`の存在確認
3. ファイルが存在する場合、内容を読み取り
4. Claude Codeのコンテキストに追加情報として注入

**効果**: 
- すべての会話でコミット規約とブランチ戦略が参照可能
- Claude Codeが自動的にプロジェクトルールに従う

### PreToolUse フック

**トリガー**: Claude CodeがBashツールでGitコマンドを実行する前

**対象コマンド**: `git commit`, `git checkout`, `git branch`, `git merge`, `git rebase`

**動作**:
1. Git操作前に警告メッセージを表示
2. 現在のブランチ情報を表示
3. 参照すべきドキュメントファイルの場所を通知

**効果**: 
- Git操作前にルールの確認を促す
- 現在の状態を把握しやすくする

## 🔧 設定方法

### ✅ プロジェクト固有設定（推奨・完了済み）

このプロジェクト用の設定は既に完了しています：

```bash
# 設定ファイルの確認
ls -la .claude/settings.json

# 設定内容の確認
cat .claude/settings.json
```

### 📝 グローバル設定（オプション）

すべてのプロジェクトで同じ設定を使いたい場合：

1. **設定ディレクトリの確認**
   ```bash
   ls -la ~/.claude/
   mkdir -p ~/.claude/  # 存在しない場合
   ```

2. **既存設定の確認・バックアップ**
   ```bash
   cat ~/.claude/settings.json
   cp ~/.claude/settings.json ~/.claude/settings.json.backup  # バックアップ
   ```

3. **設定の追加**
   上記の「完全設定」をコピー&ペースト

### 🔄 設定の優先順位

1. **プロジェクト固有設定**: `.claude/settings.json` （最優先）
2. **グローバル設定**: `~/.claude/settings.json`

このプロジェクトでは、プロジェクト固有設定が自動的に使用されます。

## 🎛️ カスタマイズオプション

### 対象ファイルの変更

```javascript
// COMMIT_GUIDELINES.mdの代わりに他のファイルを使用
"$PROJECT_ROOT/docs/COMMIT_RULES.md"
```

### 対象Gitコマンドの変更

```bash
# より多くのGitコマンドを対象にする場合
grep -E "git (commit|checkout|branch|merge|rebase|push|pull|reset)" 

# より限定的にする場合
grep -E "git (commit|push)"
```

### メッセージのカスタマイズ

```bash
echo '⚠️ カスタムメッセージ: Git操作を実行します'
echo "📊 ブランチ情報: $CURRENT_BRANCH"
```

## 🚨 トラブルシューティング

### フックが動作しない場合

1. **設定ファイルの構文確認**
   ```bash
   jq . ~/.claude/settings.json
   ```

2. **ファイルパスの確認**
   ```bash
   ls -la .github/COMMIT_GUIDELINES.md
   ls -la .github/BRANCH_STRATEGY.md
   ```

3. **実行権限の確認**
   ```bash
   chmod +r .github/*.md
   ```

### パフォーマンスへの影響

- **UserPromptSubmit**: 毎回ファイルを読み込むため、トークン使用量が増加
- **PreToolUse**: Git操作時のみ実行されるため、影響は軽微

### デバッグ方法

```bash
# フックの動作確認（テスト用）
PROJECT_ROOT=$(git rev-parse --show-toplevel 2>/dev/null)
echo "Project root: $PROJECT_ROOT"
ls -la "$PROJECT_ROOT/.github/"
```

## 💡 使用例

### 設定後の動作例

```
ユーザー: "新しい機能を追加したいのでブランチを作成してください"

Claude Code (フック実行後): 
"📋 プロジェクトのブランチ戦略とコミット規約を確認しました。
feature/oop-new-functionalityブランチを作成し、
コミット規約に従って開発を進めます..."
```

この設定により、Claude Codeは自動的にプロジェクトのルールを参照し、一貫性のある開発をサポートします。