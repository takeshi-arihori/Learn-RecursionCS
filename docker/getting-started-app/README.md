# Getting started

This repository is a sample application for users following the getting started guide at https://docs.docker.com/get-started/.

The application is based on the application from the getting started tutorial at https://github.com/docker/getting-started

## バインドマウントの使用

ボリュームマウントは、アプリケーションデータを永続的に保存するためのものです。これは、コンテナが停止または削除されても同様に保持されます。これは、データベースなどのデータを永続化する必要があります。
一方、バインドマウントは、ホストの特定のディレクトリをコンテナ経由で接続します。これは、開発中のソースコードなどをコンテナにバインドしてマウントすることを意味します。これにより、ファイルを保存するとすぐにコンテナが変更されますが、これに応じて変更することもできます。これは、開発環境でリアルタイムのファイルアクセスとホストとコンテナ間の共有が重要な方法です。
例えば、以下のようにボリュームマウントとバインドマウントを区別します：

```
名前付きボリューム:type=volume,src=my-volume,target=/usr/local/data
バインドマウント:type=bind,src=/path/to/data,target=/usr/local/data
```

-   ubuntu コンテナで bash をバインドマウントで起動

```
docker run -it --mount type=bind,src="$(pwd)",target=/src ubuntu bash
```

開発用のコンテナを使用すると、バインドマウントを使用してローカルの開発環境を設定することが一般的です。その利点は、開発マシンにすべてのビルドツールや環境をインストールする必要がないことです。単一の docker run コマンドで、Docker は依存関係とツールを取得します。

#### nodemon を使用してファイルシステムの監視を行う。

```
docker run -dp 127.0.0.1:3000:3000 \
    -w /app --mount type=bind,src="$(pwd)",target=/app \
    node:18-alpine \
    sh -c "yarn install && yarn run dev"
```

-   `-dp 127.0.0.1:3000:3000` - 以前と同じです。デタッチド（バックグラウンド）モードで実行し、ポートマッピングを作成します。
-   `-w /app` - 「作業ディレクトリ」を設定します。これは、コマンドが実行される現在のディレクトリです。
-   `--mount type=bind,src="$(pwd)",target=/app` - ホストの現在のディレクトリをコンテナ内の `/app` ディレクトリにバインドマウントします。
-   `node:18-alpine` - 使用するイメージです。これは Dockerfile からのアプリケーションのベースイメージです。
-   `sh -c "yarn install && yarn run dev"` - コマンドです。sh を使用してシェルを開始し（alpine には bash がありません）、`yarn install`を実行してパッケージをインストールし、その後 `yarn run dev` を実行して開発サーバーを開始します。`package.json`を確認すると、`dev`スクリプトが nodemon を開始することがわかります。

-   ログの確認

```
docker logs -f <container-id>
```

## Multi container apps

各コンテナは 1 つの役割に特化すべきです。

-   コンテナを分離する理由：

1. API やフロントエンドとデータベースは異なる方法でスケールする必要がある。
2. コンテナを分離することで、バージョン管理や更新がしやすくなる。
3. ローカルではデータベース用のコンテナを使うが、本番環境ではマネージド・サービスを使用するかもしれない。
4. 複数のプロセスを実行するにはプロセス・マネージャーが必要で、コンテナの起動やシャットダウンが複雑になる。

以上の理由から、アプリは複数のコンテナで実行するのがベストです。

1. ネットワークの作成

```
docker network create todo-app
```

2. MySQL コンテナの起動

```
docker run -d \
    --network todo-app --network-alias mysql \
    -v todo-mysql-data:/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=secret \
    -e MYSQL_DATABASE=todos \
    mysql:8.0
```

3. データベースにアクセス

```
docker exec -it <mysql-container-id> mysql -u root -p
```

### MySQL への接続

MySQL が動作していることが確認できたら、次にどうやって使うかを考えます。同じネットワーク上で別のコンテナを実行する場合、そのコンテナをどう見つけるかが問題です。各コンテナには独自の IP アドレスがあるためです。

この問題を解決するために、nicolaka/netshoot コンテナを使用します。これはネットワークのトラブルシューティングやデバッグに役立つツールを多数搭載しています。

次の手順で新しいコンテナを起動し、同じネットワークに接続します：

```
docker run -it --network todo-app nicolaka/netshoot
```

コンテナ内で、dig コマンドを使用してホスト名 mysql の IP アドレスを調べます：

```
dig mysql
```

出力は以下のようになります：

```
; <<>> DiG 9.18.8 <<>> mysql
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 32162
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0

;; QUESTION SECTION:
;mysql. IN A

;; ANSWER SECTION:
mysql. 600 IN A 172.23.0.2

;; Query time: 0 msec
;; SERVER: 127.0.0.11#53(127.0.0.11)
;; WHEN: Tue Oct 01 23:47:24 UTC 2019
;; MSG SIZE rcvd: 44
```

"ANSWER SECTION"には、ホスト名 mysql の A レコードがあり、それが IP アドレス 172.23.0.2 に解決されます（あなたの環境では異なる値になる可能性があります）。通常、mysql は有効なホスト名ではありませんが、Docker はこのネットワークエイリアスを持つコンテナの IP アドレスに解決することができます。

つまり、アプリケーションはホスト名 mysql に接続するだけで、データベースにアクセスできるようになります。

### MySQL でアプリを実行する

Todo アプリは MySQL 接続設定のためのいくつかの環境変数をサポートしています。これらの変数は以下の通りです：

```
MYSQL_HOST - 実行中の MySQL サーバーのホスト名
MYSQL_USER - 接続に使用するユーザー名
MYSQL_PASSWORD - 接続に使用するパスワード
MYSQL_DB - 接続後に使用するデータベース
```

環境変数を使用することは開発では一般的ですが、本番環境では推奨されません。セキュリティのためには、コンテナオーケストレーションフレームワークのシークレット機能を使用する方が安全です。これにより、シークレットは実行中のコンテナ内のファイルとしてマウントされます。

例として、MYSQL_PASSWORD_FILE 変数を設定すると、そのファイルの内容が接続パスワードとして使用されます。

開発用コンテナを起動するには、以下のコマンドを実行します：

```
docker run -dp 127.0.0.1:3000:3000 \
  -w /app -v "$(pwd):/app" \
  --network todo-app \
  -e MYSQL_HOST=mysql \
  -e MYSQL_USER=root \
  -e MYSQL_PASSWORD=secret \
  -e MYSQL_DB=todos \
  node:18-alpine \
  sh -c "yarn install && yarn run dev"
```

コンテナのログを見ると、MySQL データベースに接続されていることを示すメッセージが表示されます：

```
Connected to mysql db at host mysql
Listening on port 3000
```

ブラウザでアプリを開き、Todo リストにアイテムを追加します。MySQL データベースに接続し、アイテムがデータベースに書き込まれていることを確認します：

```
docker exec -it <mysql-container-id> mysql -p todos
```

MySQL シェルで以下のコマンドを実行します：

```
select * from todo_items;
```

テーブルには追加したアイテムが表示されます。
