# RecursionCurriculum Go Development Environment
FROM golang:1.21-alpine

LABEL description="Go 1.21 Development Environment with Hot Reload"

# 必要なパッケージインストール
RUN apk add --no-cache \
    git \
    curl \
    make \
    gcc \
    musl-dev

# Air（ホットリロード）インストール
RUN go install github.com/cosmtrek/air@latest

# 作業ディレクトリ
WORKDIR /workspace

# Goモジュールキャッシュ
ENV GOPATH=/go
ENV PATH=$PATH:$GOPATH/bin
ENV GO111MODULE=on
ENV CGO_ENABLED=0

EXPOSE 8000

CMD ["air", "-c", ".air.toml"]