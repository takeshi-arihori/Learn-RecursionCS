# RecursionCurriculum Java + Spring Boot Development Environment
FROM eclipse-temurin:21-jdk

LABEL maintainer="RecursionCurriculum"
LABEL description="Java 21 + Spring Boot + Maven/Gradle Development Environment"

# タイムゾーン設定
ENV TZ=Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 必要なパッケージインストール
RUN apt-get update && apt-get install -y \
    maven \
    gradle \
    git \
    curl \
    wget \
    vim \
    nano \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Mavenキャッシュ最適化
ENV MAVEN_OPTS="-Dmaven.repo.local=/workspace/.m2/repository -Xmx512m"
RUN mkdir -p /workspace/.m2/repository

# Gradleキャッシュ最適化
ENV GRADLE_USER_HOME=/workspace/.gradle
ENV GRADLE_OPTS="-Xmx512m -Dorg.gradle.daemon=false"
RUN mkdir -p /workspace/.gradle

# Java環境変数
ENV JAVA_HOME=/opt/java/openjdk
ENV PATH="${JAVA_HOME}/bin:${PATH}"

# 作業ディレクトリ
WORKDIR /workspace

# Spring Boot デフォルトポート + 追加ポート + デバッグポート
EXPOSE 8080 8081 5005

# ヘルスチェック用スクリプト
RUN echo '#!/bin/bash\nps aux | grep java || exit 1' > /usr/local/bin/healthcheck.sh && \
    chmod +x /usr/local/bin/healthcheck.sh

HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
    CMD ["/usr/local/bin/healthcheck.sh"]

CMD ["bash"]