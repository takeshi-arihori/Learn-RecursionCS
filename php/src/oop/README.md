# 🏞️ 農場シミュレーションゲーム（OOP Implementation）

## 📋 プロジェクト概要

このプロジェクトは、オブジェクト指向プログラミング（OOP）の「継承」概念を実用的にモデル化した農場経営シミュレーションゲームです。TDD（Test-Driven Development）手法により段階的に実装されており、プレイヤーは農場を経営し、動物を飼育して収益を上げることを目指します。

## 🎯 学習目的

- **継承の実践**: Animal → Mammal/Bird → Cow/Horse/Chicken の継承関係
- **TDD手法**: Red → Green → Refactor サイクルの体験
- **PSR-12準拠**: 業界標準のコーディングスタイル
- **静的解析**: PHPStanによる品質管理
- **ログシステム**: 共通ログ機能の実装

## 📁 プロジェクト構成

```
oop/
├── src/                           # ソースコード
│   ├── Common/                    # 共通機能
│   │   └── Logger/               # ログシステム
│   ├── Models/
│   │   ├── Animal/               # 動物クラス群
│   │   │   ├── Animal.php        # 基底クラス
│   │   │   ├── Mammal.php        # 哺乳類
│   │   │   ├── Bird.php          # 鳥類 ✅
│   │   │   ├── Person.php        # 人物（農場主）✅
│   │   │   ├── Cow.php           # 牛 🚧
│   │   │   ├── Horse.php         # 馬 🚧
│   │   │   └── Chicken.php       # 鶏 🚧
│   │   ├── Farm/                 # 農場管理
│   │   │   └── Farm.php          # 農場クラス ✅
│   │   └── Product/              # 生産物
│   │       └── Egg.php           # 卵 🚧
├── tests/                        # テストファイル
│   ├── Common/Logger/            # ログテスト ✅
│   ├── Animal/                   # 動物テスト
│   ├── Farm/                     # 農場テスト ✅
│   └── Product/                  # 生産物テスト 🚧
├── docs/                         # ドキュメント
│   ├── logs/                     # ログ設計書
│   └── rules/                    # コーディング規約
├── logs/                         # ログファイル出力先
├── composer.json                 # 依存関係設定
├── phpstan.neon                 # 静的解析設定
└── pint.json                    # コードフォーマット設定
```

## 🚀 クイックスタート

### 1. 環境セットアップ

```bash
# プロジェクトディレクトリに移動
cd oop

# 依存関係をインストール
composer install
```

### 2. 開発コマンド

```bash
# 🧪 テスト実行
composer test

# 🎨 コードフォーマット
composer format

# 🔍 静的解析
composer analyze

# ✨ 全品質チェック（フォーマット + 解析 + テスト）
composer quality
```

### 3. 個別テスト実行

```bash
# 特定のテストクラスを実行
./vendor/bin/phpunit tests/Common/Logger/LoggerTest.php
./vendor/bin/phpunit tests/Animal/BirdTest.php
./vendor/bin/phpunit tests/Animal/PersonTest.php
./vendor/bin/phpunit tests/Farm/FarmTest.php

# テストカバレッジ付き実行（要Xdebug）
./vendor/bin/phpunit --coverage-html coverage/
```

## 📊 現在の実装状況

### ✅ 完了済み（Green状態）

| クラス | テスト数 | 状態 | 説明 |
|--------|---------|------|------|
| **Logger** | 9/9 | ✅ | 共通ログシステム完全実装 |
| **Bird** | 12/12 | ✅ | 鳥類基底クラス完全実装 |
| **Person** | 5/12 | ⚠️ | 基本機能完了、動物関連は依存待ち |
| **Farm** | 4/14 | ⚠️ | 基本機能完了、動物関連は依存待ち |

### 🚧 実装中/予定

| クラス | 優先度 | 説明 |
|--------|--------|------|
| **Cow** | 🔥 High | 牛クラス（搾乳機能） |
| **Horse** | 🔥 High | 馬クラス（調教機能） |
| **Chicken** | 🔥 High | 鶏クラス（産卵機能） |
| **Egg** | 🔥 High | 卵クラス（生産物） |

## 🎮 使用方法

### 基本的な農場シミュレーション

```php
<?php
require_once 'vendor/autoload.php';

use App\Models\Animal\Person;
use App\Models\Farm\Farm;
use App\Models\Animal\Cow;

// 1. 農場主を作成
$farmer = new Person(
    'human',           // species
    1.75,             // heightM
    70.0,             // weightKg
    30000.0,          // lifeSpanDays
    'male',           // biologicalSex
    0.5,              // furLengthCm
    'straight',       // furType
    36.5,             // avgBodyTemperatureC
    'John Doe',       // name
    10000.0           // money
);

// 2. 農場を作成
$farm = new Farm('Green Valley Farm');
$farmer->setFarm($farm);

// 3. 動物を購入（実装完了後）
// $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', ...);
// $farmer->buyAnimal($cow, 2000.0);

// 4. 日々の管理
// $farmer->feedAnimal($cow);
// $farm->dailyUpdate();
// $revenue = $farm->calculateRevenue();
// $farmer->collectRevenue();

echo $farmer . "\n";
echo $farm . "\n";
```

### ログ機能の使用

```php
use App\Common\Logger\Logger;
use App\Common\Logger\LogLevel;

$logger = new Logger();

$logger->info('Farm operation started');
$logger->warning('Low food supply');
$logger->error('Animal health issue detected');

// コンテキスト付きログ
$logger->log(LogLevel::INFO, 'Animal purchased', [
    'type' => 'cow',
    'price' => 2000.0,
    'farm' => 'Green Valley Farm'
]);
```

## 🔧 開発ツール

### PHPStan（静的解析）

```bash
# レベル8（最高）で解析
./vendor/bin/phpstan analyse

# 設定ファイル: phpstan.neon
# - 厳密な型チェック
# - 未使用変数検出  
# - 型推論の改善
```

### Laravel Pint（コードフォーマッター）

```bash
# PSR-12準拠でフォーマット
./vendor/bin/pint

# チェックのみ（修正しない）
./vendor/bin/pint --test

# 設定ファイル: pint.json
# - 短縮記法配列 []
# - 単一引用符使用
# - 末尾カンマ追加
```

## 📝 TDD開発フロー

### Red → Green → Refactor サイクル

```bash
# 1. Red: テスト作成（失敗させる）
./vendor/bin/phpunit tests/Animal/CowTest.php
# → Tests: 10, Failures: 10 ❌

# 2. Green: 最小実装（テスト通す）
# src/Models/Animal/Cow.php を実装
./vendor/bin/phpunit tests/Animal/CowTest.php  
# → Tests: 10, Failures: 0 ✅

# 3. Refactor: コード改善
composer format    # フォーマット
composer analyze   # 静的解析
```

## 📚 設計パターン

### 継承階層

```
Animal (基底クラス)
├── Mammal (哺乳類)
│   ├── Person (人物) ✅
│   ├── Cow (牛) 🚧
│   └── Horse (馬) 🚧
└── Bird (鳥類) ✅
    ├── Chicken (鶏) 🚧
    └── Parrot (オウム) 💡
```

### 集約関係

```
Person "1" ━━ "0..1" Farm "1" ━━ "0..*" Animal
```

## 🧪 テスト戦略

### Given-When-Then パターン

```php
public function testCowCanProduceMilk(): void
{
    // Given: 健康な乳牛がいる
    $cow = new Cow('Holstein', 1.5, 600.0, 7300.0, 'female', ...);
    
    // When: 搾乳する
    $milk = $cow->produceMilk();
    
    // Then: 牛乳が生産される
    $this->assertInstanceOf(Milk::class, $milk);
    $this->assertGreaterThan(0, $milk->getVolume());
}
```

### テストカテゴリ

- **Unit Tests**: 各クラスの単体機能
- **Integration Tests**: クラス間の連携
- **Behavior Tests**: ビジネスロジック検証

## 🐛 トラブルシューティング

### よくある問題

**1. クラスが見つからない**
```bash
# オートローダーを再生成
composer dump-autoload
```

**2. テストが失敗する**
```bash
# 依存関係を確認
composer install
./vendor/bin/phpunit --verbose
```

**3. PHPStanエラー**
```bash
# 型注釈を追加
public function someMethod(): void
// または設定を調整（phpstan.neon）
```

**4. コードフォーマットエラー**
```bash
# 自動修正
composer format
# 手動確認
composer format:check
```

## 📈 今後の拡張予定

### Phase 2: 動物クラス完成
- [ ] Cow, Horse, Chicken クラス実装
- [ ] Egg 生産物クラス実装
- [ ] 全テストGreen状態達成

### Phase 3: ゲーム機能拡張
- [ ] 季節システム
- [ ] 動物の病気システム
- [ ] マーケット価格変動
- [ ] 新しい動物種追加

### Phase 4: UI/UX
- [ ] CLI インターフェース
- [ ] ゲーム進行管理
- [ ] セーブ/ロード機能

## 🤝 コントリビューション

このプロジェクトはTDD学習用です。以下の手順で開発に参加できます：

```bash
# 1. フィーチャーブランチ作成
git checkout -b feature/new-animal-class

# 2. TDDサイクルで開発
# Red → Green → Refactor

# 3. 品質チェック
composer quality

# 4. コミット
git commit -m "feat: Add new animal class with TDD"

# 5. プルリクエスト作成
gh pr create --title "Add new animal class" --body "TDD implementation"
```

## 📞 サポート

- **ドキュメント**: `docs/` ディレクトリ参照
- **要件定義**: `src/Models/Animal/README.md`
- **コーディング規約**: `docs/rules/psr12-coding-style.md`
- **ログ設計**: `docs/logs/logging.md`

---

## 🏷️ メタ情報

- **言語**: PHP 8.3+
- **フレームワーク**: なし（Pure PHP）
- **テスト**: PHPUnit 12.3+
- **静的解析**: PHPStan 1.12+
- **フォーマッター**: Laravel Pint 1.24+
- **標準**: PSR-12準拠
- **ライセンス**: 学習用
- **作成者**: Claude Code + TDD methodology

**🎯 学習効果**: 継承・ポリモーフィズム・カプセル化・TDD手法・品質管理ツール