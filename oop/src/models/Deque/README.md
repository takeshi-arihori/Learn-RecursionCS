# Deque（両端キュー）インターフェース実装

## 概要

この演習では、一般的なデータ構造のインターフェースを形成する方法を学習します。ここでは、**Deque**（両端キュー）のインターフェースとその関連インターフェース（Stack、Queue）を作成します。

デックはスタックとキューの両方として使用できることに注目してください。デックでは、要素を前に追加したり、前から要素を削除することができます。また、要素を後ろに追加したり、後ろから要素を削除することもできます。

## インターフェース仕様

### Stack インターフェース（LIFO - Last-In First-Out）

スタックは LIFO 形式に従うリストです。後ろにプッシュ（追加）、後ろからポップ（削除）、後ろの要素を返すピークがすべて **O(1)** で実行できなければなりません。

**メソッド:**
- `peekLast(): ?int` - リストの最後の要素を返します（要素を削除しません）
- `pop(): ?int` - リストの最後の要素を削除し、削除した要素を返します
- `push(int $value): void` - 要素をリストの最後に追加します

### Queue インターフェース（FIFO - First-In First-Out）

キューは FIFO 形式に従うリストです。後ろにエンキュー（追加）、前からデキュー（削除）、最初の要素を返すピークが必要です。

**メソッド:**
- `peekFirst(): ?int` - リストの最初の要素を返します（要素を削除しません）
- `poll(): ?int` - リストの最初の要素を削除し、削除した要素を返します
- `push(int $value): void` - 要素をリストの最後に追加します

### Deque インターフェース（両端キュー）

Deque インターフェースは、Stack と Queue の両方から拡張されます。Deque は、Stack と Queue のすべての振る舞いを持ち、さらにリストの前に要素を追加する能力（addFirst）を持つインターフェースです。

**メソッド:**
- Stack のすべてのメソッドを継承
- Queue のすべてのメソッドを継承
- `addFirst(int $value): void` - 要素をリストの最初に追加します

## PHP実装における特徴

```php
// PHPでは、インターフェースの複数継承が可能です
interface Deque extends Stack, Queue {
    public function addFirst(int $value): void;
}
```

## UML図

UML図は `docs/deque.puml` ファイルに記載されています。インターフェースは上部に `<<interface>>` の説明を持ち、関係の矢印は継承と同じで、線と未塗装のダイヤモンド矢印ですが、矢印は破線になります。

## 実装要件

- すべての基本操作（push、pop、poll、peek）は **O(1)** の計算量で実行されること
- 空の状態での操作に対する適切な処理（null返却）
- 型安全性の確保（int型のみ扱う）

## 使用例

```php
$deque = new DequeImpl();

// Stack として使用（LIFO）
$deque->push(1);
$deque->push(2);
echo $deque->peekLast(); // 2
echo $deque->pop();      // 2

// Queue として使用（FIFO）
$deque->push(3);
$deque->push(4);
echo $deque->peekFirst(); // 1
echo $deque->poll();      // 1

// Deque として使用
$deque->addFirst(0);     // 先頭に追加
```

## 実行方法

### テスト実行
```bash
# プロジェクトルート（oop）から実行
cd oop

# Deque関連のテストのみ実行
./vendor/bin/phpunit tests/Deque/

# 特定のテストクラスのみ実行
./vendor/bin/phpunit tests/Deque/StackTest.php
./vendor/bin/phpunit tests/Deque/QueueTest.php
./vendor/bin/phpunit tests/Deque/DequeTest.php
```

### 静的解析実行
```bash
# Deque専用のPHPStan設定を使用（推奨）
./vendor/bin/phpstan analyse -c src/Models/Deque/phpstan.neon

# プロジェクト全体のPHPStan設定を使用
./vendor/bin/phpstan analyse src/Models/Deque/ tests/Deque/ --level=9
```

### コード品質チェック
```bash
# すべての品質チェックを実行（テスト + 静的解析）
composer quality

# フォーマットチェック
composer format:check

# フォーマット適用
composer format
```

## ディレクトリ構成
```
src/Models/Deque/
├── Stack.php              # Stack インターフェース
├── Queue.php              # Queue インターフェース  
├── Deque.php              # Deque インターフェース
├── DequeImpl.php          # Deque 具象実装クラス
├── phpstan.neon           # PHPStan 設定（Deque専用）
├── README.md              # このファイル
└── docs/
    └── deque.puml         # UML図（PlantUML形式）

tests/Deque/
├── StackTest.php          # Stack動作テスト
├── QueueTest.php          # Queue動作テスト
└── DequeTest.php          # Deque統合テスト
```
