# RecursionCurriculum 統合PHP開発環境
FROM php:8.4-fpm

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    wget \
    sqlite3 \
    libsqlite3-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    autoconf \
    g++ \
    make \
    && rm -rf /var/lib/apt/lists/*

# PHP拡張をインストール
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_sqlite \
    pdo_mysql \
    mbstring \
    xml \
    zip \
    intl \
    gd \
    opcache

# Xdebugインストール（開発用）
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Composer 2.x インストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ設定
WORKDIR /workspace

# Composerキャッシュ最適化
ENV COMPOSER_CACHE_DIR=/tmp/composer-cache
RUN mkdir -p $COMPOSER_CACHE_DIR

# PHP-FPM設定
RUN echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/docker-php-timeout.ini \
    && echo "upload_max_filesize=100M" >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/docker-php-upload.ini

# OPcache設定（本番環境最適化）
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/docker-php-opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/docker-php-opcache.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/docker-php-opcache.ini

# Xdebug設定（開発環境用）
RUN echo "xdebug.mode=debug,develop,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# FPM設定のカスタマイズ
RUN echo "pm = dynamic" >> /usr/local/etc/php-fpm.d/zzz-custom.conf \
    && echo "pm.max_children = 20" >> /usr/local/etc/php-fpm.d/zzz-custom.conf \
    && echo "pm.start_servers = 2" >> /usr/local/etc/php-fpm.d/zzz-custom.conf \
    && echo "pm.min_spare_servers = 1" >> /usr/local/etc/php-fpm.d/zzz-custom.conf \
    && echo "pm.max_spare_servers = 3" >> /usr/local/etc/php-fpm.d/zzz-custom.conf

# Composerグローバル設定
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_CACHE_DIR=/tmp/composer-cache
RUN mkdir -p $COMPOSER_CACHE_DIR

# PHP-FPMユーザー設定
RUN usermod -u 1000 www-data \
    && groupmod -g 1000 www-data

# エントリーポイント設定
COPY --chmod=755 docker-php/docker-entrypoint.sh /usr/local/bin/
ENTRYPOINT ["docker-entrypoint.sh"]

# PHP-FPMをメインプロセスとして起動
CMD ["php-fpm"]

# ヘルスチェック
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD pidof php-fpm || exit 1