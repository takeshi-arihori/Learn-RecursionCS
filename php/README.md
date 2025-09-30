# PHP プロジェクト統合ディレクトリ

## 概要

このディレクトリには、RecursionCurriculumの全PHPプロジェクトが統合されています。各プロジェクトは独立した構成を持ちながら、統一された開発環境とツールチェーンで管理されています。

## プロジェクト一覧

### 1. beginner/ - 基礎PHP演習
**概要**: PHPの基本文法とプログラミング概念を学習

**実行方法**:
```bash
cd php/beginner
php main.php

# テスト実行
php tests/ConvertToCenturyTest.php
```

**学習内容**:
- 変数、関数、制御構造
- PHP基本文法
- 基礎的なアルゴリズム

---

### 2. intermediate/ - 中級アルゴリズム
**概要**: 高度なアルゴリズムとTDD（テスト駆動開発）

**実行方法**:
```bash
cd php/intermediate

# テスト実行（PHPUnit）
./vendor/bin/phpunit tests/

# 静的解析
./vendor/bin/phpstan analyse --memory-limit=512M

# 品質チェック
composer quality
```

**学習内容**:
- ソートアルゴリズム
- 探索アルゴリズム
- 数学的アルゴリズム
- PHPUnit テスト作成

---

### 3. advanced/ - 高度データ構造
**概要**: 二分木やリストなどの複雑なデータ構造実装

**実行方法**:
```bash
cd php/advanced
php main.php

# テスト実行
./vendor/bin/phpunit tests/
```

**学習内容**:
- 二分木（BinaryTree）
- 連結リスト
- 計算量最適化
- 高度なアルゴリズム設計

---

### 4. oop/ - オブジェクト指向プログラミング
**概要**: OOP設計パターンとDocker統合環境

**実行方法**:
```bash
cd php/oop

# テスト実行（PHPUnit）
./vendor/bin/phpunit

# 静的解析（PHPStan Level 9）
./vendor/bin/phpstan analyse

# コードフォーマット
./vendor/bin/pint

# 品質チェック（全部実行）
composer quality

# Docker環境起動
docker-compose up -d
```

**学習内容**:
- クラス設計と継承
- インターフェースと抽象クラス
- カプセル化
- PSR-4 オートローディング
- Given-When-Then テストパターン

**主要クラス**:
- Person, Wallet クラス
- インターフェース分離原則の実践
- Docker統合開発環境

---

### 5. dynamic-web-server/ - Webサーバープロジェクト
**概要**: OOP設計による動的Webサーバー実装（Pest テスト）

**実行方法**:
```bash
cd php/dynamic-web-server

# サーバー起動
php index.php

# テスト実行（Pest）
./vendor/bin/pest

# カバレッジ付きテスト
composer test:coverage

# 静的解析（PHPStan Level 9）
./vendor/bin/phpstan analyse --memory-limit=512M

# 品質チェック
composer quality
```

**学習内容**:
- Car/Engine システム設計
  - ElectricCar, GasCar
  - ElectricEngine, GasolineEngine
- ロギングシステム（LoggerInterface）
- 依存性注入（DI）
- Pest テストフレームワーク
- 18テストケース実装

**アーキテクチャ**:
```
src/
├── Cars/
│   ├── ElectricCar.php
│   └── GasCar.php
└── Engine/
    ├── ElectricEngine.php
    └── GasolineEngine.php
Logger/
└── LoggerInterface.php
```

---

### 6. docker-php/ - PHP Docker統合環境
**概要**: PHP開発用のDocker環境設定

**環境構成**:
- PHP 8.4-fpm
- Nginx Webサーバー
- MySQL 8.0
- phpMyAdmin

**起動方法**:
```bash
# Makefileから起動（推奨）
cd /path/to/recursionCurriculum
make up-php

# 直接起動
cd php/docker-php
docker-compose up -d
```

**主要ファイル**:
- `docker-compose.yml`: サービス定義
- `Dockerfile`: PHP環境設定
- `nginx/conf.d/default.conf`: Nginx設定
- `mysql/init/`: データベース初期化SQL

---

## 統一開発ツール

### 依存関係管理（Composer）
```bash
# プロジェクトルートから全プロジェクト一括インストール
cd /path/to/recursionCurriculum
make composer-install

# 個別プロジェクト
cd php/{project_name}
composer install
```

### テスト実行

#### PHPUnit（intermediate, advanced, oop）
```bash
cd php/{project}
./vendor/bin/phpunit
./vendor/bin/phpunit tests/SpecificTest.php
./vendor/bin/phpunit --coverage-html coverage/
```

#### Pest（dynamic-web-server）
```bash
cd php/dynamic-web-server
./vendor/bin/pest
./vendor/bin/pest --coverage
```

### 静的解析（PHPStan）
**推奨**: Level 9 で最高品質を維持

```bash
cd php/{project}

# 基本解析
./vendor/bin/phpstan analyse

# メモリ上限指定
./vendor/bin/phpstan analyse --memory-limit=512M

# 特定ディレクトリ
./vendor/bin/phpstan analyse src/ tests/ --level=9
```

### コードフォーマット（Laravel Pint）
```bash
cd php/oop
./vendor/bin/pint           # フォーマット適用
./vendor/bin/pint --test    # チェックのみ
```

### 品質チェック（統合）
各プロジェクトの `composer.json` に定義:
```bash
composer quality
# 実行内容: format check + phpstan + test
```

---

## Makefileクイックコマンド

プロジェクトルートから使用可能:

```bash
# テスト実行
make test-beginner
make test-intermediate
make test-advanced
make test-oop
make test-web

# Composer インストール
make composer-install-beginner
make composer-install-intermediate
make composer-install-advanced
make composer-install-oop
make composer-install-web

# 全プロジェクト一括
make test                    # 全テスト実行
make phpstan                 # 全静的解析
make composer-install        # 全依存関係インストール
make quality                 # 全品質チェック
```

---

## 開発規約

### コーディング標準
- **PSR-4**: オートローディング規約準拠
- **PSR-12**: コーディングスタイル準拠
- **Strict Types**: 全ファイルで `declare(strict_types=1)` 使用
- **DocBlock**: 全クラス・メソッドに詳細なドキュメント記述
- **Type Hints**: 引数と戻り値の型を明示

### テスト駆動開発（TDD）
1. **Red**: 失敗するテストを書く
2. **Green**: テストをパスする最小限のコードを書く
3. **Refactor**: コードをリファクタリング

### Given-When-Then パターン
```php
public function test_feature(): void
{
    // Given: 前提条件
    $user = new User('John');

    // When: 実行
    $result = $user->getName();

    // Then: 検証
    $this->assertEquals('John', $result);
}
```

### PHPStan設定
各プロジェクトに `phpstan.neon` を配置:
```yaml
parameters:
    level: 9  # 最高レベル推奨
    paths:
        - src
        - tests
```

---

## ディレクトリ構造標準

各プロジェクトの推奨構造:

```
php/{project}/
├── src/                  # 実装コード
│   ├── Models/          # モデルクラス
│   ├── Controllers/     # コントローラー（必要に応じて）
│   └── Services/        # サービスクラス（必要に応じて）
├── tests/               # テストコード
│   ├── Unit/           # ユニットテスト
│   └── Integration/    # 統合テスト
├── docs/                # ドキュメント
│   └── diagrams/       # PlantUML図
├── vendor/              # Composer依存関係（.gitignore）
├── composer.json        # 依存関係定義
├── composer.lock        # バージョンロック
├── phpstan.neon         # 静的解析設定
├── phpunit.xml          # PHPUnit設定（PHPUnit使用時）
├── .gitignore          # Git除外設定
└── README.md           # プロジェクト説明
```

---

## トラブルシューティング

### Composer依存関係エラー
```bash
# キャッシュクリア
composer clear-cache
composer install --no-cache

# オートロード再生成
composer dump-autoload
```

### PHPStan メモリエラー
```bash
# メモリ上限を増やす
./vendor/bin/phpstan analyse --memory-limit=512M
./vendor/bin/phpstan analyse --memory-limit=1G
```

### テスト失敗時
```bash
# 詳細出力
./vendor/bin/phpunit --verbose
./vendor/bin/pest --bail  # 最初の失敗で停止
```

---

## 参考リンク

- [PHPUnit Documentation](https://phpunit.de/)
- [Pest PHP Documentation](https://pestphp.com/)
- [PHPStan Documentation](https://phpstan.org/)
- [PSR-4 Autoloading](https://www.php-fig.org/psr/psr-4/)
- [PSR-12 Coding Style](https://www.php-fig.org/psr/psr-12/)
- [Laravel Pint](https://laravel.com/docs/pint)

---

## 更新履歴

- **2025-09-30**: PHP統合ディレクトリ構造導入
  - beginner, intermediate, advanced, oop, dynamic-web-server, docker-php を統合
  - Makefile パス参照更新
  - 統一README作成