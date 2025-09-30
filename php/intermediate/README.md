# 🔬 Intermediate PHP

## 概要 (Overview)
中級PHPアルゴリズムとデータ構造の実装モジュール。ソート、探索、数学的アルゴリズム、ブラックジャックゲームなど、実践的なプログラミング問題を扱います。

## 実装要件 (Implementation Requirements)
- **言語**: PHP 8.4+
- **テストフレームワーク**: Pest PHP 3.0 + PHPUnit 11.0 (併用)
- **静的解析**: PHPStan Level 9
- **コードフォーマット**: Laravel Pint
- **実行環境**: Docker (PHP-FPM + Nginx)

## 実行方法 (Execution Instructions)

### Docker環境での実行
```bash
# Docker環境起動
docker-compose up -d

# Intermediate PHP専用コンテナでの作業
docker-compose exec php-intermediate bash

# または、プロファイル指定での起動
docker-compose --profile intermediate up -d
docker-compose exec php-intermediate bash
```

### Webブラウザでの実行
```bash
# Docker起動後、ブラウザで以下にアクセス
http://intermediate.localhost:8080
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

# PHPUnitテスト実行（既存テスト）
composer test:phpunit

# カバレッジ付きテスト
composer test:coverage

# レガシーテスト実行
composer legacy:test
```

### 静的解析
```bash
# PHPStan解析 (Level 9)
composer analyze

# 詳細出力
./vendor/bin/phpstan analyse . --level=9 --verbose
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

# 個別アルゴリズム実行
php RGB.php
php Sort.php
php sqrt.php
```

## ディレクトリ構成 (Directory Structure)
```
intermediate/php/
├── blackjack/               # ブラックジャックゲーム実装
│   ├── Card.php
│   ├── Dealer.php
│   ├── Deck.php
│   └── HelperFunctions.php
├── tests/                   # テストファイル群
│   ├── BlackJackCardTest.php
│   ├── RGBTest.php
│   ├── SortTest.php
│   └── ... (その他テスト)
├── docs/                    # ドキュメント
├── main.php                 # エントリーポイント
├── RGB.php                  # RGB色変換アルゴリズム
├── Sort.php                 # ソートアルゴリズム実装
├── sqrt.php                 # 平方根計算（ニュートン法）
├── SieveOfElastoTenes.php  # エラトステネスの篩
├── MathSplit.php           # 数学的分割問題
├── RoundRobin.php          # ラウンドロビン実装
├── Files.php               # ファイル操作
├── Complement.php          # 補数計算
├── TabulationAndMemo.php   # 動的プログラミング
├── composer.json           # 依存関係管理
├── phpstan.neon           # 静的解析設定 (Level 9)
└── README.md              # このファイル
```

## 使用例 (Usage Examples)

### RGB色変換
```php
<?php
declare(strict_types=1);

require_once 'RGB.php';

// RGB値をHEXに変換
$hex = rgbToHex(255, 128, 0);
echo $hex; // "#FF8000"

// HEX値をRGBに変換
$rgb = hexToRgb("#FF8000");
print_r($rgb); // ["r" => 255, "g" => 128, "b" => 0]
```

### ソートアルゴリズム
```php
<?php
declare(strict_types=1);

require_once 'Sort.php';

$array = [64, 34, 25, 12, 22, 11, 90];

// バブルソート
$bubbleSorted = bubbleSort($array);

// クイックソート
$quickSorted = quickSort($array);

// マージソート
$mergeSorted = mergeSort($array);
```

### ブラックジャックゲーム
```php
<?php
declare(strict_types=1);

require_once 'blackjack/Deck.php';
require_once 'blackjack/Card.php';

$deck = new Deck();
$deck->shuffle();

$hand = [];
$hand[] = $deck->drawCard();
$hand[] = $deck->drawCard();

$handValue = calculateHandValue($hand);
echo "Hand value: " . $handValue;
```

### エラトステネスの篩
```php
<?php
declare(strict_types=1);

require_once 'SieveOfElastoTenes.php';

// 100以下の素数を取得
$primes = sieveOfEratosthenes(100);
echo "Primes up to 100: " . implode(', ', $primes);
```

## 数学的概念と実装

### 抽象化
複雑な問題を簡単にするため、大まかな要素だけに焦点を当てる手法

### 関数の合成
一つの関数の出力を別の関数の入力として使用する設計パターン

### 関数の分解
大きなタスクを小さなタスクに分割し、独立した関数として定義する手法

### 再帰
関数がその内部処理において自身を呼び出す処理パターン

#### multiplyOf7(5)の再帰例
```
multiplyOf7(5)
→ multiplyOf7(4) + 7
→ (multiplyOf7(3) + 7) + 7
→ ((multiplyOf7(2) + 7) + 7) + 7
→ (((multiplyOf7(1) + 7) + 7) + 7) + 7
→ ((((0 + 7) + 7) + 7) + 7) + 7
→ 35
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
- **HTTP**: http://intermediate.localhost:8080
- **Xdebug**: 9003 (IDE接続用)

### ボリュームマウント
- ソースコード: `/workspace` (読み書き可能)
- Composerキャッシュ: 専用ボリューム

## アルゴリズム一覧

### ソートアルゴリズム
- **バブルソート**: O(n²) - 教育用途
- **クイックソート**: O(n log n) - 実用的
- **マージソート**: O(n log n) - 安定ソート

### 探索アルゴリズム
- **線形探索**: O(n) - 単純探索
- **二分探索**: O(log n) - ソート済み配列用

### 数学的アルゴリズム
- **ニュートン法**: 平方根計算
- **エラトステネスの篩**: 素数生成
- **最大公約数**: ユークリッドの互除法

### 動的プログラミング
- **メモ化**: 計算結果キャッシュ
- **タブレーション**: ボトムアップ方式

## トラブルシューティング

### よくある問題
1. **Composer依存関係エラー**
   ```bash
   # キャッシュクリア
   composer clear-cache
   composer install
   ```

2. **PHPStan Level 9エラー**
   ```bash
   # ベースライン生成
   ./vendor/bin/phpstan analyse --generate-baseline
   ```

3. **レガシーテスト実行エラー**
   ```bash
   # 個別テスト実行
   php tests/RGBTest.php
   php tests/SortTest.php
   ```

4. **Docker接続エラー**
   ```bash
   # コンテナ再起動
   docker-compose restart php-intermediate
   ```

---

このREADMEに従って開発することで、中級レベルのアルゴリズムとデータ構造の実装スキルを効率的に習得できます。