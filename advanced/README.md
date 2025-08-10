# Advanced - 上級レベル

## 概要
高度なデータ構造とアルゴリズムの実装を通じて、プログラミングの深い理解を目指します。PHPとJavaを使用して、実践的なアルゴリズム問題に取り組みます。

## 構成

### 📁 php/
PHP による二分木の実装と操作

#### ファイル構成
- **BinaryTree/BinaryTree.php**: 基本的な二分木の実装
- **BinaryTree/BinarySearchTree.php**: 二分探索木の実装
- **GymConstruction.php**: ジム建設問題（動的プログラミング）
- **main.php**: メイン実行ファイル

#### 学習内容
- 二分木の基本構造
- ノードの挿入、削除、検索
- 木の走査アルゴリズム（前順、中順、後順）
- バランス調整
- 動的プログラミングの応用

#### 実行方法
```bash
cd advanced/php
php main.php
```

#### テスト実行
```bash
cd advanced/php/tests
php BinaryTreeTest.php
php BinarySearchTreeTest.php
```

### 📁 java/
Java による高度なアルゴリズム実装

#### ファイル構成
- **BinaryTree.java**: Javaでの二分木実装
- **LinkedList.java**: 連結リストの実装
- **MergeSortedLinkedLists.java**: ソート済み連結リストのマージ
- **SlidingWindowAlgorithm.java**: スライディングウィンドウ法
- **GymConstruction.java**: ジム建設問題（動的プログラミング）
- **StockForecast.java**: 株価予測アルゴリズム

#### 学習内容
- 高度なデータ構造の実装
- アルゴリズムの時間・空間計算量の分析
- 動的プログラミング
- グラフアルゴリズム
- 最適化技法

#### コンパイル・実行
```bash
cd advanced/java
javac *.java
java BinaryTree
java LinkedList
# その他のクラスも同様に実行
```

## 学習目標

### 🎯 データ構造の理解
- 木構造の基本概念と応用
- 連結リストの操作とメモリ管理
- 効率的なデータアクセス方法

### 🎯 アルゴリズム設計
- 分割統治法の応用
- 動的プログラミングによる最適化
- スライディングウィンドウによる効率化

### 🎯 計算量最適化
- Big O 記法による時間計算量分析
- 空間効率の改善
- アルゴリズムの実装選択

## 推奨学習順序

### PHP学習順序
1. **php/BinaryTree/BinaryTree.php** - 基本的な木構造の理解
2. **php/BinaryTree/BinarySearchTree.php** - 探索効率の改善
3. **php/GymConstruction.php** - 動的プログラミングの基礎

### Java学習順序
1. **java/LinkedList.java** - 線形データ構造の実装
2. **java/MergeSortedLinkedLists.java** - マージ操作の実装
3. **java/SlidingWindowAlgorithm.java** - 効率的な範囲処理
4. **java/BinaryTree.java** - Java での木構造実装
5. **java/GymConstruction.java** - 動的プログラミング応用
6. **java/StockForecast.java** - 実践的な予測アルゴリズム

## 前提知識
- プログラミング基礎（変数、関数、制御構造）
- オブジェクト指向の基本概念
- 基本的なアルゴリズム（ソート、探索）