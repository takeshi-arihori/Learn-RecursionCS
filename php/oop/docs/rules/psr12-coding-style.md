# PSR-12 コーディングスタイルガイド

## 概要

このプロジェクトでは、PSR-12（PHP Standard Recommendation 12）コーディングスタイルを採用しています。PSR-12 は、PHP コードの統一性と可読性を向上させるための標準規約です。

## PSR-12 とは

PSR-12 は、PSR-1 と PSR-2 を拡張・発展させた PHP コーディング標準で、以下の特徴があります：

-   **一貫性**: チーム全体で統一されたコードスタイル
-   **可読性**: 誰が読んでも理解しやすいコード
-   **保守性**: メンテナンスしやすいコード構造
-   **業界標準**: PHP 開発コミュニティで広く採用されている標準

## 主なルール

### 1. 基本的なコーディング標準

-   **文字エンコーディング**: UTF-8（BOM なし）
-   **改行コード**: Unix LF（\n）
-   **インデント**: スペース 4 文字
-   **行末の空白**: 削除する

### 2. PHP タグ

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

// コード...
```

### 3. クラス定義

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class LoginController extends Controller
{
    // メソッド...
}
```

### 4. メソッド定義

```php
public function store(Request $request): RedirectResponse
{
    // 実装...
}

private function validateCredentials(array $credentials): bool
{
    // 実装...
}
```

### 5. 制御構造

```php
// if文
if ($condition) {
    // 処理
} elseif ($anotherCondition) {
    // 処理
} else {
    // 処理
}

// foreach文
foreach ($items as $item) {
    // 処理
}

// try-catch文
try {
    // 処理
} catch (Exception $e) {
    // 例外処理
}
```

### 6. 配列

```php
// 短縮記法を使用
$array = [
    'key1' => 'value1',
    'key2' => 'value2',
    'key3' => 'value3',
];

// 多行配列では末尾にカンマ
$config = [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
    ],
    'cache' => [
        'driver' => 'redis',
    ],
];
```

## Laravel Pint の使用方法

このプロジェクトでは、Laravel Pint を使用して PSR-12 準拠を自動化しています。

### インストール確認

Laravel Pint は既にプロジェクトに含まれています：

```bash
cd src
composer show laravel/pint
```

### 使用可能なコマンド

#### 1. コードスタイルチェック

```bash
# Composerスクリプト経由
cd src
composer format:check

# 直接実行
./vendor/bin/pint --test
```

#### 2. コードスタイル自動修正

```bash
cd src
# Composerスクリプト経由
composer format
# または
composer format:fix

# 直接実行
./vendor/bin/pint
```

#### 3. 特定のファイルのみ処理

```bash
# 特定のファイル
./vendor/bin/pint app/Http/Controllers/Auth/LoginController.php

# 特定のディレクトリ
./vendor/bin/pint app/Http/Controllers/
```

## 設定ファイル

プロジェクトの Pint 設定は `pint.json` で管理されています：

```json
{
    "preset": "psr12",
    "rules": {
        "array_syntax": {
            "syntax": "short"
        },
        "no_unused_imports": true,
        "single_quote": true,
        "trailing_comma_in_multiline": {
            "elements": ["arrays"]
        }
    },
    "exclude": ["bootstrap", "storage", "vendor"]
}
```

## 開発ワークフロー

### 1. コード作成前

新しいコードを書く前に、PSR-12 ルールを意識してコーディングしてください。

### 2. コード作成後

```bash
cd src
# コードスタイルをチェック
composer format:check

# 問題があれば自動修正
composer format:fix
```

### 3. コミット前

```bash
cd src
# 最終チェック
composer format:check

# テスト実行
composer test
```

## IDE の設定

### VSCode

`.vscode/settings.json` に以下を追加：

```json
{
    "php.format.enable": false,
    "editor.formatOnSave": false,
    "[php]": {
        "editor.defaultFormatter": "open-southeners.laravel-pint"
    }
}
```

### PhpStorm

1. Settings → Tools → External Tools
2. 新しいツールを作成
3. Name: Laravel Pint
4. Program: `./vendor/bin/pint`
5. Arguments: `$FileDir$/$FileName$`

## よくある問題と解決方法

### 1. 未使用の import 文

```php
// ❌ 悪い例
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // 使用されていない

// ✅ 良い例
use Illuminate\Http\Request;
```

### 2. 配列の末尾カンマ

```php
// ❌ 悪い例
$array = [
    'item1',
    'item2'
];

// ✅ 良い例
$array = [
    'item1',
    'item2',
];
```

### 3. 制御構造の括弧

```php
// ❌ 悪い例
if($condition)
{
    // 処理
}

// ✅ 良い例
if ($condition) {
    // 処理
}
```

## チーム開発での運用

### 1. プルリクエスト前のチェック

```bash
# コードスタイルチェック
composer format:check

# 自動修正
composer format:fix

# テスト実行
composer test
```

### 2. CI/CD での自動チェック

※未作成

### 3. コードレビュー

-   PSR-12 準拠は自動化されているため、レビューでは**ロジック**と**設計**に集中
-   スタイル修正は手動ではなく、Pint で自動修正

## メリット

1. **コードの統一性**: チーム全体で一貫したコードスタイル
2. **可読性向上**: 誰が読んでも理解しやすいコード
3. **レビュー効率化**: スタイルではなく本質的な部分に集中
4. **保守性向上**: 将来的なメンテナンスが容易
5. **プロフェッショナル**: 業界標準に準拠した高品質なコード

## 参考資料

-   [PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/)
-   [Laravel Pint Documentation](https://laravel.com/docs/pint)
-   [PHP-CS-Fixer Documentation](https://cs.symfony.com/)

## まとめ

PSR-12 の導入により、コードの品質と開発効率が大幅に向上します。自動化ツールを活用して、チーム全体で一貫したコーディングスタイルを維持しましょう。
