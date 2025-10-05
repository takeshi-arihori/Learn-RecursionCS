# =============================================
# PHP Monorepo Toolchain Helper (root対応 + help)
# Takeshi Arihori / Recursion Curriculum
# =============================================

# デフォルトターゲット（makeだけでhelpを表示）
.DEFAULT_GOAL := help

WORKDIR = /var/www/html
SERVICE = app

# ANSIカラー定義
YELLOW  = \033[33m
CYAN    = \033[36m
GREEN   = \033[32m
RESET   = \033[0m

# ===============================
# ヘルプ表示
# ===============================
.PHONY: help
help:
	@echo ""
	@echo "$(CYAN)PHP Monorepo Toolchain (root対応版)$(RESET)"
	@echo "--------------------------------------------------"
	@echo "$(YELLOW)Usage:$(RESET) make [target]"
	@echo ""
	@echo "$(GREEN)Main targets:$(RESET)"
	@echo "  make install           - composer install / dump-autoload"
	@echo "  make update            - composer update"
	@echo "  make tools-install     - install phpunit / pest / phpstan (root) and link globally"
	@echo "  make test              - run all tests via composer script"
	@echo "  make test-oop          - run tests in oop/"
	@echo "  make test-intermediate - run tests in intermediate/"
	@echo "  make stan              - run phpstan analysis"
	@echo ""
	@echo "$(GREEN)Container targets:$(RESET)"
	@echo "  make up                - start containers"
	@echo "  make down              - stop containers"
	@echo "  make rebuild           - rebuild app container (no cache)"
	@echo ""
	@echo "$(GREEN)Example:$(RESET)"
	@echo "  make tools-install"
	@echo "  make test-oop"
	@echo ""

# ===============================
# Composer 関連
# ===============================

.PHONY: install
install: ## composer install / dump-autoload
	@echo "📦 Installing composer dependencies..."
	docker compose run --rm --user root $(SERVICE) sh -lc "\
		cd $(WORKDIR) && \
		XDEBUG_MODE=off composer install && composer dump-autoload \
	"

.PHONY: update
update: ## composer update
	@echo "⬆️  Updating composer dependencies..."
	docker compose run --rm --user root $(SERVICE) sh -lc "\
		cd $(WORKDIR) && \
		XDEBUG_MODE=off composer update \
	"

# ===============================
# Dev Tools (phpunit, pest, phpstan)
# ===============================

.PHONY: tools-install
tools-install: ## install dev tools and link globally (root)
	@echo "🧰 Installing dev tools (phpunit, pest, phpstan)..."
	docker compose run --rm --user root $(SERVICE) sh -lc "\
		cd $(WORKDIR) && \
		XDEBUG_MODE=off composer require --dev phpunit/phpunit:^11 pestphp/pest:^3 phpstan/phpstan:^2 && \
		ln -sf /var/www/html/vendor/bin/phpunit /usr/local/bin/phpunit && \
		ln -sf /var/www/html/vendor/bin/pest /usr/local/bin/pest && \
		ln -sf /var/www/html/vendor/bin/phpstan /usr/local/bin/phpstan \
	"
	@echo "✅ Tools installed and linked globally in container (root)."

# ===============================
# テスト関連
# ===============================

.PHONY: test
test: ## run all tests via composer script
	docker compose exec --user root $(SERVICE) sh -lc "cd $(WORKDIR) && composer test"

.PHONY: test-oop
test-oop: ## run tests in oop/
	docker compose exec --user root $(SERVICE) sh -lc "cd $(WORKDIR) && vendor/bin/phpunit -c oop/phpunit.xml"

.PHONY: test-intermediate
test-intermediate: ## run tests in intermediate/
	docker compose exec --user root $(SERVICE) sh -lc "cd $(WORKDIR) && vendor/bin/phpunit -c intermediate/phpunit.xml"

# ===============================
# 静的解析
# ===============================

.PHONY: stan
stan: ## run phpstan analysis
	docker compose exec --user root $(SERVICE) sh -lc "cd $(WORKDIR) && composer stan"

# ===============================
# コンテナ管理
# ===============================

.PHONY: up
up: ## start containers
	docker compose up -d

.PHONY: down
down: ## stop containers
	docker compose down

.PHONY: rebuild
rebuild: ## rebuild app container (no cache)
	docker compose build --no-cache $(SERVICE)
