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

## Redmine・MySQL のコンテナ作成

Redmine・MySQL

1.  「network create」コマンドでネットワークを作成

```
docker network create redmine000net2
```

2.  「run」コマンドを実行して MySQL コンテナを作成・起動する

```
  docker run --name mysql000ex13 -dit --net=redmine000net2 -e MYSQL_ROOT_PASSWORD=myrootpass -e MYSQL_DATABASE=redmine000db -e MYSQL_USER=redmine000kun -e MYSQL_PASSWORD=rkunpass mysql --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci
```

3. 「run」コマンドを実行して Redmine コンテナを作成・起動する

```
docker run -dit --name redmine000ex14 --network redmine000net2 -p 8086:3000 -e REDMINE_DB_MYSQL=mysql000ex13 -e REDMINE_DB_DATABASE=redmine000db -e REDMINE_DB_USERNAME=redmine000kun -e REDMINE_DB_PASSWORD=rkunpass redmine
```

## Redmine・MariaDB のコンテナ作成

1. 「network create」コマンドでネットワークを作成

```
docker network create redmine000net3
```

2. 「run」コマンドを実行して MariaDB コンテナを作成・起動する

```
docker run --name mariadb000ex15 --network redmine000net3 -dit -e MARIADB_USER=redmine000kun -e MARIADB_PASSWORD=rkunpass -e MARIADB_DATABASE=redmine000db -e MARIADB_ROOT_PASSWORD=mariarootpass mariadb:latest --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci

```

3. 「run」コマンドを実行して Redmine コンテナを作成・起動する

```
docker run -dit --name redmine000ex16 --network redmine000net3 -p 8087:3000 -e REDMINE_DB_MYSQL=mariadb000ex15 -e REDMINE_DB_DATABASE=redmine000db -e REDMINE_DB_USERNAME=redmine000kun -e REDMINE_DB_PASSWORD=rkunpass redmine:latest
```

### ホストからコンテナにファイルをコピーする

1. Apache のイメージ(httpd)から「apa000ex1」という名前のコンテナを作成・起動。
   `docker run --name apa000ex1 -d httpd` でコンテナを作成。

2. ホストからコンテナに「index.html」のファイルをコピーする
   `docker cp docker/docker-kubernetes-basic/index.html apa000ex19:/usr/local/apache2/htdocs`

3. コンテナからホストに「index.html」のファイルをコピーする(元の index.html を削除してからテスト)
   `docker cp apa000ex19:/usr/local/apache2/htdocs/index.html docker/docker-kubernetes-basic/index.html`

### ボリュームとマウント

ボリュームとは、ストレージの 1 領域を区切ったもの。
マウントとは、「取り付ける」の意味どおり、対象を接続して、OS やソフトウェアの支配下に置くこと。
コンテナは頻繁に作っては壊すので外部にデータを逃す。いちいち移し替えるのではなく最初から外に保存してそのままアクセスして使う -> データの永続化 (データを置く場所が、マウントした記憶領域になる。)
「記憶領域のマウント」 -> エンジニアは慣習的に「ボリュームのマウント」という(マウントする領域はボリュームだけではなく、ディレクトリやファイル、メモリの場合もある。)

### 記憶領域のマウントの種類

2 つのマウント方法の違い ->「簡単かどうか」、「親となるパソコンから操作したいかどうか」、「環境依存を排除したいか」の 3 点がポイント。

1. ボリュームマウント(Docker 社推奨)
   Docker Engine が管理している領域内にボリュームを作成し、ディスクとしてコンテナにマウントする。

2. バインドマウント
   Docker をインストールしたパソコンのドキュメントやデスクトップなど、Docker Engine の管理していない場所の既に存在するディレクトリをコンテナにマウントする。(ファイル単位でマウントも可)
   直接ファイルを開いたりできるので、頻繁に触りたいファイルはここに置く。

### 記憶領域のマウント

1. マウントするディレクトリを作成後、「run」コマンドで Apache コンテナを作成・起動する(「v」オプションで記憶領域パスを指定)

```
docker run --name apa000ex20 -d -p 8090:80 -v /Users/takeshi-arihori/Documents/learning/learn-recursionCS/docker/docker-kubernetes-basic/apa_folder/:/usr/local/apache2/htdocs httpd
```

2. ホスト側で作成したディレクトリに「index.html」を作成する

### ボリュームマウント

```
マウント先のコンテナ: /urs/local/apache2/htdocs
マウント元のボリューム: apa000vol1
```

1. マウントするボリュームを作成

```
docker volume create apa000vol1
```

2. 「run」コマンドで Apache コンテナを作成・起動する(「v」オプションでボリューム名を指定)

```
docker run --name apa000ex21 -d -p 8091:80 -v apa000vol1:/usr/local/apache2/htdocs httpd
```

3. 「volume inspect」コマンドでボリュームの詳細情報を表示

- volume

```
docker volume inspect apa000vol1
```

- 結果

```
[
	{
		"CreatedAt": "2024-05-17T15:17:55Z",
		"Driver": "local",
		"Labels": {},
		"Mountpoint": "/var/lib/docker/volumes/apa000vol1/_data",
		"Name": "apa000vol1",
		"Options": {},
		"Scope": "local"
	}
]
```

- container

```
docker container inspect apa000ex21
```

- 結果

```
	"Mounts": [
			{
					"Type": "volume",
					"Name": "apa000vol1",
					"Source": "/var/lib/docker/volumes/apa000vol1/_data",
					"Destination": "/usr/local/apache2/htdocs",
					"Driver": "local",
					"Mode": "z",
					"RW": true,
					"Propagation": ""
			}
	],
```

4. ボリュームの削除

コンテナを停止・削除してからボリュームを削除

```
docker volume rm apa000vol1
```

### コンテナのイメージ化

イメージの作成方法

1. `commit`でイメージの書き出し

```
docker commit コンテナ名 作成するイメージ名
```

2. `Dockerfile`でイメージの作成(イメージを作ること only)

```
docker build -t イメージ名 ファイルパス
```

### コンテナを commit でイメージ化

1. Apache コンテナを作成・起動

```
docker run --name apa000ex22 -d -p 8092:80 httpd
```

2. コンテナをイメージに書き出す

```
docker commit apa000ex22 ex22_original1
```

### Dockerfile でイメージを作成

1. Dockerfile を作成

```
touch docker/docker-kubernetes-basic/apa_folder/Dockerfile

# Dockerfile
FROM httpd
COPY index.html /usr/local/apache2/htdocs/
```

2. 「Build」コマンドを実行してイメージを作成

```
docker build -t ex22_original2 /Users/takeshi-arihori/Documents/learning/learn-recursionCS/docker/docker-kubernetes-basic/apa_folder/
```

### コンテナの改造

1. file をコピーしたり、記憶領域をマウントしたり。
2. Linux のコマンドで命令。ソフトウェアのインストールや設定を書き換え。コンテナへの命令には shell で行う。(bash など)
   コンテナの中でコマンドを実行する際は、`docker exec`で実行

- bash を起動させるコマンド (`docker run`コマンドや `docker exec`コマンドにつけて実行する。)
  `/bin/bash`

### Docker Compose

Docker Compose では構築に関する設定を記述した定義ファイルを YAML(YAML Ain't Markup Language)形式で用意し、ファイルの中身を「up(一括実行=run)」したり、「down(コンテナとネットワーク一括停止・削除)」したりする。

#### Dockerfile と Docker Compose , Kubernetes の違い

- Docker Compose は「docker run」の集合体で、作成するのはコンテナと周辺環境。(ネットワークやボリュームも合わせて作成できる。)あくまでコンテナを作って消すだけなので、管理はできない。
- Dockerfile は、イメージを作るものなのでネットワークやボリュームを作成できない。
- Kubernetes は、コンテナを管理するものである。

Container の集合体: Services

定義ファイルの記述例(大項目のみ)

```
version: '3'
services:
networks:
volumes:
```

定義ファイル(YAML 形式)の記述ルールまとめ

- 最初に Docker Compose のバージョンを記述
- 大項目「services」「networks」「volumes」に続いて設定内容を書く
- 親子関係はスペースで字下げして表す
- 字下げのスペースは、同じ数の倍数とする
- 名前は、大項目の下に字下げして書く
- コンテナの設定内容は、名前の下に字下げして書く
- 「-」が入っていたら複数指定できる
- 名前の後ろには「:」をつける
- 「:」の後ろには空白が必要(例外的にすぐ改行する時は不要)
- コメントを入れたい場合は#を使う(コメントアウト)
- 文字列を入れる場合は、「シングルクォート」、「ダブルクォート」のどちらかでくくる
