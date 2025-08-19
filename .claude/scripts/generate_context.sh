#!/bin/bash

# .github ディレクトリ内のガイドラインファイルが存在するか確認
if [ ! -f ".github/COMMIT_GUIDELINES.md" ]; then
  exit 0
fi

# ファイルの内容を読み込む
COMMIT_RULES=$(cat .github/COMMIT_GUIDELINES.md 2>/dev/null)
BRANCH_STRATEGY=$(cat .github/BRANCH_STRATEGY.md 2>/dev/null)

# JSONをヒアドキュメントで生成
# これにより、引用符のエスケープが不要になり、可読性が向上します。
cat <<EOF
{
  "hookSpecificOutput": {
    "hookEventName": "UserPromptSubmit",
    "additionalContext": "## 📋 Recursion Curriculum プロジェクトルール\n\n### 🔄 コミット規約\n\`\`\`markdown\n$COMMIT_RULES\n\`\`\`\n\n### 🌳 ブランチ戦略\n\`\`\`markdown\n$BRANCH_STRATEGY\n\`\`\`\n\n### 🎯 学習フォーカス\n現在のプロジェクトは多言語学習カリキュラム（PHP/Java/Go/TypeScript/Python/C++）のリポジトリです。TDD手法を重視し、段階的な学習進行を大切にしてください。"
  }
}
EOF
