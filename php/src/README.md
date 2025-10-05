# Recursion Curriculum PHP Monorepo

PHP学習・開発環境を統一的に管理するための **Docker + Makefile ベースのモノレポ構成** です。  
`src/` 以下に各レベル（`beginner`, `intermediate`, `advanced`, `oop`, `dynamic-web-server`）のプロジェクトを格納し、  
共通の `vendor/`・テスト・静的解析ツールを共有します。

---

## 🧩 プロジェクト構成

```
.
├── compose.yaml
├── docker/
│   ├── php/
│   ├── nginx/
│   └── mysql/
├── Makefile
├── .env
└── src/
    ├── composer.json
    ├── vendor/
    ├── oop/
    ├── intermediate/
    ├── advanced/
    └── dynamic-web-server/
```

---

## 🐳 **Docker 環境構成**

| サービス | 説明                        | ポート      |
| -------- | --------------------------- | ----------- |
| `app`    | PHP 8.4 + Composer + Xdebug | -           |
| `web`    | Nginx (PHP-FPM接続)         | `8080:80`   |
| `db`     | MySQL 8.0                   | `3306:3306` |

**マウント構成：**
- `./src → /var/www/html`

---

## ⚙️ **初期セットアップ**

### 1️⃣ `.env` の配置
```
MYSQL_ROOT_PASSWORD=password
MYSQL_DATABASE=recursion_curriculum
MYSQL_USER=recursion_user
MYSQL_PASSWORD=password
```

### 2️⃣ コンテナ起動
```
make up
```

### 3️⃣ Composer依存インストール
```
make install
```

### 4️⃣ 開発ツールをインストール
```
make tools-install
```

---

## 🧰 **Makefile コマンド一覧**

```
make              # ヘルプを表示
make up           # コンテナ起動
make down         # コンテナ停止
make rebuild      # appコンテナを再ビルド
make install      # composer install
make update       # composer update
make tools-install# phpunit/pest/phpstan を root でinstall
make test         # 全テスト実行
make test-oop     # oopのみ
make test-intermediate # intermediateのみ
make stan         # PHPStan全体解析
```

---

## 🧪 **テスト実行**

```
make test-oop
make test-intermediate
make test
```

---

## 🔍 **静的解析（PHPStan）**

```
make stan
```

---

## 🧹 **補助コマンド**

```
make doctor         # ツールPATHチェック
make tools-version  # バージョン確認
```

---

## 🧠 **設計方針メモ**

- `src/vendor` を共有
- root 実行で権限エラー防止
- PATH付きリンクで phpunit/pest/phpstan どこでも実行可
- CI/CDでは `make install → make test → make stan`

---

## 🪄 **ワークフロー例**

```
make up
make install
make tools-install
make test-oop
make stan
make down
```

---

## 🧾 **ライセンス**

MIT License © 2025 Takeshi Arihori
