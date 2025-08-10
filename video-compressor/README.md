# Video-compressor - ネットワークプログラミングと動画処理

## 概要
Pythonを使用してネットワークプログラミングとリアルタイム通信の基礎を学習します。UDP通信、Named Pipe（FIFO）、クライアント・サーバーアーキテクチャを通じて、分散システムの基本概念を理解します。

## 構成

### 📁 python/

#### 🌐 local-chatmessenger/
ローカルチャットメッセンジャー実装

**ファイル構成:**
- **server.py**: チャットサーバー実装
- **client.py**: チャットクライアント実装
- **udp-server.py**: UDP通信サーバー
- **udp-client.py**: UDP通信クライアント
- **tmp/**: 一時ファイル格納

#### 🔧 udp-test/
UDP通信とNamed Pipe実装

**ファイル構成:**
- **server.py**: Named Pipe サーバー
- **client.py**: Named Pipe クライアント
- **config.json**: 設定ファイル
- **README.md**: プロジェクト固有の説明
- **data/tmp/**: データ一時保存
  - **pipe.txt**: パイプファイル

## 学習内容

### 🌐 ネットワークプログラミング
- UDP（User Datagram Protocol）通信
- クライアント・サーバーモデル
- ソケットプログラミング
- パケット送受信とエラーハンドリング

### 📡 プロセス間通信（IPC）
- Named Pipe（FIFO）の実装
- プロセス間でのデータ共有
- 同期・非同期通信
- リアルタイム通信の実現

### 🔄 並行プログラミング
- マルチクライアント対応
- 非ブロッキングI/O
- 並行処理とスレッド管理
- リソース競合の回避

## 実行方法

### Named Pipe サーバー・クライアント
```bash
cd video-compressor/python/udp-test

# ターミナル1: サーバー起動
python3 server.py
# サーバーが Named Pipe を作成し、入力を待機
# メッセージを入力してクライアントに送信
# 'exit' で終了

# ターミナル2: クライアント起動（別ターミナルで）
python3 client.py
# Named Pipe からデータを読み取って表示
```

### UDP通信テスト
```bash
cd video-compressor/python/local-chatmessenger

# UDP サーバー
python3 udp-server.py

# UDP クライアント
python3 udp-client.py
```

### チャットメッセンジャー
```bash
cd video-compressor/python/local-chatmessenger

# チャットサーバー
python3 server.py

# チャットクライアント
python3 client.py
```

## 学習目標

### 🎯 ネットワーク基礎理解
- OSI参照モデルとTCP/IP
- UDP vs TCP の違いと使い分け
- ポート番号とプロトコル選択

### 🎯 システムプログラミング
- ファイルディスクリプタとI/O多重化
- プロセス・スレッドの管理
- システムコールの活用

### 🎯 分散システム設計
- 可用性と信頼性の考慮
- エラー処理とリトライ機構
- スケーラビリティの確保

### 🎯 Pythonネットワークライブラリ
- socket モジュールの活用
- 非同期プログラミング（asyncio）
- JSON データのシリアライゼーション

## 推奨学習順序

1. **udp-test/server.py & client.py** - Named Pipe の基本実装
2. **local-chatmessenger/udp-server.py & udp-client.py** - UDP通信の理解
3. **local-chatmessenger/server.py & client.py** - 完全なチャットシステム
4. **設定ファイル活用** - config.json を使った柔軟な設定
5. **エラーハンドリング強化** - 通信エラーの対処

## 技術スタック

### Python標準ライブラリ
- **socket**: ネットワーク通信
- **threading**: マルチスレッド処理
- **json**: データ形式
- **os**: システム操作

### システム概念
- **Named Pipe (FIFO)**: プロセス間通信
- **UDP Socket**: コネクションレス通信
- **File I/O**: ファイルシステム操作

## 前提知識
- Python基本文法
- ファイル操作の基礎
- プロセスとスレッドの概念
- ネットワークの基礎知識

## 応用課題
- 暗号化通信の実装
- ファイル転送機能の追加
- Web Socket を使ったブラウザ連携
- Docker を使った分散デプロイ
- 負荷分散とスケーリング
- 動画ストリーミング機能の実装