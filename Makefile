# RecursionCurriculum 統合開発環境 Makefile
# PHPプロジェクト + Docker + MySQL環境の管理

# カラー定義
CYAN := \033[36m
GREEN := \033[32m
YELLOW := \033[33m
RED := \033[31m
RESET := \033[0m
BOLD := \033[1m

# プロジェクト設定
PROJECT_NAME := recursionCurriculum
COMPOSE_FILE := docker-compose.yml
PHP_PROJECTS := php/beginner php/intermediate php/advanced php/oop php/dynamic-web-server

# デフォルトターゲット
.DEFAULT_GOAL := help
.PHONY: help

# ========================================
# ヘルプ・情報表示
# ========================================

help: ## 📋 利用可能なコマンド一覧を表示
	@echo ""
	@echo "$(BOLD)$(CYAN)🚀 RecursionCurriculum 開発環境$(RESET)"
	@echo ""
	@echo "$(BOLD)Docker操作:$(RESET)"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## .*Docker/ {printf "  $(CYAN)%-20s$(RESET) %s\n", $$1, $$2}' $(MAKEFILE_LIST)
	@echo ""
	@echo "$(BOLD)PHP開発:$(RESET)"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## .*PHP/ {printf "  $(GREEN)%-20s$(RESET) %s\n", $$1, $$2}' $(MAKEFILE_LIST)
	@echo ""
	@echo "$(BOLD)データベース:$(RESET)"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## .*MySQL/ {printf "  $(YELLOW)%-20s$(RESET) %s\n", $$1, $$2}' $(MAKEFILE_LIST)
	@echo ""
	@echo "$(BOLD)開発支援:$(RESET)"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## .*Shell/ {printf "  $(CYAN)%-20s$(RESET) %s\n", $$1, $$2}' $(MAKEFILE_LIST)
	@echo ""
	@echo "$(BOLD)その他:$(RESET)"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / && !/Docker|PHP|MySQL|Shell/ {printf "  %-20s %s\n", $$1, $$2}' $(MAKEFILE_LIST)
	@echo ""

status: ## 📊 環境状態確認
	@echo "$(BOLD)$(CYAN)📊 環境状態確認$(RESET)"
	@echo "----------------------------------------"
	@docker-compose ps
	@echo ""
	@echo "$(BOLD)$(GREEN)💾 ボリューム情報$(RESET)"
	@docker volume ls | grep $(PROJECT_NAME) || echo "ボリュームが見つかりません"
	@echo ""
	@echo "$(BOLD)$(YELLOW)🌐 アクセス情報$(RESET)"
	@echo "  メインダッシュボード: http://localhost:8080"
	@echo "  phpMyAdmin:          http://localhost:8090"

info: ## ℹ️  プロジェクト情報表示
	@echo "$(BOLD)$(CYAN)ℹ️  RecursionCurriculum プロジェクト情報$(RESET)"
	@echo "----------------------------------------"
	@echo "プロジェクト名: $(PROJECT_NAME)"
	@echo "Compose ファイル: $(COMPOSE_FILE)"
	@echo "PHP プロジェクト:"
	@for project in $(PHP_PROJECTS); do \
		echo "  - $$project"; \
	done
	@echo ""
	@echo "$(BOLD)$(GREEN)📂 ディレクトリ構造$(RESET)"
	@tree -d -L 2 2>/dev/null || ls -la

# ========================================
# Docker操作
# ========================================

up: ## 🚀 Docker全サービス起動（PHP環境）
	@echo "$(BOLD)$(CYAN)🚀 PHP環境を起動中...$(RESET)"
	@make --no-print-directory up-php
	@echo "$(GREEN)✅ 起動完了！$(RESET)"

down: ## 🛑 Docker全サービス停止
	@echo "$(BOLD)$(RED)🛑 全Docker環境を停止中...$(RESET)"
	@make --no-print-directory down-all
	@echo "$(GREEN)✅ 停止完了！$(RESET)"

restart: ## 🔄 Dockerサービス再起動
	@echo "$(BOLD)$(YELLOW)🔄 Docker環境を再起動中...$(RESET)"
	@docker-compose restart
	@echo "$(GREEN)✅ 再起動完了！$(RESET)"

build: ## 🔨 Docker環境をビルド
	@echo "$(BOLD)$(CYAN)🔨 Dockerイメージをビルド中...$(RESET)"
	@docker-compose build
	@echo "$(GREEN)✅ ビルド完了！$(RESET)"

rebuild: ## 🔨 Dockerクリーンビルド（キャッシュなし）
	@echo "$(BOLD)$(CYAN)🔨 Dockerクリーンビルド中...$(RESET)"
	@docker-compose build --no-cache
	@echo "$(GREEN)✅ クリーンビルド完了！$(RESET)"

logs: ## 📋 Docker全ログ確認
	@docker-compose logs -f

logs-php: ## 📋 DockerPHPログのみ確認
	@docker-compose logs -f php-fpm

logs-mysql: ## 📋 DockerMySQLログのみ確認
	@docker-compose logs -f mysql

logs-nginx: ## 📋 DockerNginxログのみ確認
	@docker-compose logs -f nginx

# ========================================
# PHP開発支援
# ========================================

composer-install: ## 📦 PHP全プロジェクトComposer依存関係インストール
	@echo "$(BOLD)$(GREEN)📦 全プロジェクトComposer依存関係をインストール中...$(RESET)"
	@for project in $(PHP_PROJECTS); do \
		if [ -f "$$project/composer.json" ]; then \
			echo "$(CYAN)Installing dependencies for $$project...$(RESET)"; \
			docker-compose exec php-fpm composer install --working-dir=/workspace/$$project; \
		fi; \
	done
	@echo "$(GREEN)✅ 全プロジェクトインストール完了！$(RESET)"

composer-update: ## 🔄 PHP全プロジェクトComposer更新
	@echo "$(BOLD)$(GREEN)🔄 全プロジェクトComposer更新中...$(RESET)"
	@for project in $(PHP_PROJECTS); do \
		if [ -f "$$project/composer.json" ]; then \
			echo "$(CYAN)Updating dependencies for $$project...$(RESET)"; \
			docker-compose exec php-fpm composer update --working-dir=/workspace/$$project; \
		fi; \
	done
	@echo "$(GREEN)✅ 全プロジェクト更新完了！$(RESET)"

composer-install-beginner: ## 📦 PHPBeginnerプロジェクトのみComposer install
	@docker-compose exec php-fpm composer install --working-dir=/workspace/php/beginner

composer-install-intermediate: ## 📦 PHPIntermediateプロジェクトのみComposer install
	@docker-compose exec php-fpm composer install --working-dir=/workspace/php/intermediate

composer-install-advanced: ## 📦 PHPAdvancedプロジェクトのみComposer install
	@docker-compose exec php-fpm composer install --working-dir=/workspace/php/advanced

composer-install-oop: ## 📦 PHPOOPプロジェクトのみComposer install
	@docker-compose exec php-fpm composer install --working-dir=/workspace/php/oop

composer-install-web: ## 📦 PHPWebプロジェクトのみComposer install
	@docker-compose exec php-fpm composer install --working-dir=/workspace/php/dynamic-web-server

test: ## 🧪 PHP全プロジェクトテスト実行
	@echo "$(BOLD)$(GREEN)🧪 全プロジェクトテスト実行中...$(RESET)"
	@./docker/scripts/test-all.sh
	@echo "$(GREEN)✅ 全テスト完了！$(RESET)"

test-beginner: ## 🧪 PHPBeginnerテスト実行
	@echo "$(CYAN)🧪 Beginnerテスト実行中...$(RESET)"
	@docker-compose exec php-fpm sh -c "cd /workspace/php/beginner && composer test"

test-intermediate: ## 🧪 PHPIntermediateテスト実行
	@echo "$(CYAN)🧪 Intermediateテスト実行中...$(RESET)"
	@docker-compose exec php-fpm sh -c "cd /workspace/php/intermediate && composer test"

test-advanced: ## 🧪 PHPAdvancedテスト実行
	@echo "$(CYAN)🧪 Advancedテスト実行中...$(RESET)"
	@docker-compose exec php-fpm sh -c "cd /workspace/php/advanced && composer test"

test-oop: ## 🧪 PHPOOPテスト実行
	@echo "$(CYAN)🧪 OOPテスト実行中...$(RESET)"
	@docker-compose exec php-fpm sh -c "cd /workspace/php/oop && composer test"

test-web: ## 🧪 PHPWebテスト実行
	@echo "$(CYAN)🧪 Webテスト実行中...$(RESET)"
	@docker-compose exec php-fpm sh -c "cd /workspace/php/dynamic-web-server && composer test"

test-coverage: ## 📊 PHP全プロジェクトカバレッジ付きテスト
	@echo "$(BOLD)$(GREEN)📊 カバレッジ付きテスト実行中...$(RESET)"
	@for project in $(PHP_PROJECTS); do \
		if [ -f "$$project/composer.json" ]; then \
			echo "$(CYAN)Coverage test for $$project...$(RESET)"; \
			docker-compose exec php-fpm sh -c "cd /workspace/$$project && composer test:coverage"; \
		fi; \
	done

phpstan: ## 🔍 PHP全プロジェクトPHPStan静的解析
	@echo "$(BOLD)$(GREEN)🔍 PHPStan静的解析実行中...$(RESET)"
	@for project in $(PHP_PROJECTS); do \
		if [ -f "$$project/composer.json" ]; then \
			echo "$(CYAN)PHPStan analysis for $$project...$(RESET)"; \
			docker-compose exec php-fpm sh -c "cd /workspace/$$project && composer analyze"; \
		fi; \
	done

format: ## 🎨 PHP全プロジェクトコードフォーマット
	@echo "$(BOLD)$(GREEN)🎨 コードフォーマット実行中...$(RESET)"
	@for project in $(PHP_PROJECTS); do \
		if [ -f "$$project/composer.json" ]; then \
			echo "$(CYAN)Formatting $$project...$(RESET)"; \
			docker-compose exec php-fpm sh -c "cd /workspace/$$project && composer format"; \
		fi; \
	done

quality: ## ✨ PHP全プロジェクト品質チェック（フォーマット+解析+テスト）
	@echo "$(BOLD)$(GREEN)✨ 全品質チェック実行中...$(RESET)"
	@for project in $(PHP_PROJECTS); do \
		if [ -f "$$project/composer.json" ]; then \
			echo "$(CYAN)Quality check for $$project...$(RESET)"; \
			docker-compose exec php-fpm sh -c "cd /workspace/$$project && composer quality"; \
		fi; \
	done

# ========================================
# データベース操作
# ========================================

db-connect: ## 🔌 MySQLコンソール接続
	@echo "$(BOLD)$(YELLOW)🔌 MySQLに接続中...$(RESET)"
	@docker-compose exec mysql mysql -u recursion_user -precursion_pass recursion_db

db-connect-root: ## 🔑 MySQLコンソールRoot接続
	@echo "$(BOLD)$(YELLOW)🔑 MySQL（Root）に接続中...$(RESET)"
	@docker-compose exec mysql mysql -u root -proot_password

db-test: ## 🧪 MySQLデータベース接続テスト
	@echo "$(BOLD)$(YELLOW)🧪 データベース接続テスト実行中...$(RESET)"
	@docker-compose exec php-fpm php /workspace/docker/examples/mysql-connection.php

db-reset: ## 🔄 MySQLデータベースリセット
	@echo "$(BOLD)$(RED)⚠️  データベースをリセットします。続行しますか？ [y/N]$(RESET)"
	@read answer; if [ "$$answer" = "y" ] || [ "$$answer" = "Y" ]; then \
		echo "$(YELLOW)🔄 データベースリセット中...$(RESET)"; \
		docker-compose exec mysql mysql -u root -proot_password -e "DROP DATABASE IF EXISTS recursion_db; CREATE DATABASE recursion_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"; \
		docker-compose exec mysql mysql -u root -proot_password recursion_db < docker/mysql/init/01-init.sql; \
		echo "$(GREEN)✅ データベースリセット完了！$(RESET)"; \
	else \
		echo "$(YELLOW)❌ キャンセルしました$(RESET)"; \
	fi

db-backup: ## 💾 MySQLデータベースバックアップ作成
	@echo "$(BOLD)$(YELLOW)💾 データベースバックアップ作成中...$(RESET)"
	@./docker/scripts/backup.sh

db-import: ## 📥 MySQLサンプルデータインポート
	@echo "$(BOLD)$(YELLOW)📥 サンプルデータインポート中...$(RESET)"
	@docker-compose exec mysql mysql -u recursion_user -precursion_pass recursion_db < docker/mysql/init/01-init.sql
	@echo "$(GREEN)✅ インポート完了！$(RESET)"

phpmyadmin: ## 🌐 MySQLphpMyAdminをブラウザで開く
	@echo "$(BOLD)$(YELLOW)🌐 phpMyAdminを開いています...$(RESET)"
	@if command -v open >/dev/null 2>&1; then \
		open http://localhost:8090; \
	elif command -v xdg-open >/dev/null 2>&1; then \
		xdg-open http://localhost:8090; \
	else \
		echo "$(CYAN)ブラウザで http://localhost:8090 を開いてください$(RESET)"; \
	fi

# ========================================
# シェルアクセス
# ========================================

shell: ## 🐚 ShellPHP-FPMコンテナシェルアクセス
	@echo "$(BOLD)$(CYAN)🐚 PHP-FPMコンテナに接続中...$(RESET)"
	@docker-compose exec php-fpm bash

shell-mysql: ## 🐚 ShellMySQLコンテナシェルアクセス
	@echo "$(BOLD)$(CYAN)🐚 MySQLコンテナに接続中...$(RESET)"
	@docker-compose exec mysql bash

shell-nginx: ## 🐚 ShellNginxコンテナシェルアクセス
	@echo "$(BOLD)$(CYAN)🐚 Nginxコンテナに接続中...$(RESET)"
	@docker-compose exec nginx sh

shell-beginner: ## 🐚 ShellBeginnerプロジェクト環境
	@echo "$(BOLD)$(CYAN)🐚 Beginnerプロジェクト環境に接続中...$(RESET)"
	@docker-compose --profile beginner up -d
	@docker-compose exec php-beginner bash

shell-intermediate: ## 🐚 ShellIntermediateプロジェクト環境
	@echo "$(BOLD)$(CYAN)🐚 Intermediateプロジェクト環境に接続中...$(RESET)"
	@docker-compose --profile intermediate up -d
	@docker-compose exec php-intermediate bash

shell-advanced: ## 🐚 ShellAdvancedプロジェクト環境
	@echo "$(BOLD)$(CYAN)🐚 Advancedプロジェクト環境に接続中...$(RESET)"
	@docker-compose --profile advanced up -d
	@docker-compose exec php-advanced bash

shell-oop: ## 🐚 ShellOOPプロジェクト環境
	@echo "$(BOLD)$(CYAN)🐚 OOPプロジェクト環境に接続中...$(RESET)"
	@docker-compose --profile oop up -d
	@docker-compose exec php-oop bash

shell-web: ## 🐚 ShellWebプロジェクト環境
	@echo "$(BOLD)$(CYAN)🐚 Webプロジェクト環境に接続中...$(RESET)"
	@docker-compose --profile web up -d
	@docker-compose exec php-web bash

# ========================================
# クリーンアップ・メンテナンス
# ========================================

clean: ## 🧹 一時ファイル削除（vendor/, logs/, cache/）
	@echo "$(BOLD)$(YELLOW)🧹 一時ファイルを削除中...$(RESET)"
	@find . -name "vendor" -type d -exec rm -rf {} + 2>/dev/null || true
	@find . -name "*.log" -type f -delete 2>/dev/null || true
	@find . -name ".phpstan-cache" -type d -exec rm -rf {} + 2>/dev/null || true
	@find . -name ".pest" -type d -exec rm -rf {} + 2>/dev/null || true
	@find . -name "composer.lock" -type f -delete 2>/dev/null || true
	@echo "$(GREEN)✅ クリーンアップ完了！$(RESET)"

clean-docker: ## 🧹 Docker関連クリーンアップ
	@echo "$(BOLD)$(YELLOW)🧹 Docker関連をクリーンアップ中...$(RESET)"
	@docker-compose down
	@docker system prune -f
	@echo "$(GREEN)✅ Dockerクリーンアップ完了！$(RESET)"

clean-all: ## ⚠️  全データ削除（注意：データベースも含む）
	@echo "$(BOLD)$(RED)⚠️  全データ（データベース含む）を削除します。本当に続行しますか？ [y/N]$(RESET)"
	@read answer; if [ "$$answer" = "y" ] || [ "$$answer" = "Y" ]; then \
		echo "$(RED)🗑️  全データを削除中...$(RESET)"; \
		docker-compose down -v; \
		docker system prune -af; \
		make clean; \
		echo "$(GREEN)✅ 全削除完了！$(RESET)"; \
	else \
		echo "$(YELLOW)❌ キャンセルしました$(RESET)"; \
	fi

# ========================================
# 開発支援
# ========================================

setup: ## ⚙️  初回環境セットアップ
	@echo "$(BOLD)$(CYAN)⚙️  初回環境セットアップ中...$(RESET)"
	@make build
	@make up
	@sleep 10
	@make composer-install
	@make db-test
	@echo "$(GREEN)✅ セットアップ完了！$(RESET)"
	@make status

open: ## 🌐 ブラウザでダッシュボードを開く
	@echo "$(BOLD)$(CYAN)🌐 ダッシュボードを開いています...$(RESET)"
	@if command -v open >/dev/null 2>&1; then \
		open http://localhost:8080; \
	elif command -v xdg-open >/dev/null 2>&1; then \
		xdg-open http://localhost:8080; \
	else \
		echo "$(CYAN)ブラウザで http://localhost:8080 を開いてください$(RESET)"; \
	fi

watch-logs: ## 👀 リアルタイムログ監視
	@echo "$(BOLD)$(CYAN)👀 リアルタイムログ監視開始...（Ctrl+Cで終了）$(RESET)"
	@docker-compose logs -f --tail=100
# ========================================
# 言語別Docker環境管理（共通DB使用）
# ========================================

# 共通データベース管理
up-db: ## 🚀 Docker共通データベース環境起動
	@echo "$(BOLD)$(CYAN)🚀 共通データベース環境を起動中...$(RESET)"
	@cd docker-shared && docker-compose up -d
	@echo "$(GREEN)✅ 共通DB環境起動完了！$(RESET)"

down-db: ## 🛑 Docker共通データベース環境停止
	@cd docker-shared && docker-compose down

# PHP環境
up-php: up-db ## 🚀 DockerPHP環境起動
	@echo "$(BOLD)$(CYAN)🚀 PHP環境を起動中...$(RESET)"
	@cd php/docker-php && docker-compose up -d
	@echo "$(GREEN)✅ PHP環境起動完了！$(RESET)"

down-php: ## 🛑 DockerPHP環境停止
	@cd php/docker-php && docker-compose down

# Java環境
up-java: up-db ## 🚀 DockerJava環境起動
	@echo "$(BOLD)$(CYAN)🚀 Java環境を起動中...$(RESET)"
	@cd docker-java && docker-compose up -d
	@echo "$(GREEN)✅ Java環境起動完了！$(RESET)"

down-java: ## 🛑 DockerJava環境停止
	@cd docker-java && docker-compose down

# Go環境
up-go: up-db ## 🚀 DockerGo環境起動
	@cd docker-go && docker-compose up -d

down-go: ## 🛑 DockerGo環境停止
	@cd docker-go && docker-compose down

# TypeScript環境
up-typescript: up-db ## 🚀 DockerTypeScript環境起動
	@cd docker-typescript && docker-compose up -d

down-typescript: ## 🛑 DockerTypeScript環境停止
	@cd docker-typescript && docker-compose down

# Python環境
up-python: up-db ## 🚀 DockerPython環境起動
	@cd docker-python && docker-compose up -d

down-python: ## 🛑 DockerPython環境停止
	@cd docker-python && docker-compose down

# C++環境
up-cpp: ## 🚀 DockerC++環境起動
	@cd docker-cpp && docker-compose up -d

down-cpp: ## 🛑 DockerC++環境停止
	@cd docker-cpp && docker-compose down

# 全環境一括操作
up-all: ## 🚀 Docker全環境一括起動
	@make up-db && sleep 5
	@cd php/docker-php && docker-compose up -d
	@cd docker-java && docker-compose up -d
	@cd docker-go && docker-compose up -d
	@cd docker-typescript && docker-compose up -d
	@cd docker-python && docker-compose up -d
	@cd docker-cpp && docker-compose up -d

down-all: ## 🛑 Docker全環境停止
	@cd php/docker-php && docker-compose down 2>/dev/null || true
	@cd docker-java && docker-compose down 2>/dev/null || true
	@cd docker-go && docker-compose down 2>/dev/null || true
	@cd docker-typescript && docker-compose down 2>/dev/null || true
	@cd docker-python && docker-compose down 2>/dev/null || true
	@cd docker-cpp && docker-compose down 2>/dev/null || true
	@cd docker-shared && docker-compose down 2>/dev/null || true
