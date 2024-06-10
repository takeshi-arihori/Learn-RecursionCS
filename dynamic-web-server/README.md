# Backend Project4: Dynamic Web Server

## 学習内容

動的コンテンツを生成し提供するウェブサーバの概念と技術の学習。
コースを通して、PHP を用いて自身の動的ウェブサーバを作成しデプロイし、リアルタイムでカスタマイズされたコンテンツを生成する方法を理解します。
OOP（オブジェクト指向プログラミング）の知識をフル活用して、ランダムユーザー生成の模倣アプリ、markdown から HTML への変換、テキストから UML 画像を生成するアプリを作成。

- 使用言語: PHP 8.2

## 開発環境

- **Web サーバ**: Nginx 1.25.0
- **データベース**: MySQL 8.0
- **言語**: PHP 8.1

## 参考

- [参考記事](https://qiita.com/shikuno_dev/items/f236c8280bb745dd6fb4)

## プロジェクト構成

```
.
├── docker/
│ ├── mysql/
│ │ └── my.cnf
│ ├── nginx/
│ │ └── default.conf
│ └── php/
│ ├── Dockerfile
│ └── php.ini
├── src/
│    ├── Helpers
│    │      └── RandomGenerator.php
│    ├── Models
│    │      └── User.php
│    ├── vendor/
│    ├── composer.json
│    ├── composer.lock
│    ├── index.php
│    ├── generate.php
│    └── download.php
├── compose.yml
└── .env
```

## セットアップ手順

### 1. リポジトリをクローン

```bash
git clone https://github.com/yourusername/yourrepository.git
cd yourrepository
```

### 2. 環境変数を設定

.env ファイルを作成し、以下の内容を追加します。

```
MYSQL_ROOT_PASSWORD=password
MYSQL_DATABASE=php-docker-db
MYSQL_USER=user
MYSQL_PASSWORD=password
PROJECT_NAME=my_project

```

### 3. Docker コンテナをビルドして起動

```
docker-compose up --build
```

### 4. phpMyAdmin にアクセス

ブラウザで http://localhost:8080 にアクセスし、以下の情報でログインします。

```
サーバ: mysql
ユーザ名: root
パスワード: .envファイルで設定したMYSQL_ROOT_PASSWORDの値（例: password）
```

## Docker 内での DB 操作

### MySQL コンテナに入る

```
docker-compose exec mysql /bin/bash
```

### MySQL にログイン

```
mysql -u root -p
```

### 注意事項

- 各プロジェクトで使用する際は、.env ファイルの内容をプロジェクトに合わせて変更してください。
- Docker Compose ファイルで定義されたボリューム名やネットワーク名もプロジェクトごとにユニークにしてください。
