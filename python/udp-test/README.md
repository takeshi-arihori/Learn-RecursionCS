# 名前付きパイプ（FIFO）通信テスト

Python を使った名前付きパイプ（FIFO: First In First Out）によるプロセス間通信の実装例です。

## 📋 プロジェクト概要

このプロジェクトは、Unix系システムの名前付きパイプを使用してサーバーとクライアント間でリアルタイム通信を行うシンプルな実装です。サーバーが入力したメッセージを、名前付きパイプを通じてクライアントがリアルタイムで受信・表示します。

## 🗂️ ファイル構成

```
udp-test/
├── server.py      # サーバープログラム（データ送信側）
├── client.py      # クライアントプログラム（データ受信側）
├── config.json    # 設定ファイル（パイプファイルのパス）
├── data/
│   └── tmp/       # パイプファイル格納ディレクトリ
└── README.md      # このファイル
```

## ⚙️ 設定ファイル

`config.json` には名前付きパイプのファイルパスが定義されています：

```json
{
    "filepath": "data/tmp/pipe.txt"
}
```

## 🚀 使用方法

### 前提条件
- Python 3.x
- Unix系OS（macOS、Linux）
- 2つのターミナルウィンドウ

### 実行手順

#### 1. プロジェクトディレクトリに移動
```bash
cd python/udp-test
```

#### 2. サーバーを起動（ターミナル1）
```bash
python3 server.py
```

出力例：
```
FIFO named 'data/tmp/pipe.txt' is created successfully.
Type in what you would like to send to clients.
```

#### 3. クライアントを起動（ターミナル2）
```bash
python3 client.py
```

#### 4. メッセージの送信
- **サーバー側**でメッセージを入力してEnterキーを押す
- **クライアント側**でリアルタイムにメッセージが表示される

#### 5. 終了方法
- サーバー側で `exit` と入力すると両プログラムが終了

## 💡 動作例

**ターミナル1（サーバー）:**
```bash
$ python3 server.py
FIFO named 'data/tmp/pipe.txt' is created successfully.
Type in what you would like to send to clients.
Hello World
メッセージテスト
exit
```

**ターミナル2（クライアント）:**
```bash
$ python3 client.py
Data received from pipe: "Hello World"
Data received from pipe: "メッセージテスト"
```

## 🔧 技術仕様

### サーバー（server.py）
- **機能**: 名前付きパイプの作成とメッセージ送信
- **動作**:
  1. 既存のパイプファイルを削除（クリーンアップ）
  2. `os.mkfifo()` で名前付きパイプを作成
  3. ユーザー入力を受け取り、パイプに書き込み
  4. `exit` 入力でパイプファイルを削除して終了

### クライアント（client.py）
- **機能**: 名前付きパイプからのメッセージ受信
- **動作**:
  1. パイプファイルを読み取り専用で開く
  2. ファイルが存在する間、継続的に読み取り
  3. 受信したデータを画面に表示
  4. パイプファイルが削除されると自動終了

### 名前付きパイプの特徴
- **リアルタイム通信**: データの即座な転送
- **一方向通信**: サーバー → クライアントの単方向
- **同期処理**: 書き込みと読み取りが同期
- **一度限りの読み取り**: データは読み取り後に消去

## 🚨 注意事項

1. **実行順序**: 必ずサーバーを先に起動してください
2. **OS制限**: Unix系OSでのみ動作（Windowsでは動作しません）
3. **ディレクトリ**: 必ず `udp-test/` ディレクトリ内で実行してください
4. **パーミッション**: パイプファイルは所有者読み書き権限（0o600）で作成されます

## 🐛 トラブルシューティング

### FileNotFoundError: 'config.json'
```bash
# 解決方法: 正しいディレクトリで実行
cd python/udp-test
python3 client.py
```

### FileNotFoundError: 'data/tmp/pipe.txt'
```bash
# 解決方法: サーバーを先に起動
# ターミナル1
python3 server.py

# ターミナル2
python3 client.py
```

### Permission denied
```bash
# 解決方法: ディレクトリの権限確認
ls -la data/tmp/
chmod 755 data/tmp/
```

## 📚 学習ポイント

このプロジェクトを通じて以下の概念を学習できます：

1. **プロセス間通信（IPC）**: 異なるプロセス間でのデータ交換
2. **名前付きパイプ（FIFO）**: Unix系OSの通信メカニズム
3. **ファイルI/O操作**: Python での低レベルファイル操作
4. **JSON設定管理**: 外部設定ファイルの読み込み
5. **エラーハンドリング**: ファイル存在確認とクリーンアップ

## 🔍 発展課題

- [ ] 双方向通信の実装
- [ ] 複数クライアント対応
- [ ] メッセージのタイムスタンプ追加
- [ ] ログファイル出力機能
- [ ] TCP/UDPソケット通信への拡張