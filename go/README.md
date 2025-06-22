# Go Web API 基本実装

Go言語の`net/http`標準ライブラリを使用したシンプルなWeb APIサーバーの実装です。

## 📋 実装されたエンドポイント

### 1. Hello API
**エンドポイント**: `GET /api/hello`

クエリパラメータとして名前を受け取り、挨拶メッセージを返します。

```bash
# リクエスト例
GET http://localhost:8000/api/hello?name=takeshi

# レスポンス例
{
  "message": "Hello takeshi"
}
```

**パラメータ**:
- `name` (optional): 挨拶する名前。未指定の場合は "World" がデフォルト

### 2. Categories API
**エンドポイント**: `GET /api/categories`

利用可能なカテゴリの一覧を配列で返します。

```bash
# リクエスト例
GET http://localhost:8000/api/categories

# レスポンス例
{
  "categories": [
    "Technology",
    "Sports", 
    "Music",
    "Food",
    "Travel",
    "Books",
    "Movies",
    "Gaming"
  ]
}
```

### 3. Calculator API
**エンドポイント**: `GET /api/calculator`

指定された2つの数値に対して四則演算を実行し、結果を返します。

```bash
# リクエスト例（加算）
GET http://localhost:8000/api/calculator?o=+&x=10&y=5

# レスポンス例
{
  "result": 15,
  "operation": "10.00 + 5.00"
}
```

**パラメータ**:
- `o` (required): 演算子 (`+`, `-`, `*`, `/`)
- `x` (required): 第一オペランド（数値）
- `y` (required): 第二オペランド（数値）

**サポートされる演算子**:
- `+`: 加算
- `-`: 減算  
- `*`: 乗算
- `/`: 除算

### エラーハンドリング

APIは適切なエラーハンドリングを実装しています：

```bash
# 必須パラメータ不足
{
  "error": "Missing required parameters: o, x, y"
}

# 不正な数値
{
  "error": "Invalid number for parameter x"
}

# ゼロ除算
{
  "error": "Division by zero is not allowed"
}

# サポートされていない演算子
{
  "error": "Unsupported operator. Use +, -, *, /"
}
```

## 🗂️ ファイル構成

```
backend/
├── main.go      # アプリケーションのエントリーポイント・HTTPサーバー起動
├── handlers.go  # HTTPリクエストの処理・エンドポイントのロジック
├── models.go    # データ構造の定義・JSON変換用の構造体
└── go.mod       # Go言語の依存関係管理ファイル
```

### ファイル詳細

#### `main.go`
- HTTPサーバーの起動とルート設定
- ポート8000でのリスニング
- 利用可能なエンドポイントの表示

#### `handlers.go`
- 各エンドポイントのビジネスロジック
- HTTPリクエスト/レスポンスの処理
- エラーハンドリングとバリデーション

#### `models.go`
- レスポンス用の構造体定義
- 型安全性の確保
- JSONシリアライゼーション用のタグ

## 🚀 使用方法

### 1. サーバー起動
```bash
# プロジェクトディレクトリに移動
cd backend

# サーバー実行
go run .
```

### 2. 動作確認
サーバー起動後、以下のURLにアクセスして動作確認：

```bash
# ブラウザまたはcurlでアクセス
curl "http://localhost:8000/api/hello?name=test"
curl "http://localhost:8000/api/categories"
curl "http://localhost:8000/api/calculator?o=+&x=10&y=5"
```

## 🛠️ 技術仕様

- **言語**: Go 1.24.4
- **ライブラリ**: 標準ライブラリのみ (`net/http`, `encoding/json`, `strconv`)
- **ポート**: 8000
- **レスポンス形式**: JSON
- **HTTPメソッド**: GET

## 📚 学習ポイント

この実装を通じて以下の技術を学習できます：

1. **Go言語の基本文法**: パッケージ、関数、構造体
2. **net/httpライブラリ**: HTTPサーバーの構築
3. **JSON処理**: `encoding/json`パッケージの使用
4. **エラーハンドリング**: 適切なHTTPステータスコードの返却
5. **クエリパラメータ処理**: URLからのパラメータ取得と検証
6. **コード分割**: 責任ごとのファイル分離

## 🔍 今後の拡張案

- [ ] ポート番号の環境変数化
- [ ] ログ機能の追加
- [ ] より複雑な計算機能（三角関数など）
- [ ] データ永続化（ファイル、データベース）
- [ ] 認証機能の追加
- [ ] CORS対応
- [ ] Docker化
