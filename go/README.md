# Go Web API 基本実装

Go言語の`net/http`標準ライブラリを使用したシンプルなWeb APIサーバーとデモフロントエンドアプリケーションの実装です。

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
GET http://localhost:8000/api/calculator?o=plus&x=10&y=5

# レスポンス例
{
  "result": 15,
  "operation": "10.00 plus 5.00"
}
```

**パラメータ**:
- `o` (required): 演算子 (`+`, `-`, `*`, `/` または `plus`, `minus`, `multiply`, `divide`)
- `x` (required): 第一オペランド（数値）
- `y` (required): 第二オペランド（数値）

**サポートされる演算子**:
- `+` または `plus`: 加算
- `-` または `minus`: 減算  
- `*` または `multiply`: 乗算
- `/` または `divide`: 除算

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
  "error": "Unsupported operator. Use +, -, *, / or plus, minus, multiply, divide"
}
```

## 🗂️ ファイル構成

```
.
├── backend/             # Go言語のWeb APIサーバー
│   ├── main.go          # アプリケーションのエントリーポイント・HTTPサーバー起動
│   ├── handlers.go      # HTTPリクエストの処理・エンドポイントのロジック
│   ├── models.go        # データ構造の定義・JSON変換用の構造体
│   └── go.mod           # Go言語の依存関係管理ファイル
├── frontend/            # デモWebアプリケーション
│   ├── index.html       # デモアプリケーション・API動作確認用UI
│   ├── css/
│   │   └── app.css      # アプリケーションのスタイリング
│   └── js/
│       └── app.js       # API通信処理・UI制御・イベントハンドリング
└── README.md           # このファイル
```

### ファイル詳細

#### `backend/`
**`main.go`**
- HTTPサーバーの起動とルート設定
- ポート8000でのリスニング
- 利用可能なエンドポイントの表示

**`handlers.go`**
- 各エンドポイントのビジネスロジック
- HTTPリクエスト/レスポンスの処理
- エラーハンドリングとバリデーション
- CORS対応設定

**`models.go`**
- レスポンス用の構造体定義
- 型安全性の確保
- JSONシリアライゼーション用のタグ

#### `frontend/`
**`index.html`**
- デモアプリケーションのメインページ
- レスポンシブデザイン対応
- 3つのAPI機能を統合したUI

**`css/app.css`**
- モダンなグラデーションデザイン
- カード型レイアウト
- レスポンシブ対応
- アニメーション効果

**`js/app.js`**
- 各APIとの通信処理
- リアルタイムレスポンス表示
- エラーハンドリング
- サーバー接続状況確認

## 🚀 使用方法

### 1. バックエンドサーバー起動
```bash
# プロジェクトディレクトリに移動
cd backend

# サーバー実行
go run .
```

**起動確認**:
```
Starting the server on port 8000!
Server running at http://localhost:8000
Available endpoints:
  GET http://localhost:8000/api/hello?name=your_name
  GET http://localhost:8000/api/categories
  GET http://localhost:8000/api/calculator?o=plus&x=10&y=5
```

### 2. フロントエンドアプリケーション起動

#### 方法A: 簡易HTTPサーバー使用（推奨）
```bash
# プロジェクトディレクトリに移動
cd frontend

# Python 3を使用
python -m http.server 3000

# Node.jsを使用
npx http-server -p 3000
```

その後、ブラウザで `http://localhost:3000` にアクセス

#### 方法B: 直接HTMLファイルを開く
```bash
cd frontend
# HTMLファイルを直接ブラウザで開く
open index.html  # macOS
start index.html # Windows
```

### 3. 動作確認

ブラウザでフロントエンドにアクセス後：

1. **サーバー接続確認**: 画面下部の接続状況が「オンライン ✅」であることを確認
2. **Hello API**: 名前を入力してHello APIをテスト
3. **Categories API**: カテゴリ一覧取得をテスト（カード表示確認）
4. **Calculator API**: 四則演算をテスト（結果が大きく表示されることを確認）

### 4. 直接API確認（オプション）
```bash
# ブラウザまたはcurlでアクセス
curl "http://localhost:8000/api/hello?name=test"
curl "http://localhost:8000/api/categories"
curl "http://localhost:8000/api/calculator?o=plus&x=10&y=5"
```

## 🛠️ 技術仕様

### バックエンド
- **言語**: Go 1.24.4
- **ライブラリ**: 標準ライブラリのみ (`net/http`, `encoding/json`, `strconv`)
- **ポート**: 8000
- **レスポンス形式**: JSON
- **HTTPメソッド**: GET
- **CORS**: 全オリジン許可設定

### フロントエンド
- **言語**: HTML5, CSS3, JavaScript (ES6+)
- **デザイン**: レスポンシブ、グラデーション、カード型レイアウト
- **機能**: リアルタイムAPI通信、エラーハンドリング、接続状況監視
- **ポート**: 3000（推奨）

## ✨ デモアプリケーション機能

### 🎨 **UI/UX機能**
- **モダンデザイン**: グラデーション背景とカード型レイアウト
- **レスポンシブ**: デスクトップ・タブレット・スマートフォン対応
- **リアルタイム表示**: API呼び出し結果の即座な表示
- **視覚的フィードバック**: 成功・エラーの色分け表示

### ⚡ **インタラクティブ機能**
- **Enterキー対応**: 入力フィールドでEnterキーによるAPI呼び出し
- **ローディング表示**: API呼び出し中の視覚的フィードバック
- **エラーハンドリング**: 接続エラー・APIエラーの適切な表示
- **サーバー監視**: リアルタイム接続状況確認

### 🧮 **Calculator API専用機能**
- **ドロップダウン選択**: 演算子の直感的選択UI
- **大型結果表示**: 計算結果の見やすい表示
- **演算式表示**: 実行した計算式の確認

### 📁 **Categories API専用機能**
- **カードグリッド**: カテゴリをカード形式で美しく表示
- **ホバーエフェクト**: カードの上昇アニメーション

## 📚 学習ポイント

この実装を通じて以下の技術を学習できます：

### バックエンド（Go）
1. **Go言語の基本文法**: パッケージ、関数、構造体
2. **net/httpライブラリ**: HTTPサーバーの構築
3. **JSON処理**: `encoding/json`パッケージの使用
4. **エラーハンドリング**: 適切なHTTPステータスコードの返却
5. **クエリパラメータ処理**: URLからのパラメータ取得と検証
6. **CORS対応**: クロスオリジンリクエストの許可設定
7. **コード分割**: 責任ごとのファイル分離

### フロントエンド
1. **Fetch API**: モダンなHTTP通信
2. **ES6+ JavaScript**: async/await、アロー関数
3. **DOM操作**: 動的なHTML要素の操作
4. **CSS3**: グラデーション、アニメーション、レスポンシブデザイン
5. **エラーハンドリング**: try-catch文とユーザーフレンドリーなエラー表示

### フルスタック開発
1. **API設計**: RESTful APIの基本原則
2. **CORS**: クロスオリジン通信の理解
3. **デバッグ**: ブラウザ開発者ツールの活用
4. **ユーザビリティ**: 直感的なUI/UX設計

## 🔍 今後の拡張案

### バックエンド拡張
- [ ] ポート番号の環境変数化
- [ ] ログ機能の追加（リクエスト・レスポンスログ）
- [ ] より複雑な計算機能（三角関数、累乗など）
- [ ] データ永続化（ファイル、データベース）
- [ ] 認証機能の追加（JWT、セッション）
- [ ] APIレート制限機能
- [ ] Docker化

### フロントエンド拡張
- [ ] React/Vue.jsでの再実装
- [ ] TypeScriptによる型安全性向上
- [ ] PWA対応（オフライン機能）
- [ ] チャート表示機能（Chart.js、D3.js）
- [ ] 履歴機能（localStorage活用）
- [ ] テーマ切り替え機能（ダーク/ライトモード）

### インフラ・運用
- [ ] CI/CD パイプライン構築
- [ ] クラウドデプロイ（AWS、GCP、Azure）
- [ ]監視・メトリクス収集
- [ ] セキュリティ強化（HTTPS、入力検証）

## 🐛 トラブルシューティング

### CORS エラーが発生する場合
```bash
# 解決方法1: バックエンドのCORS設定確認
# handlers.go の enableCORS 関数が各ハンドラーで呼ばれているか確認

# 解決方法2: フロントエンドをHTTPサーバー経由で起動
cd frontend && python -m http.server 3000
```

### サーバー接続エラーの場合
```bash
# バックエンドサーバー確認
curl http://localhost:8000/api/hello

# ポート確認
netstat -an | grep 8000
```

### 計算結果がエラーになる場合
```bash
# URL エンコーディング使用
# + を %2B に変更、または plus を使用
```
