## DDL

- DDL (Data Definition Language): データ定義言語
データベースはエンティティと呼ばれる抽象的な概念ごとにデータを取り扱う。データベースはこのエンティティをテーブルという単位で管理する。
例: 企業の給与管理システムのデータベース: 従業員テーブル、役職テーブル、給与テーブルなどが存在する

### DDLの種類
- CREATE: 新しいテーブルやビューなどのデータベースオブジェクトを作成
- DROP: 既存のデータベースオブジェクトを削除
- ALTER: 既存のテーブルベースオブジェクトを変更
- TRUNCATE: テーブルを再作成(テーブル内のデータを全削除)

## DML
- DML (Data Manipulation Language): データ操作言語

### DMLの種類
- SELECT: テーブルからレコードを抽出する
- INSERT: テーブルにレコードを新規登録する
- UPDATE: テーブルのレコードを更新する
- DELETE: テーブルのレコードを削除する

## 環境セットアップ - Mac
### Homebrewでインストール

1. `brew -v` でバージョン確認(表示されなければinstallする)
2. Homebrewがインストールされていなければ、`/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"` で Homebrew をインストール
3. `brew install mysql` で MySQL をインストール
4. PATH(環境変数)の設定 (Homebrewでインストールした場合は不要)
5. `mysql --version` でインストールが成功したか確認
6. MySQLを起動
   - MySQLの起動
   - MySQLにログイン

- `brew info mysql` : MySQLの内容を確認
- `brew services restart mysql`: MySQLの起動
- `mysql -uroot` `: root userでMySQLにログイン

### `ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/usr/local/var/mysql/mysql.sock' (2)` エラー
MySQL9.0を使用するには、まずMySQL8.4をインストールする必要がある。  

MySQL <8.4からMySQL >9.0にアップグレードするには、まずMySQL 8.4を実行する必要があります：
 - `brew install mysql@8.4`で 8.4をインストール
 - `brew services stop mysql`
 - `brew services start mysql`

- ユーザ一覧の確認: `SELECT user, host FROM mysql.user;`
- ユーザーの作成: `CREATE USER user_name@host_name IDENTIFIED BY 'password';`
- 作成したユーザーでログイン: `mysql -u user_name -p;`

**[rootユーザーに関して](https://dev.mysql.com/doc/refman/8.0/ja/default-privileges.html)**  

SQLは大文字・小文字を区別しないが、SQLステートメントは大文字で記述するのが一般的。

- ユーザーパスワード変更: `SET PASSWORD FOR user_name@host_name = 'new_password';`
- ユーザー名、ホスト名変更: `RENAME USER 'user_name'@'host_name' TO 'new_user_name'@'new_host_name';`

- ホスト名を指定するオプション: `mysql -u user_name -h 127.0.0.1 -p`
ホスト名が`localhost`の場合は、ログイン時にホスト名を省略することができる。

- ユーザーの削除: `DROP USER user_name@host_name; `

## データベースの作成

- データベースの作成: `CREATE DATABASE db_name;`
- データベースの削除" `DROP DATABASE db_name;`

## テーブルの作成

### データ型と内容
テーブルにはカラムと呼ばれる「テーブルが持つ項目」がある。以下のようなデータ型からカラムのデータ型を設定する必要がある。  

| データ型      | 内容                                               |
|---------------|----------------------------------------------------|
| INT           | 4 バイトの数値                                      |
| BIGINT        | 8 バイトの数値                                      |
| FLOAT         | 浮動小数点ありの数値                                |
| DATE          | 日付                                                |
| DATETIME      | 日時                                                |
| CHAR(n)       | 固定長文字列（足りない分は空白で埋められる）        |
| VARCHAR(n)    | 変長文字列                                          |
| TEXT          | 変長文字列  (ポインタのみが格納されデータは別領域)   |

- 使用するデータベースの選択: `USE DATABASE名`
- テーブルの作成: `CREATE TABLE db_name.table_name (column_name data_type, column_name data_type, ...);` (USEで使用するデータベースを選択している場合は`db_name`は不要)

### VARCHARが255文字の宣言をする理由
「CHAR とは対照的に、VARCHAR 値は、1 バイトまたは 2 バイト長のプリフィクスの付いたデータとして格納されます。  
長さプリフィクスは、値に含まれるバイト数を示します。255 バイト以下の値を格納するカラムでは 1 バイト長のプリフィクスを使用し、255 バイトよりも大きい値を格納するカラムでは 2 バイト長のプリフィクスを使用します」  
つまり、256 文字以上を格納できるようにすると、より多くのデータ容量を消費するということです。   
従って、先ほど作成した departments テーブルのnameカラムでは、1 バイト長のプリフィックスで収まる中では最大の文字数である 255 文字に設定しています。  

### スキーマ
データベース設計では、スキーマと呼ばれるデータベースのデータ構造やデータの持ち方が大事になってくる
- 外部スキーマ: データベースのビューや、アプリケーションのユーザーインターフェースなど
- 概念スキーマ: 開発者から見たデータベースで、データ構造や関係について
- 内部スキーマ: DBMSから見たデータベースで、データを格納しているファイルなど具体的な格納方法など

- 作成したテーブルのスキーマを表示: `SHOW CREATE TABLE table_name;`

## インデックスと制約
テーブルに設定できる項目: カラム、インデックス、制約
### カラム
テーブルが持つ項目(id, name, start_dateなど)  

### インデックス
特定の絡む地のある行を素早く見つけるために使用される。インデックスがないと、MySQLは該当する行を見つけるために、先頭の行から始めてテーブル全体を走査する必要がある。(テーブルが大きいほど、このコストが大きくなる。)  

内部的にBツリーと呼ばれる、データ走査に強い木構造を用いることで、データの特定を素早く実行している。特定のカラムに対してインデックスを設定すると、そのカラムでレコードを特定する場合のコストを非常に小さくできる。  

- インデックスの設定: `ALTER TABLE table_name ADD INDEX index_name (column_name);` or `CREATE INDEX index_name ON table_name(column_name);`
**確認**: `SHOW INDEX FROM table_name;`


### 制約
- 主キー(PRIMARY KEY)制約
  - 一意を保証
  - NULLを禁止
  - 1つのテーブルにおいて1つのカラムにだけ主キー制約を設定できる
  - 主キー制約を設定するカラムにはインデックスが必要。(自動で設定される)
```
mysql> CREATE TABLE members (id INT PRIMARY KEY);
Query OK, 0 rows affected (0.00 sec)

mysql> SHOW COLUMNS FROM members;
+-------+------+------+-----+---------+-------+
| Field | Type | Null | Key | Default | Extra |
+-------+------+------+-----+---------+-------+
| id    | int  | NO   | PRI | NULL    |       |
+-------+------+------+-----+---------+-------+
1 row in set (0.00 sec)

mysql>
```
- 外部キー(FOREIGN KEY)制約
  - 他のテーブルの主キーを参照する
  - この制約を設定したカラム(外部キー)の値は、必ず主キーに設定したカラムに存在する値でなければいけない
  - この制約を設定したカラムの値を先に削除しなければ、参照先の主キーのデータを削除することはできない
  - 外部キー制約を設定するカラム、参照先の主キーカラムにはインデックスが必要。(自動で設定される)
- NOT NULL制約
- 一意(UNIQUENESS)制約
- CHECK制約

それぞれの制約はテーブルの特定のカラムに対して設定することができる。  

## テーブルの更新

`ALTER TABLE table_name RENAME [TO|AS] new_table_name;`








