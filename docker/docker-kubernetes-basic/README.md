## コンテナの作成・削除と起動・停止

- `docker run` は `docker create`,`docker start`,`docker pull` を組み合わせたものです。

- `docker ps`の結果:

| 項目         | 内容                                                                                                                                          |
| ------------ | --------------------------------------------------------------------------------------------------------------------------------------------- |
| CONTAINER ID | コンテナ ID。ランダムな数字が振られる。本来の ID は 64 文字だが、先頭 12 文字のみの表記。12 文字のみでも、ID として使用できる。               |
| IMAGE        | 元となったイメージ。                                                                                                                          |
| COMMAND      | コンテナがデフォルトで起動するように構成されているプログラム名。あまり意識することはない。                                                    |
| CREATED      | 作られてから経過した時間。                                                                                                                    |
| STATUS       | 現在のステータス。動いている場合は「Up」、動いていない場合は「Exited」と表示される。                                                          |
| PORTS        | 割り当てらているポート番号が、「ホストのポート番号 -> コンテナのポート番号」の形式で表示される(ポート番号が同じ時は、-> 以降は表示されない。) |
| NAMES        | コンテナ名。                                                                                                                                  |

## コンテナのサイクル(起動・確認・停止・削除)

1. Apache のイメージ(httpd)から「apa000ex1」という名前のコンテナを作成・起動。
   `docker run --name apa000ex1 -d httpd` でコンテナを作成します。

2. 「ps」コマンドでコンテナの稼働を確認
   `docker ps`
3. コンテナの停止
   `docker stop apa000ex1`
4. コンテナの削除
   `docker rm apa000ex1`

## WordPress の構築と導入の流れ

1.  「network create」コマンドでネットワークを作成

    ```
    docker network create wordpress000net1
    ```

2.  「run」コマンドを実行して MySQL コンテナを作成・起動す

    ```
    docker run --name mysql000ex11 -dit --net=wordpress000net1 -e MYSQL_ROOT_PASSWORD=myrootpass -e MYSQL_DATABASE=wordpress000db -e MYSQL_USER=wordpress000kun -e MYSQL_PASSWORD=wkunpass mysql --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci
    ```

3.  「run」コマンドを実行して WordPress コンテナを作成・起動する

    ```
    docker run --name wordpress000ex12 -dit --net=wordpress000net1 -p 8085:80 -e WORDPRESS_DB_HOST=mysql000ex11 -e WORDPRESS_DB_USER=wordpress000kun -e WORDPRESS_DB_PASSWORD=wkunpass -e WORDPRESS_DB_NAME=wordpress000db wordpress
    ```

4.  「ps」コマンドでコンテナの稼働を確認
    ```
    docker ps
    ```
5.  コンテナの停止

    ````
    	docker stop mysql000ex11
    	docker stop wordpress000ex12
    	```

    ````

6.  コンテナの削除
    `docker rm mysql000ex11
docker rm wordpress000ex12`

7.  イメージの削除

    ```
    docker rmi mysql
    docker rmi wordpress
    ```

8.  ネットワークの削除
    ```
    docker network rm wordpress000net1
    ```
