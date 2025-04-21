# RecursionCS Curriculum

## プロジェクトのはじめ方
```zsh
# Laravelプロジェクトを docker-laravel/src へクローンする
make init

docker compose build
docker compose up -d
docker compose exec app composer install
docker compose exec app cp .env.example .env
docker compose exec app php artisan key:generate
docker compose exec app php artisan storage:link
docker compose exec app chmod -R 777 storage bootstrap/cache
docker compose exec app php artisan migrate:fresh
```

### 基本操作
#### コンテナを作成する
`docker compose up -d`

#### コンテナを破棄する
`docker compose down`

#### コンテナ、イメージ、ボリュームを破棄する
`docker compose down --rmi all --volumes`

#### コンテナ、ボリュームを破棄する
`docker compose down --volumes`

### appコンテナに入る
`docker compose exec app bash`
### webコンテナに入る
`docker compose exec app bash`
### dbコンテナに入る
`docker compose exec db bash`
### dbコンテナのMySQLに接続する
`docker compose exec db bash -c 'mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE'`

### Laravelのマイグレーションを実行する
#### migrate
`docker compose exec app php artisan migrate`

#### all drop table & migrate & seeding
`docker compose exec app php artisan migrate:fresh --seed`

#### seeding
`docker compose exec app php artisan db:seed`

### テストの実行
`docker compose exec app php artisan test`

### Laravelのキャッシュをクリア
```zsh
docker compose exec app php artisan config:clear
docker compose exec app php artisan config:cache
```

## 参考サイト
**Docker環境構築参照**  
[最強のLaravel開発環境をDockerを使って構築する](https://qiita.com/ucan-lab/items/5fc1281cd8076c8ac9f4)  

[Git、GitHub、GitHub Actionsシリーズ記事のまとめ](https://qiita.com/ucan-lab/items/33c63a402f533aa92f3e)  

