# MySQL8.0 Docker Image

-   [参考サイト](https://zenn.dev/re24_1986/articles/153cdc5db96dc0)
-   [参考サイト(スクリプト)](https://zenn.dev/re24_1986/articles/978801ae092498)

## docker-compose 詳細

db-store という名前の volume 作成
/var/lib/mysql を volume へマウントして永続化
db 設定ファイルの/etc/mysql/conf.d/my.cnf をローカルの./conf/my.cnf へマウント
構築時の変数を.env ファイルから読み込む

## MySQL Login

```
mysql -u user -ppassword
```
