# OOP - オブジェクト指向プログラミング

## 概要
PHP を使用したオブジェクト指向プログラミングの実践学習です。Docker環境でテスト駆動開発（TDD）を行い、クラス設計、継承、カプセル化などのOOPの核心概念を学習します。

## プロジェクト構成

```
oop/
├── src/models/          # モデルクラス
│   ├── Person.php      # 人物クラス
│   └── Wallet.php      # 財布クラス
├── tests/              # テストクラス
│   ├── PersonTest.php  # Person クラステスト
│   └── WalletTest.php  # Wallet クラステスト
├── docker/             # Docker設定
│   ├── nginx/          # Nginx設定
│   └── php/            # PHP設定
├── public/             # Web公開ディレクトリ
├── vendor/             # Composer依存関係
├── compose.yaml        # Docker Compose設定
├── composer.json       # Composer設定
└── phpunit.xml         # PHPUnit設定
```

## セットアップと実行

### Docker環境の起動
```bash
cd oop
docker-compose up -d
```

### テスト実行
```bash
# 全テスト実行
./vendor/bin/phpunit

# 特定テストクラス実行
./vendor/bin/phpunit tests/PersonTest.php
./vendor/bin/phpunit tests/WalletTest.php

# テスト詳細表示
./vendor/bin/phpunit --verbose
```

### Composer依存関係管理
```bash
# 依存関係インストール
composer install

# 依存関係更新
composer update
```

### Web アクセス
- URL: http://localhost:8080 (Nginx経由)
- 直接アクセス: public/index.php

## クラス構造

### Walletクラス（完全実装済み）
財布を表すクラス。各種紙幣（1, 5, 10, 20, 50, 100ドル）を管理します。

**プロパティ:**
- `bill1`, `bill5`, `bill10`, `bill20`, `bill50`, `bill100`: 各紙幣の枚数

**メソッド:**
- `__construct()`: 全紙幣を0で初期化
- `getTotalMoney()`: 財布内の総額を計算
- `insertBill(int $bill, int $amount)`: 指定した紙幣を追加

### Personクラス（一部実装済み）
人を表すクラス。基本情報と財布を持ちます。

**プロパティ:**
- `firstName`, `lastName`: 名前
- `age`: 年齢
- `heightM`: 身長（メートル）
- `weightKg`: 体重（キログラム）
- `wallet`: 財布（Walletオブジェクトまたはnull）

**実装済みメソッド:**
- `__construct()`: 基本情報を設定、財布はnullで初期化
- `getCash()`: 財布内の総額を取得（財布がない場合は0）
- `printState()`: 人の状態を出力
- `addWallet(Wallet $wallet)`: 財布を設定（TDD実装済み）

**未実装メソッド（TDD対象）:**
- `getPaid(int $amount)`: 指定額を受け取り、財布に適切な紙幣で格納
- `spendMoney(int $amount)`: 指定額を支払い、財布から紙幣を取り出す
- `dropWallet()`: 財布を手放す

## TDD（テスト駆動開発）の進め方

### TDDの基本サイクル：Red-Green-Refactor

#### 1. Red（失敗）- テストを書いて失敗させる

未実装メソッドのテストを有効化します：

```php
// tests/PersonTest.php で以下の行を削除
$this->markTestIncomplete('メソッド名 method is not implemented yet');
```

例：`getPaid`メソッドの場合
```php
public function testGetPaid(): void
{
    // $this->markTestIncomplete('getPaid method is not implemented yet'); // この行を削除
    
    $wallet = new Wallet();
    $this->person->wallet = $wallet;
    
    $result = $this->person->getPaid(186);
    
    // 186 = 1x100 + 1x50 + 1x20 + 1x10 + 1x5 + 1x1
    $expected = [1, 1, 1, 1, 1, 1]; // [bill1, bill5, bill10, bill20, bill50, bill100]
    $this->assertEquals($expected, $result);
    $this->assertEquals(186, $this->person->getCash());
}
```

テストを実行して失敗を確認：
```bash
./vendor/bin/phpunit --filter testGetPaid
```

#### 2. Green（成功）- 最小限の実装でテストを通す

`index.php`の該当メソッドを実装します：

```php
public function getPaid(int $amount): array
{
    if ($this->wallet === null) {
        return [];
    }
    
    // 最小限の実装（まず動くようにする）
    $bills = [0, 0, 0, 0, 0, 0]; // [bill1, bill5, bill10, bill20, bill50, bill100]
    
    // 大きい紙幣から順に計算
    $remaining = $amount;
    
    if ($remaining >= 100) {
        $bills[5] = intval($remaining / 100);
        $remaining = $remaining % 100;
        $this->wallet->insertBill(100, $bills[5]);
    }
    
    if ($remaining >= 50) {
        $bills[4] = intval($remaining / 50);
        $remaining = $remaining % 50;
        $this->wallet->insertBill(50, $bills[4]);
    }
    
    // 以下、20, 10, 5, 1の順で処理...
    
    return $bills;
}
```

テストを実行して成功を確認：
```bash
./vendor/bin/phpunit --filter testGetPaid
```

#### 3. Refactor（リファクタリング）- コードを改善する

テストが通ったら、コードをより読みやすく、保守しやすくリファクタリングします：

```php
public function getPaid(int $amount): array
{
    if ($this->wallet === null) {
        return [];
    }
    
    $denominations = [100, 50, 20, 10, 5, 1];
    $bills = [0, 0, 0, 0, 0, 0];
    $remaining = $amount;
    
    foreach ($denominations as $index => $denomination) {
        if ($remaining >= $denomination) {
            $count = intval($remaining / $denomination);
            $bills[5 - $index] = $count; // 配列の順序を調整
            $remaining = $remaining % $denomination;
            $this->wallet->insertBill($denomination, $count);
        }
    }
    
    return $bills;
}
```

再度テストを実行して、リファクタリング後も動作することを確認。

### TDD実装手順の例

#### 実装済み例：`addWallet`メソッド

1. **Red**: テストを有効化 → `TypeError: Return value must be of type Wallet, none returned`
2. **Green**: 最小実装
   ```php
   public function addWallet(Wallet $wallet): Wallet
   {
       $this->wallet = $wallet;
       return $wallet;
   }
   ```
3. **Refactor**: 今回はシンプルなのでそのまま

#### 未実装メソッドのテスト状況

現在の未実装メソッドと対応するテスト：

| メソッド | テストメソッド | 状態 |
|---------|---------------|------|
| `getPaid` | `testGetPaidShouldFail`, `testGetPaidWithoutWalletShouldFail` | 未実装（markTestIncomplete） |
| `spendMoney` | `testSpendMoneyShouldFail`, `testSpendMoneyInsufficientFundsShouldFail`, `testSpendMoneyWithoutWalletShouldFail` | 未実装（markTestIncomplete） |
| `dropWallet` | `testDropWalletShouldFail`, `testDropWalletWhenNoWalletShouldFail` | 未実装（markTestIncomplete） |

## テストの実行結果の読み方

```
PHPUnit 12.3.0 by Sebastian Bergmann and contributors.

......IIIII.II............                                        26 / 26 (100%)

Time: 00:00.014, Memory: 14.00 MB

OK, but there were issues!
Tests: 26, Assertions: 42, Incomplete: 7.
```

- `.`: 成功したテスト
- `I`: 未完了（markTestIncomplete）のテスト
- `E`: エラー
- `F`: 失敗
- `Tests: 26`: 総テスト数
- `Assertions: 42`: 総アサーション数
- `Incomplete: 7`: 未完了テスト数

## おすすめの学習順序

1. **Walletクラスの理解**: 既に実装済みなので、テストを見て動作を理解
2. **Personクラスの既存メソッド**: `getCash()`, `printState()`などの動作確認
3. **TDD実践**:
   1. `addWallet` → 実装済み（参考例）
   2. `dropWallet` → シンプルな実装
   3. `getPaid` → 少し複雑な実装
   4. `spendMoney` → 最も複雑な実装

## ヒント

### `getPaid`メソッドの実装ヒント
- 大きい紙幣から順に計算
- 各紙幣の枚数を配列で返す
- 財布がない場合は空配列を返す

### `spendMoney`メソッドの実装ヒント
- まず十分な資金があるかチェック
- 大きい紙幣から順に使用
- 不足している場合は何もしない（空配列を返す）
- 財布から実際に紙幣を減らす処理が必要

### `dropWallet`メソッドの実装ヒント
- 現在の財布を保存
- 財布をnullに設定
- 保存した財布を返す
- 財布がない場合はnullを返す

---

## トラブルシューティング

### よくあるエラー

1. **`Class 'PHPUnit\Framework\TestCase' not found`**
   ```bash
   composer install
   ```

2. **`Cannot declare class Wallet, because the name is already in use`**
   - `require_once`を使用しているか確認
   - ファイルが複数回読み込まれていないか確認

3. **`TypeError: Return value must be of type ...`**
   - メソッドの戻り値の型宣言と実際の戻り値が一致しているか確認
   - `return`文が抜けていないか確認

Happy TDD Learning! 🚀