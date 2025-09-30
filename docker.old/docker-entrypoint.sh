#!/bin/sh
set -e

# Composerの依存関係を自動インストール
echo "🔍 Checking for composer.json files..."

# 各PHPプロジェクトでComposer依存関係をインストール
for dir in beginner/php intermediate/php advanced/php oop dynamic-web-server; do
    if [ -f "$dir/composer.json" ]; then
        echo "📦 Installing dependencies for $dir..."
        cd "$dir"
        composer install --no-interaction --prefer-dist --optimize-autoloader
        cd /workspace
    fi
done

echo "✅ Environment setup completed!"
echo ""
echo "🚀 Available commands:"
echo "  docker-compose exec php-dev composer test          # Run all tests"
echo "  docker-compose exec php-dev composer analyze       # Run PHPStan analysis"
echo "  docker-compose exec php-dev composer quality       # Run quality checks"
echo ""

# 渡されたコマンドを実行
exec "$@"