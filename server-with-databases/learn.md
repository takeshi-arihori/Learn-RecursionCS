## mysqliクラス

### MySQLのサービス開始・再起動・停止・コマンド

```
sudo service mysql start
sudo service mysql status
sudo service mysql stop
```

## DDL (Data Definition Language) 操作
データ定義言語: テーブルや索引、シーケンスなどのデータベースオブジェクトを定義する言語。

1つのDBが1つのアプリケーションと紐付いている

### エントリーポイントの読み込み
```
spl_autoload_register( function($name) {
  // __DIR__は、現在のファイルの絶対ディレクトリパスを取得します。
  $filepath = __DIR__ . "/" . str_replace('\\', '/', $name) . ".php";
  echo "\nRequiring...." . $name . " once ($filepath).\n";
  // バックスラッシュ(\)をフロントスラッシュ(/)に置き換えます。フロントスラッシュはLinuxのファイルパスで使用されます。
  require_once $filepath;
});
```

## バックエンドを通じてテーブルスキーマを管理する方法
### 1. 単一のファイルに書き込む `cars-setup.sql'
手動のSQLスクリプトを使うアプローチは、シェルを通じて直接実行することができる。
```
mysql -u takeshi -p practice_db < Database/Examples/cars-setup.sql
```

#### 手動スクリプトのメリット
- 作成が簡単で、複数のサーバインスタンス間でテーブルスキーマを簡単に設定できる。