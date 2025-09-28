# 📚 Beginner PHP

## 概要 (Overview)
PHP基礎プログラミング演習モジュール。プログラミングの基本概念と PHP の基本構文を学習します。

## 実装要件 (Implementation Requirements)
- **言語**: PHP 8.4+
- **テストフレームワーク**: Pest PHP 3.0
- **静的解析**: PHPStan Level 9
- **コードフォーマット**: Laravel Pint
- **実行環境**: Docker (PHP-FPM + Nginx)

## 実行方法 (Execution Instructions)

### Docker環境での実行
```bash
# Docker環境起動
docker-compose up -d

# Beginner PHP専用コンテナでの作業
docker-compose exec php-beginner bash

# または、プロファイル指定での起動
docker-compose --profile beginner up -d
docker-compose exec php-beginner bash
```

### Webブラウザでの実行
```bash
# Docker起動後、ブラウザで以下にアクセス
http://beginner.localhost:8080
```

### 依存関係インストール
```bash
# コンテナ内で実行
composer install
```

### テスト実行
```bash
# Pestテスト実行
composer test

# カバレッジ付きテスト
composer test:coverage

# 単体テストのみ
composer test:unit
```

### 静的解析
```bash
# PHPStan解析 (Level 9)
composer analyze

# 詳細出力
./vendor/bin/phpstan analyse src tests --level=9 --verbose
```

### コード品質チェック
```bash
# フォーマットチェック
composer format:check

# 自動フォーマット適用
composer format

# 全品質チェック実行
composer quality
```

### 個別実行
```bash
# メインプログラム実行
php main.php

# 関数直接実行
php -r "require 'src/convert_to_century.php'; echo convertToCentury(1905);"
```

## ディレクトリ構成 (Directory Structure)
```
beginner/php/
├── src/                     # 実装ファイル
│   └── convert_to_century.php
├── tests/                   # テストファイル (Pest)
│   └── ConvertToCenturyTest.php
├── main.php                 # エントリーポイント
├── composer.json            # 依存関係管理
├── phpstan.neon            # 静的解析設定 (Level 9)
├── README.md               # このファイル
└── vendor/                 # Composer依存関係 (自動生成)
```

## 使用例 (Usage Examples)

### 世紀変換関数の使用
```php
<?php
declare(strict_types=1);

require_once 'src/convert_to_century.php';

// 年を世紀に変換
echo convertToCentury(1905);  // 出力: 20
echo convertToCentury(2000);  // 出力: 20
echo convertToCentury(2001);  // 出力: 21
```

### Pestテストの書き方
```php
<?php

use function Pest\testFunction;

test('世紀変換が正常に動作する', function () {
    expect(convertToCentury(1905))->toBe(20);
    expect(convertToCentury(2000))->toBe(20);
    expect(convertToCentury(2001))->toBe(21);
});
```

## TDD開発ワークフロー
```bash
# 1. 失敗するテストを書く (Red)
composer test

# 2. 最小限のコードで成功させる (Green)
# 実装...
composer test

# 3. リファクタリング (Refactor)
composer quality
```

## Docker環境の詳細設定

### 環境変数
- `PHP_IDE_CONFIG=serverName=docker`
- `XDEBUG_CONFIG=client_host=host.docker.internal`

### ポート設定
- **HTTP**: http://beginner.localhost:8080
- **Xdebug**: 9003 (IDE接続用)

### ボリュームマウント
- ソースコード: `/workspace` (読み書き可能)
- Composerキャッシュ: 専用ボリューム

## トラブルシューティング

### よくある問題
1. **Composerインストールエラー**
   ```bash
   # キャッシュクリア
   composer clear-cache
   composer install
   ```

2. **PHPStanエラー**
   ```bash
   # ベースライン生成
   ./vendor/bin/phpstan analyse --generate-baseline
   ```

3. **Docker接続エラー**
   ```bash
   # コンテナ再起動
   docker-compose restart php-beginner
   ```

---

このREADMEに従って開発を進めることで、PHP基礎プログラミングの学習と品質保証が両立できます。