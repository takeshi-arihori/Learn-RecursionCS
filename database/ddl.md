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
