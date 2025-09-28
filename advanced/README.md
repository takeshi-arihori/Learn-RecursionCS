# 🎯 Advanced PHP

## 概要 (Overview)
高度なPHPアルゴリズムとデータ構造の実装モジュール。二分木、二分探索木、複雑なアルゴリズム設計などの高度なプログラミング概念を扱います。

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

# Advanced PHP専用コンテナでの作業
docker-compose exec php-advanced bash

# または、プロファイル指定での起動
docker-compose --profile advanced up -d
docker-compose exec php-advanced bash
```

### Webブラウザでの実行
```bash
# Docker起動後、ブラウザで以下にアクセス
http://advanced.localhost:8080
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

# 単体テストのみ
composer test:unit
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

# 個別クラス実行
php -r "require 'BinaryTree/BinaryTree.php'; \$tree = new BinaryTree(10); echo 'Tree created';"
```

## ディレクトリ構成 (Directory Structure)
```
advanced/php/
├── BinaryTree/              # 二分木実装群
│   ├── BinaryTree.php      # 基本二分木クラス
│   └── BinarySearchTree.php # 二分探索木クラス
├── tests/                   # テストファイル群
│   ├── BinaryTreeTest.php
│   └── BinarySearchTreeTest.php
├── main.php                 # エントリーポイント
├── GymConstruction.php      # ジム建設アルゴリズム
├── composer.json           # 依存関係管理
├── phpstan.neon           # 静的解析設定 (Level 9)
└── README.md              # このファイル
```

## 使用例 (Usage Examples)

### 二分木 (BinaryTree)
```php
<?php
declare(strict_types=1);

require_once 'BinaryTree/BinaryTree.php';

// 二分木の作成
$tree = new BinaryTree(10);

// 左右の子ノードを追加
$tree->left = new BinaryTree(5);
$tree->right = new BinaryTree(15);

// さらに子ノードを追加
$tree->left->left = new BinaryTree(3);
$tree->left->right = new BinaryTree(7);

// ツリーの探索
echo "Root value: " . $tree->data . "\n";
echo "Left child: " . $tree->left->data . "\n";
echo "Right child: " . $tree->right->data . "\n";
```

### 二分探索木 (BinarySearchTree)
```php
<?php
declare(strict_types=1);

require_once 'BinaryTree/BinarySearchTree.php';

// 二分探索木の作成
$bst = new BinarySearchTree();

// 要素の挿入
$bst->insert(50);
$bst->insert(30);
$bst->insert(70);
$bst->insert(20);
$bst->insert(40);
$bst->insert(60);
$bst->insert(80);

// 探索
$found = $bst->search(40);
echo $found ? "Found 40" : "Not found";

// 削除
$bst->delete(30);

// 走査（in-order, pre-order, post-order）
$inOrder = $bst->inOrderTraversal();
echo "In-order: " . implode(', ', $inOrder);
```

### ジム建設アルゴリズム
```php
<?php
declare(strict_types=1);

require_once 'GymConstruction.php';

// ジム建設の最適化問題
$locations = [
    ['x' => 1, 'y' => 1],
    ['x' => 3, 'y' => 4],
    ['x' => 6, 'y' => 2],
    ['x' => 8, 'y' => 7]
];

$optimalLocation = findOptimalGymLocation($locations);
echo "Optimal gym location: ({$optimalLocation['x']}, {$optimalLocation['y']})";
```

## 高度なアルゴリズム概念

### 二分木 (Binary Tree)
階層的なデータ構造で、各ノードが最大2つの子ノード（左と右）を持つ構造

#### 特徴:
- **完全二分木**: 葉ノード以外のすべてのノードが2つの子を持つ
- **平衡二分木**: 左右の部分木の高さの差が最大1
- **退化二分木**: 一方向にのみ伸びるリスト状の構造

### 二分探索木 (Binary Search Tree)
二分木の特殊形で、左の子ノード < 親ノード < 右の子ノードの関係を維持

#### 操作の計算量:
- **探索**: O(log n) ～ O(n)
- **挿入**: O(log n) ～ O(n)
- **削除**: O(log n) ～ O(n)

### 木の走査アルゴリズム

#### In-order走査 (中順走査)
```
左の部分木 → 根ノード → 右の部分木
結果: ソートされた順序で要素を取得
```

#### Pre-order走査 (前順走査)
```
根ノード → 左の部分木 → 右の部分木
結果: 木の構造を複製する際に使用
```

#### Post-order走査 (後順走査)
```
左の部分木 → 右の部分木 → 根ノード
結果: 木を削除する際に使用
```

### 最適化問題
#### ジム建設問題
複数の顧客の位置が与えられたとき、総移動距離を最小化するジムの位置を求める問題

**解法アプローチ:**
1. **総当たり法**: O(n³) - 全ての組み合わせを計算
2. **幾何中央値**: O(n log n) - 数学的最適化
3. **動的プログラミング**: 制約条件がある場合

## データ構造の応用

### 優先度キュー
二分ヒープを使用した効率的な優先度管理

### AVL木
自動平衡二分探索木による安定した性能保証

### 赤黒木
挿入・削除時の平衡維持アルゴリズム

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
- **HTTP**: http://advanced.localhost:8080
- **Xdebug**: 9003 (IDE接続用)

### ボリュームマウント
- ソースコード: `/workspace` (読み書き可能)
- Composerキャッシュ: 専用ボリューム

## パフォーマンス分析

### 時間計算量比較
```php
// 配列での探索: O(n)
$found = in_array($target, $array);

// 二分探索木での探索: O(log n)
$found = $bst->search($target);

// ハッシュテーブルでの探索: O(1)
$found = isset($hashTable[$target]);
```

### 空間計算量考慮
- **配列**: O(n) - 連続メモリ
- **リンクリスト**: O(n) - ポインタオーバーヘッド
- **二分木**: O(n) - ノードオブジェクト

## トラブルシューティング

### よくある問題
1. **メモリ不足エラー（深い再帰）**
   ```bash
   # PHP設定でメモリ制限を増加
   ini_set('memory_limit', '512M');
   ```

2. **スタックオーバーフロー**
   ```php
   // 反復的実装への変更を検討
   function iterativeTraversal($root) {
       $stack = [$root];
       // 実装...
   }
   ```

3. **PHPStan型エラー**
   ```bash
   # 型注釈の追加
   /**
    * @param BinaryTree|null $node
    * @return array<int>
    */
   ```

4. **Docker接続エラー**
   ```bash
   # コンテナ再起動
   docker-compose restart php-advanced
   ```

### デバッグテクニック
```php
// 木の構造を可視化
function printTree(BinaryTree $node, int $level = 0): void {
    if ($node === null) return;

    printTree($node->right, $level + 1);
    echo str_repeat("  ", $level) . $node->data . "\n";
    printTree($node->left, $level + 1);
}
```

---

このREADMEに従って開発することで、高度なデータ構造とアルゴリズムの実装スキルを効率的に習得できます。