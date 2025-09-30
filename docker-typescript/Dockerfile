# RecursionCurriculum TypeScript Development Environment
FROM node:20-alpine

LABEL description="TypeScript Development Environment with Node.js 20 LTS"

# 必要なパッケージインストール
RUN apk add --no-cache git curl

# グローバルパッケージインストール
RUN npm install -g \
    typescript@latest \
    ts-node \
    nodemon \
    jest \
    @types/node \
    tsx

WORKDIR /workspace

EXPOSE 3000 3001

CMD ["npm", "run", "dev"]