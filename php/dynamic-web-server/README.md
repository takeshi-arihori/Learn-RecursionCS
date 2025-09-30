# 🌐 Dynamic Web Server

## 概要 (Overview)
動的Webサーバー実装モジュール。エンジン系クラス（ガソリン・電気）、共通ロガー機能、インターフェース設計パターンを通じて、現代的なWebアプリケーション開発手法を学習します。

## 実装要件 (Implementation Requirements)
- **言語**: PHP 8.4+
- **テストフレームワーク**: Pest PHP 4.1
- **静的解析**: PHPStan Level 9
- **ロギング**: 共通Loggerインターフェース実装
- **実行環境**: Docker (PHP-FPM + Nginx)

## 実行方法 (Execution Instructions)

### Docker環境での実行
```bash
# Docker環境起動
docker-compose up -d

# Dynamic Web Server専用コンテナでの作業
docker-compose exec php-web bash

# または、プロファイル指定での起動
docker-compose --profile web up -d
docker-compose exec php-web bash
```

### Webブラウザでの実行
```bash
# Docker起動後、ブラウザで以下にアクセス
http://web.localhost:8080
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

# 特定のテストスイート実行
./vendor/bin/pest --filter=Engine
./vendor/bin/pest --filter=Logger
```

### 静的解析
```bash
# PHPStan解析 (Level 9)
composer analyze

# 詳細出力
./vendor/bin/phpstan analyse src Common tests --level=9 --verbose
```

### ログ確認
```bash
# アプリケーションログ確認
tail -f logs/app.log

# エラーログ確認
tail -f /var/log/php_errors.log
```

## ディレクトリ構成 (Directory Structure)
```
dynamic-web-server/
├── src/                     # アプリケーションソース
│   ├── Engine/             # エンジン系クラス
│   │   ├── GasolineEngine.php
│   │   └── ElectoricEngine.php
│   └── Interfaces/         # インターフェース定義
│       └── Engine.php
├── Common/                  # 共通ライブラリ
│   └── Logger/             # ログ機能
│       ├── LoggerInterface.php
│       ├── Logger.php
│       └── LogLevel.php
├── tests/                   # テストファイル (Pest)
├── logs/                    # ログファイル
├── composer.json           # 依存関係管理
├── phpstan.neon           # 静的解析設定 (Level 9)
└── README.md              # このファイル
```

## 使用例 (Usage Examples)

### エンジンクラスの使用
```php
<?php
declare(strict_types=1);

require_once 'src/Engine/GasolineEngine.php';
require_once 'src/Engine/ElectoricEngine.php';

// ガソリンエンジンの作成と操作
$gasolineEngine = new GasolineEngine();
$gasolineEngine->start();
echo $gasolineEngine->getStatus(); // "running"

$gasolineEngine->accelerate(50);
echo $gasolineEngine->getSpeed(); // 50

$gasolineEngine->stop();
echo $gasolineEngine->getStatus(); // "stopped"

// 電気エンジンの作成と操作
$electricEngine = new ElectoricEngine();
$electricEngine->start();
$electricEngine->accelerate(80);
echo $electricEngine->getBatteryLevel(); // バッテリー残量表示
```

### ロガーの使用
```php
<?php
declare(strict_types=1);

require_once 'Common/Logger/Logger.php';
require_once 'Common/Logger/LogLevel.php';

// ロガーインスタンス作成
$logger = new Logger('DynamicWebServer');

// 各レベルでのログ出力
$logger->debug('デバッグ情報: エンジン初期化開始');
$logger->info('情報: ガソリンエンジンが正常に起動しました');
$logger->warning('警告: バッテリー残量が20%を下回りました');
$logger->error('エラー: エンジン起動に失敗しました');
$logger->critical('致命的: システムが応答しません');

// コンテキスト付きログ
$logger->info('エンジン状態変更', [
    'engine_type' => 'gasoline',
    'previous_state' => 'idle',
    'new_state' => 'running',
    'speed' => 45
]);
```

### インターフェース活用
```php
<?php
declare(strict_types=1);

use src\Interfaces\Engine;

// ポリモーフィズムの実装例
function operateEngine(Engine $engine): void {
    $engine->start();
    $engine->accelerate(60);

    echo "Engine status: " . $engine->getStatus() . "\n";
    echo "Current speed: " . $engine->getSpeed() . " km/h\n";

    $engine->stop();
}

// 異なるエンジンタイプで同じ操作
$engines = [
    new GasolineEngine(),
    new ElectoricEngine()
];

foreach ($engines as $engine) {
    operateEngine($engine);
}
```

## アーキテクチャパターン

### インターフェース分離原則 (ISP)
```php
interface Engine {
    public function start(): void;
    public function stop(): void;
    public function accelerate(int $speed): void;
    public function getStatus(): string;
    public function getSpeed(): int;
}

// 各実装クラスが必要なメソッドのみ実装
class GasolineEngine implements Engine { /* ... */ }
class ElectoricEngine implements Engine { /* ... */ }
```

### 依存性注入 (DI)
```php
class Vehicle {
    private Engine $engine;
    private LoggerInterface $logger;

    public function __construct(Engine $engine, LoggerInterface $logger) {
        $this->engine = $engine;
        $this->logger = $logger;
    }

    public function start(): void {
        $this->logger->info('Vehicle starting...');
        $this->engine->start();
        $this->logger->info('Vehicle started successfully');
    }
}
```

### ファクトリーパターン
```php
class EngineFactory {
    public static function create(string $type): Engine {
        switch ($type) {
            case 'gasoline':
                return new GasolineEngine();
            case 'electric':
                return new ElectoricEngine();
            default:
                throw new InvalidArgumentException("Unknown engine type: $type");
        }
    }
}

// 使用例
$engine = EngineFactory::create('electric');
```

## ログレベルとその用途

### LogLevel定数
```php
class LogLevel {
    public const DEBUG = 'debug';      // 開発時のデバッグ情報
    public const INFO = 'info';        // 一般的な情報
    public const WARNING = 'warning';  // 警告（処理は継続）
    public const ERROR = 'error';      // エラー（機能に影響）
    public const CRITICAL = 'critical'; // 致命的エラー（システム停止）
}
```

### ログ出力例
```php
// デバッグ情報
$logger->debug('エンジンパラメータ確認', ['rpm' => 3000, 'temperature' => 85]);

// 運用情報
$logger->info('エンジン始動完了');

// 警告
$logger->warning('燃料残量低下', ['fuel_level' => 15]);

// エラー
$logger->error('エンジン異常検出', ['error_code' => 'E001']);

// 致命的エラー
$logger->critical('システム緊急停止');
```

## Pest テストの書き方

### エンジンテスト例
```php
<?php

use src\Engine\GasolineEngine;
use src\Engine\ElectoricEngine;

describe('GasolineEngine', function () {
    test('エンジンを正常に起動できる', function () {
        $engine = new GasolineEngine();
        $engine->start();

        expect($engine->getStatus())->toBe('running');
    });

    test('加速後の速度が正しく設定される', function () {
        $engine = new GasolineEngine();
        $engine->start();
        $engine->accelerate(60);

        expect($engine->getSpeed())->toBe(60);
    });
});

describe('ElectoricEngine', function () {
    test('バッテリーレベルが適切に管理される', function () {
        $engine = new ElectoricEngine();
        $initialBattery = $engine->getBatteryLevel();

        $engine->start();
        $engine->accelerate(80);

        expect($engine->getBatteryLevel())->toBeLessThan($initialBattery);
    });
});
```

### ロガーテスト例
```php
<?php

use Common\Logger\Logger;
use Common\Logger\LogLevel;

describe('Logger', function () {
    test('ログメッセージが正しいフォーマットで出力される', function () {
        $logger = new Logger('TestApp');

        // ログファイルへの出力をテスト
        $logger->info('テストメッセージ');

        $logContent = file_get_contents('logs/app.log');
        expect($logContent)->toContain('テストメッセージ');
        expect($logContent)->toContain('[INFO]');
    });
});
```

## Docker環境の詳細設定

### 環境変数
- `PHP_IDE_CONFIG=serverName=docker`
- `XDEBUG_CONFIG=client_host=host.docker.internal`

### ポート設定
- **HTTP**: http://web.localhost:8080
- **Xdebug**: 9003 (IDE接続用)

### ボリュームマウント
- ソースコード: `/workspace` (読み書き可能)
- ログファイル: `./logs` (永続化)
- Composerキャッシュ: 専用ボリューム

## パフォーマンス最適化

### ログパフォーマンス
```php
// 条件付きログ出力
if ($logger->isDebugEnabled()) {
    $logger->debug('詳細情報', $expensiveOperation());
}

// 非同期ログ出力（ハイパフォーマンス環境）
$logger->asyncLog(LogLevel::INFO, 'メッセージ');
```

### メモリ使用量監視
```php
$logger->info('Memory usage', [
    'current' => memory_get_usage(true),
    'peak' => memory_get_peak_usage(true)
]);
```

## TDD開発ワークフロー
```bash
# 1. 失敗するテストを書く (Red)
./vendor/bin/pest --filter=新機能Test

# 2. 最小限のコードで成功させる (Green)
# 実装...
./vendor/bin/pest --filter=新機能Test

# 3. リファクタリング (Refactor)
composer quality
```

## トラブルシューティング

### よくある問題
1. **ログファイル書き込みエラー**
   ```bash
   # 権限設定
   chmod 755 logs/
   chown www-data:www-data logs/
   ```

2. **Pest実行エラー**
   ```bash
   # Pestキャッシュクリア
   ./vendor/bin/pest --clear-cache
   ```

3. **インターフェース実装エラー**
   ```php
   // 全メソッドの実装確認
   class MyEngine implements Engine {
       // 必須: start(), stop(), accelerate(), getStatus(), getSpeed()
   }
   ```

4. **Docker接続エラー**
   ```bash
   # コンテナ再起動
   docker-compose restart php-web
   ```

### デバッグテクニック
```php
// エンジン状態のダンプ
function debugEngine(Engine $engine): void {
    error_log("Engine Debug: " . json_encode([
        'status' => $engine->getStatus(),
        'speed' => $engine->getSpeed(),
        'class' => get_class($engine)
    ]));
}
```

---

このREADMEに従って開発することで、現代的なWebアプリケーション設計パターンとPHPベストプラクティスを効率的に習得できます。