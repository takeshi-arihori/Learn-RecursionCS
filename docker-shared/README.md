# 🗄️ RecursionCurriculum 共通インフラストラクチャ

## 概要

`docker-shared/`は、RecursionCurriculumの全言語環境（PHP, Java, Go, TypeScript, Python, C++）から共通で使用するデータベース・キャッシュインフラを提供します。

### 提供するサービス

| サービス | 説明 | ポート | 主な使用言語 |
|---------|------|--------|-------------|
| **MySQL 8.0** | リレーショナルデータベース | 3306 | PHP, Java, Go, Python, TypeScript |
| **PostgreSQL 16** | 高機能リレーショナルDB | 5432 | Java/Spring Boot, Python, TypeScript |
| **phpMyAdmin** | MySQL管理画面 | 8090 | 全言語 |
| **pgAdmin** | PostgreSQL管理画面 | 8091 | 全言語 |
| **Redis 7** | キャッシュ・セッション管理 | 6379 | 全言語（オプション） |

---

## 🚀 クイックスタート

### 1. 共通インフラ起動

```bash
# docker-shared/ディレクトリで実行
cd docker-shared
docker-compose up -d

# または、ルートディレクトリから
make up-db
```

### 2. 起動確認

```bash
# コンテナ状態確認
docker-compose ps

# ログ確認
docker-compose logs -f

# ヘルスチェック
docker-compose ps | grep "healthy"
```

### 3. 管理画面へのアクセス

#### phpMyAdmin（MySQL管理）
```
URL: http://localhost:8090
ユーザー名: recursion_user
パスワード: recursion_pass
```

#### pgAdmin（PostgreSQL管理）
```
URL: http://localhost:8091
Email: admin@recursion.local
パスワード: admin

# PostgreSQL接続設定
Host: postgres（またはrecursion-shared-postgres）
Port: 5432
Database: recursion_db
Username: recursion_user
Password: recursion_pass
```

---

## 📊 データベース接続情報

### MySQL接続情報

| 項目 | 値 |
|-----|-----|
| **Host** | `recursion-shared-mysql`（Docker内）<br>`localhost`（ホスト） |
| **Port** | 3306 |
| **Database** | recursion_db |
| **Username** | recursion_user |
| **Password** | recursion_pass |
| **Root Password** | root_password |
| **Test Database** | recursion_db_test |

#### MySQL接続例

**PHP:**
```php
$pdo = new PDO(
    'mysql:host=recursion-shared-mysql;port=3306;dbname=recursion_db;charset=utf8mb4',
    'recursion_user',
    'recursion_pass'
);
```

**Java/Spring Boot (application.properties):**
```properties
spring.datasource.url=jdbc:mysql://recursion-shared-mysql:3306/recursion_db
spring.datasource.username=recursion_user
spring.datasource.password=recursion_pass
spring.datasource.driver-class-name=com.mysql.cj.jdbc.Driver
```

**Go:**
```go
import "github.com/go-sql-driver/mysql"

dsn := "recursion_user:recursion_pass@tcp(recursion-shared-mysql:3306)/recursion_db?parseTime=true"
db, err := sql.Open("mysql", dsn)
```

**TypeScript/Node.js:**
```typescript
import mysql from 'mysql2/promise';

const pool = mysql.createPool({
  host: 'recursion-shared-mysql',
  port: 3306,
  database: 'recursion_db',
  user: 'recursion_user',
  password: 'recursion_pass',
});
```

**Python:**
```python
import mysql.connector

conn = mysql.connector.connect(
    host='recursion-shared-mysql',
    port=3306,
    database='recursion_db',
    user='recursion_user',
    password='recursion_pass'
)
```

---

### PostgreSQL接続情報

| 項目 | 値 |
|-----|-----|
| **Host** | `recursion-shared-postgres`（Docker内）<br>`localhost`（ホスト） |
| **Port** | 5432 |
| **Database** | recursion_db |
| **Username** | recursion_user |
| **Password** | recursion_pass |
| **Test Database** | recursion_db_test |

#### PostgreSQL接続例

**Java/Spring Boot (application.properties):**
```properties
spring.datasource.url=jdbc:postgresql://recursion-shared-postgres:5432/recursion_db
spring.datasource.username=recursion_user
spring.datasource.password=recursion_pass
spring.jpa.database-platform=org.hibernate.dialect.PostgreSQLDialect
```

**TypeScript/Node.js:**
```typescript
import { Pool } from 'pg';

const pool = new Pool({
  host: 'recursion-shared-postgres',
  port: 5432,
  database: 'recursion_db',
  user: 'recursion_user',
  password: 'recursion_pass',
});
```

**Python:**
```python
import psycopg2

conn = psycopg2.connect(
    host='recursion-shared-postgres',
    port=5432,
    dbname='recursion_db',
    user='recursion_user',
    password='recursion_pass'
)
```

---

## 🗃️ データベーススキーマ

### 共通テーブル

#### 1. users（ユーザー情報）
```sql
-- MySQL / PostgreSQL両対応
- id: PRIMARY KEY
- uuid: UUID（PostgreSQLのみ）
- name: ユーザー名
- email: メールアドレス（UNIQUE）
- password: パスワードハッシュ
- is_active: アクティブフラグ
- created_at: 作成日時
- updated_at: 更新日時
```

#### 2. products（商品情報）
```sql
- id: PRIMARY KEY
- name: 商品名
- description: 説明
- price: 価格（DECIMAL）
- stock_quantity: 在庫数
- category_id: カテゴリID（FK）
- is_active: 販売中フラグ
- metadata: JSON/JSONB（PostgreSQLで拡張）
- created_at: 作成日時
- updated_at: 更新日時
```

#### 3. categories（カテゴリ）
```sql
- id: PRIMARY KEY
- name: カテゴリ名
- slug: URLスラッグ（UNIQUE）
- parent_id: 親カテゴリID（自己参照FK）
- display_order: 表示順
- created_at: 作成日時
```

#### 4. orders（注文）
```sql
- id: PRIMARY KEY
- uuid: UUID（PostgreSQLのみ）
- user_id: ユーザーID（FK）
- total_amount: 合計金額
- status: 注文ステータス
- shipping_address: 配送先住所
- notes: 備考
- created_at: 作成日時
- updated_at: 更新日時
```

#### 5. order_items（注文詳細）
```sql
- id: PRIMARY KEY
- order_id: 注文ID（FK）
- product_id: 商品ID（FK）
- quantity: 数量
- price: 単価
- subtotal: 小計（計算カラム）
```

#### 6. application_logs（アプリケーションログ）
```sql
- id: PRIMARY KEY
- level: ログレベル（debug/info/warning/error/critical）
- message: メッセージ
- context: コンテキスト（JSON/JSONB）
- user_id: ユーザーID（NULL可）
- ip_address: IPアドレス
- user_agent: ユーザーエージェント
- created_at: 作成日時
```

#### 7. sessions（セッション管理）
```sql
- id: セッションID（PRIMARY KEY）
- user_id: ユーザーID（FK）
- ip_address: IPアドレス
- user_agent: ユーザーエージェント
- payload: セッションデータ
- last_activity: 最終アクティビティ
```

#### 8. cache（キャッシュ）
```sql
- cache_key: キャッシュキー（PRIMARY KEY）
- value: キャッシュ値
- expiration: 有効期限
```

### サンプルデータ

初期化時に以下のサンプルデータが投入されます：

- **ユーザー**: 5名
- **カテゴリ**: 8カテゴリ（プログラミング、Web開発、データベース等）
- **商品**: 12商品（技術書、電子機器等）
- **注文**: 3-4件
- **ログ**: 5-6件

---

## 🔧 管理コマンド

### 基本操作

```bash
# 起動
docker-compose up -d

# 停止
docker-compose down

# 再起動
docker-compose restart

# ログ確認
docker-compose logs -f

# 特定サービスのログ
docker-compose logs -f mysql
docker-compose logs -f postgres
```

### データベース接続（CLI）

```bash
# MySQL接続
docker exec -it recursion-shared-mysql mysql -u recursion_user -precursion_pass recursion_db

# PostgreSQL接続
docker exec -it recursion-shared-postgres psql -U recursion_user -d recursion_db

# Rootユーザーで接続（MySQL）
docker exec -it recursion-shared-mysql mysql -u root -proot_password
```

### データベースバックアップ

```bash
# MySQLバックアップ
docker exec recursion-shared-mysql mysqldump -u root -proot_password recursion_db > backup_mysql.sql

# PostgreSQLバックアップ
docker exec recursion-shared-postgres pg_dump -U recursion_user recursion_db > backup_postgres.sql
```

### データベースリストア

```bash
# MySQLリストア
docker exec -i recursion-shared-mysql mysql -u root -proot_password recursion_db < backup_mysql.sql

# PostgreSQLリストア
docker exec -i recursion-shared-postgres psql -U recursion_user recursion_db < backup_postgres.sql
```

---

## 🚀 Redisキャッシュ（オプション）

Redisは`cache`プロファイルで有効化できます。

### Redis起動

```bash
# Redisを含めて起動
docker-compose --profile cache up -d

# または
make up-redis
```

### Redis接続情報

| 項目 | 値 |
|-----|-----|
| **Host** | `recursion-shared-redis`（Docker内）<br>`localhost`（ホスト） |
| **Port** | 6379 |
| **Password** | なし |

### Redis接続例

**PHP:**
```php
$redis = new Redis();
$redis->connect('recursion-shared-redis', 6379);
```

**Java/Spring Boot:**
```properties
spring.redis.host=recursion-shared-redis
spring.redis.port=6379
```

**Python:**
```python
import redis
r = redis.Redis(host='recursion-shared-redis', port=6379, decode_responses=True)
```

---

## 📦 ボリューム管理

### 永続化ボリューム

| ボリューム名 | 説明 |
|-------------|------|
| `recursion-shared-mysql-data` | MySQLデータ |
| `recursion-shared-postgres-data` | PostgreSQLデータ |
| `recursion-shared-pgadmin-data` | pgAdmin設定 |
| `recursion-shared-redis-data` | Redisデータ |

### ボリューム操作

```bash
# ボリューム一覧
docker volume ls | grep recursion-shared

# ボリューム削除（注意：データが完全削除されます）
docker-compose down -v

# 特定ボリューム削除
docker volume rm recursion-shared-mysql-data
```

---

## 🌐 ネットワーク構成

### 共通ネットワーク

- **ネットワーク名**: `recursion-shared-network`
- **サブネット**: 172.30.0.0/16
- **ゲートウェイ**: 172.30.0.1

各言語環境（docker-php, docker-java等）がこのネットワークに参加することで、共通DBにアクセスできます。

---

## ⚙️ パフォーマンスチューニング

### MySQL設定

```ini
max_connections=200
innodb_buffer_pool_size=256M
character-set-server=utf8mb4
collation-server=utf8mb4_unicode_ci
```

### PostgreSQL設定

```ini
max_connections=200
shared_buffers=256MB
effective_cache_size=1GB
maintenance_work_mem=64MB
```

### Redis設定

```ini
maxmemory=256mb
maxmemory-policy=allkeys-lru
appendonly=yes
```

---

## 🔐 セキュリティ

### 本番環境への移行時の注意

開発環境のデフォルト認証情報を使用しています：

```yaml
MySQL Root: root_password
DB User: recursion_user
DB Password: recursion_pass
pgAdmin: admin@recursion.local / admin
```

**本番環境では必ず変更してください！**

### 推奨設定

1. 環境変数ファイル（`.env`）の使用
2. 強力なパスワード設定
3. 外部公開ポートの制限
4. SSL/TLS接続の有効化

---

## 🐛 トラブルシューティング

### ポート競合エラー

```bash
# 使用中のポートを確認
lsof -i :3306
lsof -i :5432
lsof -i :8090

# 既存のコンテナを停止
docker stop <container_id>
```

### データベース接続エラー

```bash
# ヘルスチェック状態確認
docker-compose ps

# コンテナログ確認
docker-compose logs mysql
docker-compose logs postgres

# コンテナ再起動
docker-compose restart mysql
```

### 初期化スクリプトが実行されない

初期化スクリプトは**初回起動時のみ**実行されます。再実行するには：

```bash
# ボリューム削除して再起動（データが消えます！）
docker-compose down -v
docker-compose up -d
```

---

## 📚 関連ドキュメント

- [MySQL公式ドキュメント](https://dev.mysql.com/doc/)
- [PostgreSQL公式ドキュメント](https://www.postgresql.org/docs/)
- [Redis公式ドキュメント](https://redis.io/documentation)
- [phpMyAdmin公式ドキュメント](https://www.phpmyadmin.net/docs/)
- [pgAdmin公式ドキュメント](https://www.pgadmin.org/docs/)

---

## 🎯 次のステップ

共通インフラが起動したら、各言語環境を起動できます：

```bash
# PHP環境起動（自動でDB接続）
make up-php

# Java/Spring Boot環境起動
make up-java

# 全環境一括起動
make up-all
```

各言語環境のREADMEも参照してください：
- [docker-php/README.md](../docker-php/README.md)
- [docker-java/README.md](../docker-java/README.md)
- [docker-go/README.md](../docker-go/README.md)
- [docker-typescript/README.md](../docker-typescript/README.md)
- [docker-python/README.md](../docker-python/README.md)
- [docker-cpp/README.md](../docker-cpp/README.md)