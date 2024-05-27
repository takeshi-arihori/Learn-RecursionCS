# 使用するDockerfileの構文バージョンを指定
# これにより、最新の機能やベストプラクティスが利用可能になる
# syntax=docker/dockerfile:1

# Composerの長期サポートバージョンを使って依存関係をインストールするステージを作成
FROM composer:lts as prod-deps
# アプリケーションの作業ディレクトリを設定
WORKDIR /app
# composer.jsonとcomposer.lockファイルをマウントし、キャッシュを使用して依存関係をインストール
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

# 開発用の依存関係をインストールするステージを作成
FROM composer:lts as dev-deps
# アプリケーションの作業ディレクトリを設定
WORKDIR /app
# composer.jsonとcomposer.lockファイルをマウントし、キャッシュを使用して全ての依存関係をインストール
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-interaction

# PHP 8.2とApacheをベースにしたステージを作成
FROM php:8.2-apache as base
# PDOとPDO MySQLのPHP拡張モジュールをインストール
RUN docker-php-ext-install pdo pdo_mysql
# ローカルのsrcディレクトリをコンテナ内の/var/www/htmlにコピー
COPY ./src /var/www/html

# 開発環境用のステージを作成
FROM base as development
# テストファイルをコンテナ内の/var/www/html/testsにコピー
COPY ./tests /var/www/html/tests
# 開発用のPHP設定を適用
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
# 開発用の依存関係をコピー
COPY --from=dev-deps /app/vendor/ /var/www/html/vendor

# テスト実行用のステージを作成
FROM development as test
# 作業ディレクトリを設定
WORKDIR /var/www/html
# PHPUnitを使ってテストを実行
RUN ./vendor/bin/phpunit tests/HelloWorldTest.php

# 本番環境用のステージを作成
FROM base as final
# 本番用のPHP設定を適用
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# 本番用の依存関係をコピー
COPY --from=prod-deps /app/vendor/ /var/www/html/vendor
# 実行ユーザーをwww-dataに変更
USER www-data
