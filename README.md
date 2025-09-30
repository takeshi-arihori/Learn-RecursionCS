# 🚀 RecursionCurriculum 統合開発環境

## 概要 (Overview)
RecursionCurriculumは、PHP、Java、JavaScript/TypeScript、Go、Python、C++、Cなど複数言語の学習を支援する統合プログラミング演習リポジトリです。Docker統合により、統一された開発環境で効率的な学習を実現します。

## 🐳 Docker統合環境

### 必要要件
- Docker Desktop
- Git
- 8GB以上のメモリ推奨

### 環境構成
- **PHP 8.4-fpm** + Nginx + MySQL 8.0
- **Pest PHP 3.0** + PHPUnit テスト環境
- **PHPStan Level 9** 静的解析
- **phpMyAdmin** データベース管理
- **Laravel Pint** コードフォーマット

## 🚀 クイックスタート

### 1. 環境起動
```bash
# リポジトリクローン
git clone <repository-url>
cd recursionCurriculum

# 全サービス起動
docker-compose up -d

# 起動確認
docker-compose ps
```

### 2. Webアクセス (ポートベース)
```bash
# メインダッシュボード
http://localhost:8080

# 各プロジェクト個別アクセス
http://localhost:8081      # 基礎PHP演習 (Beginner)
http://localhost:8082      # 中級アルゴリズム (Intermediate)
http://localhost:8083      # 高度データ構造 (Advanced)
http://localhost:8084      # オブジェクト指向 (OOP)
http://localhost:8085      # 動的Webサーバー (Dynamic Web Server)

# データベース管理
http://localhost:8090      # phpMyAdmin
http://localhost:3306      # MySQL直接接続
```

### 3. 開発環境接続
```bash
# 個別プロジェクト環境
docker-compose --profile beginner up -d
docker-compose exec php-beginner bash

# 統合CLI環境
docker-compose --profile cli up -d
docker-compose exec php-cli bash
```

## 🛠️ Makefile コマンド

便利なMakefileが用意されており、複雑なDockerコマンドを簡単に実行できます。

### 基本操作
```bash
make help          # 📋 利用可能なコマンド一覧
make up            # 🚀 Docker環境起動
make down          # 🛑 Docker環境停止
make restart       # 🔄 Docker環境再起動
make status        # 📊 環境状態確認
```

### 開発作業
```bash
make setup         # ⚙️  初回環境セットアップ（推奨）
make test          # 🧪 全プロジェクトテスト実行
make quality       # ✨ 全プロジェクト品質チェック
make format        # 🎨 コードフォーマット
make phpstan       # 🔍 PHPStan静的解析
```

### プロジェクト別操作
```bash
make test-beginner      # 🧪 Beginnerテスト実行
make test-intermediate  # 🧪 Intermediateテスト実行
make shell-oop         # 🐚 OOPプロジェクト環境接続
make composer-install  # 📦 全プロジェクト依存関係インストール
```

### データベース操作
```bash
make db-connect    # 🔌 MySQLコンソール接続
make db-test       # 🧪 データベース接続テスト
make db-backup     # 💾 データベースバックアップ
make phpmyadmin    # 🌐 phpMyAdminをブラウザで開く
```

### シェルアクセス
```bash
make shell               # 🐚 PHP-FPMコンテナ接続
make shell-beginner     # 🐚 Beginnerプロジェクト環境
make shell-mysql        # 🐚 MySQLコンテナ接続
```

### クリーンアップ
```bash
make clean         # 🧹 一時ファイル削除
make clean-docker  # 🧹 Docker関連クリーンアップ
```

## 💾 MySQL データベース

### 接続情報
```bash
Host: mysql (Docker内) / localhost (ホスト)
Port: 3306
Database: recursion_db
Username: recursion_user
Password: recursion_pass
Root Password: root_password
```

### 初期テーブル
- `users` - ユーザー管理
- `products` - 商品データ
- `categories` - カテゴリ分類
- `orders` / `order_items` - 注文管理
- `application_logs` - アプリケーションログ

### データベース操作例
```php
// 基本接続
$pdo = new PDO('mysql:host=mysql;dbname=recursion_db', 'recursion_user', 'recursion_pass');

// 接続サンプル実行
docker-compose exec php-fpm php /workspace/docker/examples/mysql-connection.php
```

## ディレクトリ構造

```
/
├── php/                      # PHP統合プロジェクト（新構造）
│   ├── beginner/            # 基礎PHP演習
│   ├── intermediate/        # 中級アルゴリズム（PHPUnit）
│   ├── advanced/           # 高度データ構造（二分木等）
│   ├── oop/                # オブジェクト指向（Docker統合）
│   ├── dynamic-web-server/ # Webサーバープロジェクト（Pest）
│   └── docker-php/         # PHP Docker環境設定
├── beginner/               # 多言語基礎演習
├── intermediate/           # 多言語中級演習
├── advanced/              # 高度アルゴリズム
│   └── java/             # Java実装
├── lang-training/        # 言語別トレーニング
│   ├── go/              # Go Web API
│   └── typescript/      # TypeScript演習
├── database/            # データベースプログラミング
│   └── c/              # C++実装
├── video-compressor/    # ネットワークプログラミング
│   └── python/         # Python UDP通信
└── daily/              # 学習ログと日記
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
- **PHP統合**: 全PHPプロジェクトを`php/`ディレクトリに統合
  - beginner, intermediate, advanced, oop, dynamic-web-server
  - Docker環境（php/docker-php/）で統一管理
- **Lang-training**: Go/TypeScript言語習得
- **Database**: C++によるデータベースプログラミング
- **Video-compressor**: Pythonネットワーキングとリアルタイム通信

## 🆕 新規プロジェクト作成ガイド

### 基本プロジェクト構成
新しいPHPプロジェクトを作成する際は、以下の標準構成に従ってください：

```
your-project/
├── src/                    # 実装コード
│   ├── Models/            # モデルクラス
│   ├── Controllers/       # コントローラー
│   └── Services/          # サービス層
├── tests/                 # テストコード
│   ├── Unit/             # ユニットテスト
│   └── Integration/      # 統合テスト
├── docs/                 # ドキュメント
├── composer.json         # 依存関係定義
├── phpstan.neon          # 静的解析設定
├── phpunit.xml           # テスト設定
├── pint.json            # コードフォーマット設定
├── README.md            # プロジェクト説明
└── index.php            # エントリーポイント
```

### 1. Composer設定 (composer.json)

```json
{
    "name": "recursion/your-project",
    "description": "Your project description",
    "type": "project",
    "require": {
        "php": "^8.4"
    },
    "require-dev": {
        "pestphp/pest": "^3.0",
        "phpunit/phpunit": "^11.0",
        "phpstan/phpstan": "^1.0",
        "laravel/pint": "^1.0"
    },
    "autoload": {
        "psr-4": {
            "YourProject\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "YourProject\\Tests\\": "tests/"
        }
    },
    "scripts": {
        "test": "pest",
        "analyze": "phpstan analyse",
        "format": "pint",
        "quality": ["@format", "@analyze", "@test"]
    }
}
```

### 2. データベース設定

#### MySQL接続例
```php
class DatabaseConnection {
    public static function create(): PDO {
        $host = 'mysql';        // Docker内のサービス名
        $dbname = 'recursion_db';
        $username = 'recursion_user';
        $password = 'recursion_pass';
        
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
        return new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
```

### 3. TDD開発ワークフロー

```bash
# 1. 新しい機能のテスト作成 (Red)
composer test  # 失敗することを確認

# 2. 最小限の実装 (Green)  
composer test  # 成功することを確認

# 3. リファクタリングと品質チェック
composer quality

# 4. コミット
git commit -m "feat: ✨ implement new feature"
```

### 4. 新規プロジェクトのDocker追加方法

#### A. Nginx設定追加 (docker/nginx/conf.d/default.conf)
```nginx
# Your Project (ポート8086)
server {
    listen 8086;
    server_name localhost;
    root /workspace/your-project;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php-fpm;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

#### B. docker-compose.yml にポート追加
```yaml
nginx:
  ports:
    - "8086:8086"  # 新しいプロジェクト用
```

#### C. メインダッシュボード更新
docker/nginx/html/index.html にプロジェクトリンクを追加

### 5. 推奨開発環境設定

#### PHPStan設定 (phpstan.neon)
```yaml
parameters:
    level: 9
    paths:
        - src/
        - tests/
```

#### テスト環境設定
```bash
# 依存関係インストール
composer install

# テスト実行
composer test

# 静的解析
composer analyze

# コードフォーマット
composer format
```

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
