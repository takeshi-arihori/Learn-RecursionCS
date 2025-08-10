# Lang-training - 言語別トレーニング

## 概要
特定のプログラミング言語に焦点を当てた実践的なトレーニングプログラムです。GoとTypeScriptを通じて、現代的なWeb開発とシステムプログラミングの技術を習得します。

## 構成

### 📁 go/
Go言語によるWeb APIサーバー開発

#### ファイル構成
- **main.go**: メインアプリケーションとサーバー起動
- **handler.go**: HTTPハンドラーとルーティング
- **models.go**: データモデルとビジネスロジック
- **go.mod**: Go モジュール設定
- **web/**: フロントエンド（HTML/CSS/JS）
  - **index.html**: メインHTMLページ
  - **css/app.css**: スタイルシート
  - **js/app.js**: JavaScript クライアント

#### 学習内容
- Go言語の基本文法と特徴
- HTTP サーバーの構築（net/http パッケージ）
- RESTful API 設計
- CORS（Cross-Origin Resource Sharing）設定
- JSON データの処理
- フロントエンドとの連携

#### 実行方法
```bash
cd lang-training/go
go run .
```

#### API エンドポイント
- `GET /api/hello` - Hello World レスポンス
- `GET /api/categories` - カテゴリーデータの取得
- `POST /api/calculator` - 計算機能

#### 開発サーバー
- URL: http://localhost:8000
- フロントエンド: web/index.html でAPI動作確認可能

### 📁 typescript/
TypeScript による型安全な開発

#### 学習内容
- TypeScript の基本文法
- 型システムの活用
- インターフェースとクラス
- ジェネリクス
- モジュールシステム

#### コンパイル方法
```bash
cd lang-training/typescript
npx tsc  # TypeScript コンパイル
```

## 学習目標

### 🎯 Go言語マスタリー
- Goの並行プログラミング（goroutine、channel）
- 標準ライブラリの効果的な使用
- エラーハンドリングのベストプラクティス
- パフォーマンスを考慮した設計

### 🎯 Web API 開発
- RESTful API 設計原則
- HTTP ステータスコードの適切な使用
- API ドキュメントの作成
- セキュリティ考慮事項

### 🎯 TypeScript 活用
- 型安全なコード記述
- 大規模プロジェクトでの型管理
- JavaScript エコシステムとの統合
- 開発ツールとの連携

### 🎯 フルスタック開発
- フロントエンド・バックエンドの連携
- データ形式の統一（JSON）
- エラーハンドリングの統合
- ユーザーエクスペリエンスの向上

## 推奨学習順序

### Go言語
1. **main.go** - Goサーバーの基本構造
2. **models.go** - データモデルの設計
3. **handler.go** - HTTPハンドラーの実装
4. **web/** - フロントエンドとの統合

### TypeScript
1. **基本型システム** - プリミティブ型とオブジェクト型
2. **インターフェース** - 構造的型付け
3. **クラスとジェネリクス** - 再利用可能なコード
4. **モジュール** - コードの組織化

## 開発環境

### Go
- Go 1.19+ 推奨
- エディタ: Visual Studio Code + Go 拡張
- デバッガ: Delve

### TypeScript
- Node.js 18+ 推奨
- TypeScript 4.9+ 推奨
- エディタ: Visual Studio Code + TypeScript 拡張

## 前提知識
- プログラミング基礎（変数、関数、制御構造）
- HTTP の基本概念
- JSON データ形式
- HTML/CSS/JavaScript の基礎

## 応用課題
- 認証機能の実装
- データベース連携
- テストケースの作成
- Docker コンテナ化
- CI/CD パイプライン構築