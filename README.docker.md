## Docker 環境構築

### 開発環境

```
Web サーバ： Nginx 1.25.0
データベース： MySQL 8.0
言語： PHP 8.1
```

## 参考

-   [Docker で PHP + PHP-FPM × Nginx × MySQL の開発環境を構築](https://qiita.com/shikuno_dev/items/f236c8280bb745dd6fb4)
-   [実践編ー Docker を使って nginx でリバースプロキシを立ててみる](https://qiita.com/zawawahoge/items/d58ab6b746625e8d4457)

## Docker 内で DB 操作

### MySQL コンテナに入る

```bash
docker-compose exec mysql /bin/bash
```

### MySQL にログイン

```
mysql -u root -p
```

-   サーバ: mysql
-   ユーザ名: root
-   パスワード: password（.env ファイルで設定したもの）
