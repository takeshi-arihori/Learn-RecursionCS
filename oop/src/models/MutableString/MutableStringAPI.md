# MutableString API 仕様書

## 概要
`MutableString` は状態を変更可能な文字列データ構造です。この実装では、ミューテータメソッドを含む動的文字列操作機能を提供します。

## 不変性（Immutability）vs 可変性（Mutability）の設計思想

### 不変オブジェクトの重要性と利点

#### 1. 安全性の向上
不変オブジェクトを使用する最大の理由は**安全性**にあります：
- **予期しない変更の防止**: データが突然変化することを防ぎ、意図しない副作用を避ける
- **参照の安全性**: 他の部分のコードやスレッドにオブジェクトを安心して渡すことができる
- **データ整合性**: 読み取り専用であることを保証するため、データの一貫性が保たれる

#### 2. 並行プログラミングでの効果
- **スレッドセーフティ**: 複数のスレッドやコンピュータが同時にアクセスしても安全
- **競合状態の回避**: データ競合状態（Race Condition）を根本的に防ぐ
- **デバッグの容易さ**: データが変化しないため、状態の追跡とデバッグが容易

#### 3. メモリ効率の向上
- **メモリ共有**: 同じ内容の文字列は一つのメモリアドレスを共有可能
- **例**: "hello"がコード中に何千回現れても、メモリ上では一つのインスタンス
- **ガベージコレクション**: 不要なオブジェクトの管理が効率的

### 不変性のパフォーマンス上の課題

#### 1. 文字列結合の計算量問題
- **コピーコスト**: 2つの文字列を結合する際、両方の文字列を新しい文字列にコピーが必要
- **時間複雑度**: 操作時間は文字列のサイズに比例（O(n)）
- **具体例**: 20,000文字 + "hi" の結合 = 実際に20,002ステップが必要

#### 2. 大規模データでの影響
- **小さな文字列**: 数文字〜数百文字では問題にならない
- **大きなテキスト**: 数十万文字レベルでは重要な性能問題
- **連続操作**: 複数回の結合では指数的にパフォーマンスが悪化

#### 3. 解決策とベストプラクティス
- **文字配列の活用**: 結合操作を文字配列で行い、最後に文字列に変換
- **StringBuilder パターン**: 効率的な文字列構築のためのパターン
- **バッファリング**: 適切なサイズのバッファを事前確保

### MutableStringの設計判断

このクラスは以下の状況で**不変性よりもパフォーマンスを優先**する設計です：

#### 適用場面
- **大量の文字列操作**: 連続した追加・変更操作が頻繁に発生
- **パフォーマンス重視**: 応答時間やスループットが重要な要件
- **単一スレッド環境**: 並行アクセスが想定されない環境
- **プロトタイピング**: 開発速度を重視する初期段階

#### 使用時の注意点とリスク
- **マルチスレッド**: 適切な同期メカニズム（ロック等）が必要
- **オブジェクト共有**: 複数箇所からの参照時は予期しない変更に注意
- **デバッグ**: 状態変化の追跡が困難になる可能性
- **副作用**: 他のコードに影響を与える可能性を常に考慮

#### 設計原則
- **明示的な変更**: 変更操作であることを明確に示すメソッド名
- **防御的プログラミング**: 入力値の検証と適切なエラーハンドリング
- **ドキュメント**: 変更による影響を明確に記載

## クラス仕様

### 名前空間
```php
namespace App\Models\MutableString;
```

### クラス名
```php
class MutableString
```

## API メソッド仕様

### 1. append(string $c): void
**目的**: 文字を文字列の末尾に追加します。

**パラメータ**:
- `$c` (string): 追加する文字または文字列

**戻り値**: void

**動作**:
- 現在の文字列の末尾に指定された文字または文字列を追加
- 元の文字列を変更（ミューテート）
- **パフォーマンス特性**: O(1) の時間複雑度で効率的な追加操作

**不変性とのトレードオフ**:
- **利点**: 新しいオブジェクト作成不要で高速
- **注意点**: このオブジェクトを参照している他のコードからも変更が見える
- **マルチスレッド**: 競合状態の可能性があるため同期が必要

**例**:
```php
$ms = new MutableString("Hello");
$ms->append("!");
// 結果: "Hello!"
```

### 2. substring(int $start): MutableString
**目的**: 指定されたインデックスから最後までの部分文字列を持つ新しい `MutableString` オブジェクトを返します。

**パラメータ**:
- `$start` (int): 開始インデックス（0ベース）

**戻り値**: `MutableString` - 新しいインスタンス

**動作**:
- 元の文字列は変更されません
- 新しい `MutableString` インスタンスを作成して返す

**例**:
```php
$ms = new MutableString("Hello World");
$result = $ms->substring(6);
// 結果: 新しいMutableString("World")
```

### 3. substring(int $startIndex, int $endIndex): MutableString
**目的**: 指定されたインデックス範囲の部分文字列を持つ新しい `MutableString` オブジェクトを返します。

**パラメータ**:
- `$startIndex` (int): 開始インデックス（0ベース、含む）
- `$endIndex` (int): 終了インデックス（0ベース、含まない）

**戻り値**: `MutableString` - 新しいインスタンス

**動作**:
- 元の文字列は変更されません
- 新しい `MutableString` インスタンスを作成して返す

**例**:
```php
$ms = new MutableString("Hello World");
$result = $ms->substring(0, 5);
// 結果: 新しいMutableString("Hello")
```

### 4. concat(array $cArr): void
**目的**: 文字配列を現在の文字列に連結します。

**パラメータ**:
- `$cArr` (array): 文字の配列

**戻り値**: void

**動作**:
- 現在の文字列に文字配列を連結: `S = S + cArr`
- 元の文字列を変更（ミューテート）

**例**:
```php
$ms = new MutableString("Hello");
$ms->concat(['!', '!']);
// 結果: "Hello!!"
```

### 5. concat(string $stringInput): void
**目的**: 文字列を現在の文字列に連結します。

**パラメータ**:
- `$stringInput` (string): 連結する文字列

**戻り値**: void

**動作**:
- 現在の文字列に指定された文字列を連結: `S = S + stringInput`
- 元の文字列を変更（ミューテート）

**例**:
```php
$ms = new MutableString("Hello");
$ms->concat(" World");
// 結果: "Hello World"
```

### 6. concat(MutableString $stringInput): void
**目的**: `MutableString` オブジェクトを現在の文字列に連結します。

**パラメータ**:
- `$stringInput` (MutableString): 連結する `MutableString` オブジェクト

**戻り値**: void

**動作**:
- 現在の文字列に指定された `MutableString` の文字列を連結: `S = S + stringInput`
- 元の文字列を変更（ミューテート）

**例**:
```php
$ms1 = new MutableString("Hello");
$ms2 = new MutableString(" World");
$ms1->concat($ms2);
// 結果: ms1は "Hello World"
```

### 7. length(): int
**目的**: 現在の文字列の長さを返します。

**パラメータ**: なし

**戻り値**: `int` - 文字列の長さ

**動作**:
- 現在の文字列の文字数を計算して返す
- 元の文字列は変更されません

**例**:
```php
$ms = new MutableString("Hello");
$length = $ms->length();
// 結果: 5
```

## 実装上の注意事項

### メソッドオーバーロード
PHPはネイティブなメソッドオーバーロードをサポートしないため、以下の方法で実装：
- 異なるメソッド名を使用（例: `substringFromStart`, `substringFromRange`）
- または、パラメータの数や型をチェックして動作を分岐

### 型チェック
動的言語としてのPHPでは、以下の型チェックを実装：
- `is_string()`: 文字列型の確認
- `is_array()`: 配列型の確認
- `instanceof`: MutableStringインスタンスの確認
- `is_int()`: 整数型の確認

### エラーハンドリング
- 無効なインデックスに対する適切な例外処理
- 型不一致時の例外処理
- 範囲外アクセスの防止

### パフォーマンス考慮事項
- **文字列の内部表現**: 効率的なバッファ管理
- **大きな文字列での最適化**: 部分文字列操作の最適化
- **メモリ使用量**: 不要なコピー操作の最小化
- **時間複雑度**: 各操作の計算量を考慮した実装

### 不変性 vs 可変性の実装指針

#### Mutableメソッド（オブジェクト自体を変更）
- `append()`: 末尾への追加
- `concat()`: 文字列・配列・MutableStringの連結
- **特徴**: 高速だが副作用あり

#### Immutableメソッド（新しいオブジェクトを返却）
- `substring()`: 部分文字列の取得
- **特徴**: 安全だが新しいオブジェクト作成のコスト

#### 読み取り専用メソッド（状態変更なし）
- `length()`: 長さの取得
- `getValue()`: 現在の値の取得
- **特徴**: 副作用なし、安全

## 使用例

### 基本的な使用パターン
```php
use App\Models\MutableString\MutableString;

// 初期化（複数の方法）
$ms1 = new MutableString("Hello");        // 初期値あり
$ms2 = new MutableString();               // 空文字列
$ms3 = new MutableString(null);           // null -> 空文字列

// 文字追加（Mutable操作）
$ms1->append("!");                        // "Hello!"
$ms1->append(" World");                   // "Hello! World"

// 文字列連結（Mutable操作）
$ms1->concat([" ", "P", "H", "P"]);      // 文字配列の連結
$ms1->concat(" is awesome");              // 文字列の連結

$ms4 = new MutableString(" 2024");
$ms1->concat($ms4);                       // MutableStringの連結

// 部分文字列取得（Immutable操作）
$substr = $ms1->substring(0, 5);          // 新しいオブジェクト
$endPart = $ms1->substring(6);            // インデックス6から最後まで

// 長さ取得（読み取り専用）
$length = $ms1->length();

// 値の取得
echo $ms1;                                // __toString() 使用
echo $ms1->getValue();                    // 明示的な取得
```

### パフォーマンスを考慮した使用例
```php
// 大量の文字列操作が必要な場合
$ms = new MutableString();

// 不変文字列だと O(n²) になる操作が O(n) で実行可能
for ($i = 0; $i < 10000; $i++) {
    $ms->append("data_" . $i . "\n");
}

// 最終的な文字列を取得
$result = $ms->getValue();
```

### マルチスレッド環境での注意例
```php
// 注意：以下のようなコードは競合状態の可能性
$sharedString = new MutableString("initial");

// スレッド1
$sharedString->append(" from thread 1");

// スレッド2（同時実行）
$sharedString->append(" from thread 2");

// 結果は予測不可能
// "initial from thread 1 from thread 2" または
// "initial from thread 2 from thread 1" など
```