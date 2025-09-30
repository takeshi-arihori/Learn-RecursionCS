-- RecursionCurriculum 共通PostgreSQLデータベース初期化SQL
-- 主にJava/Spring Boot, Python, TypeScript環境で使用

-- ==============================================
-- データベース作成（docker-compose.ymlで自動作成されるが念のため）
-- ==============================================

-- メインデータベースは既に作成済み（recursion_db）
-- テスト用データベース作成
CREATE DATABASE recursion_db_test WITH ENCODING 'UTF8' LC_COLLATE='ja_JP.UTF-8' LC_CTYPE='ja_JP.UTF-8';

-- ==============================================
-- 拡張機能の有効化
-- ==============================================

-- UUID生成機能
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- 全文検索機能
CREATE EXTENSION IF NOT EXISTS "pg_trgm";

-- 暗号化関数
CREATE EXTENSION IF NOT EXISTS "pgcrypto";

-- ==============================================
-- メインデータベースのテーブル作成
-- ==============================================

\c recursion_db;

-- ユーザーテーブル（全言語共通）
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    uuid UUID DEFAULT uuid_generate_v4() UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    last_login_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ユーザーテーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);
CREATE INDEX IF NOT EXISTS idx_users_uuid ON users(uuid);
CREATE INDEX IF NOT EXISTS idx_users_created_at ON users(created_at);
CREATE INDEX IF NOT EXISTS idx_users_is_active ON users(is_active);

-- 商品テーブル（EC学習用）
CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    uuid UUID DEFAULT uuid_generate_v4() UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price NUMERIC(10, 2) NOT NULL,
    stock_quantity INTEGER DEFAULT 0,
    category_id INTEGER,
    is_active BOOLEAN DEFAULT TRUE,
    metadata JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 商品テーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_products_category ON products(category_id);
CREATE INDEX IF NOT EXISTS idx_products_price ON products(price);
CREATE INDEX IF NOT EXISTS idx_products_is_active ON products(is_active);
CREATE INDEX IF NOT EXISTS idx_products_metadata ON products USING GIN(metadata);

-- カテゴリテーブル
CREATE TABLE IF NOT EXISTS categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    parent_id INTEGER NULL,
    display_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- カテゴリテーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_categories_parent ON categories(parent_id);
CREATE INDEX IF NOT EXISTS idx_categories_slug ON categories(slug);

-- 注文テーブル
CREATE TABLE IF NOT EXISTS orders (
    id SERIAL PRIMARY KEY,
    uuid UUID DEFAULT uuid_generate_v4() UNIQUE NOT NULL,
    user_id INTEGER NOT NULL,
    total_amount NUMERIC(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    shipping_address TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 注文テーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_orders_user ON orders(user_id);
CREATE INDEX IF NOT EXISTS idx_orders_status ON orders(status);
CREATE INDEX IF NOT EXISTS idx_orders_created_at ON orders(created_at);

-- 注文詳細テーブル
CREATE TABLE IF NOT EXISTS order_items (
    id SERIAL PRIMARY KEY,
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    price NUMERIC(10, 2) NOT NULL,
    subtotal NUMERIC(10, 2) GENERATED ALWAYS AS (quantity * price) STORED,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- 注文詳細テーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_order_items_order ON order_items(order_id);
CREATE INDEX IF NOT EXISTS idx_order_items_product ON order_items(product_id);

-- アプリケーションログテーブル
CREATE TABLE IF NOT EXISTS application_logs (
    id SERIAL PRIMARY KEY,
    level VARCHAR(20) NOT NULL,
    message TEXT NOT NULL,
    context JSONB,
    user_id INTEGER NULL,
    ip_address INET NULL,
    user_agent TEXT NULL,
    stack_trace TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ログテーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_logs_level ON application_logs(level);
CREATE INDEX IF NOT EXISTS idx_logs_created_at ON application_logs(created_at);
CREATE INDEX IF NOT EXISTS idx_logs_user ON application_logs(user_id);
CREATE INDEX IF NOT EXISTS idx_logs_context ON application_logs USING GIN(context);

-- セッションテーブル（Web開発用）
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id INTEGER NULL,
    ip_address INET NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- セッションテーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_sessions_user ON sessions(user_id);
CREATE INDEX IF NOT EXISTS idx_sessions_last_activity ON sessions(last_activity);

-- キャッシュテーブル（学習用）
CREATE TABLE IF NOT EXISTS cache (
    cache_key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration TIMESTAMP NOT NULL
);

-- キャッシュテーブルのインデックス
CREATE INDEX IF NOT EXISTS idx_cache_expiration ON cache(expiration);

-- ==============================================
-- トリガー関数：updated_at自動更新
-- ==============================================

CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- ユーザーテーブルのトリガー
CREATE TRIGGER update_users_updated_at BEFORE UPDATE ON users
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- 商品テーブルのトリガー
CREATE TRIGGER update_products_updated_at BEFORE UPDATE ON products
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- 注文テーブルのトリガー
CREATE TRIGGER update_orders_updated_at BEFORE UPDATE ON orders
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- ==============================================
-- ビュー：注文サマリー
-- ==============================================

CREATE OR REPLACE VIEW order_summary AS
SELECT
    o.id AS order_id,
    o.uuid AS order_uuid,
    u.name AS user_name,
    u.email AS user_email,
    o.total_amount,
    o.status,
    COUNT(oi.id) AS item_count,
    o.created_at,
    o.updated_at
FROM orders o
JOIN users u ON o.user_id = u.id
LEFT JOIN order_items oi ON o.id = oi.order_id
GROUP BY o.id, o.uuid, u.name, u.email, o.total_amount, o.status, o.created_at, o.updated_at;

-- ==============================================
-- サンプルデータ挿入
-- ==============================================

-- カテゴリサンプルデータ
INSERT INTO categories (name, slug, display_order) VALUES
('Electronics', 'electronics', 1),
('Books', 'books', 2),
('Clothing', 'clothing', 3),
('Home & Garden', 'home-garden', 4),
('Sports & Outdoors', 'sports-outdoors', 5),
('Programming', 'programming', 6),
('Web Development', 'web-development', 7),
('Database', 'database', 8)
ON CONFLICT DO NOTHING;

-- ユーザーサンプルデータ（パスワード: password - bcrypt）
INSERT INTO users (name, email, password, is_active) VALUES
('山田太郎', 'yamada@example.com', '$2a$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE),
('田中花子', 'tanaka@example.com', '$2a$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE),
('佐藤次郎', 'sato@example.com', '$2a$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE),
('鈴木美咲', 'suzuki@example.com', '$2a$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE),
('高橋健太', 'takahashi@example.com', '$2a$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE)
ON CONFLICT DO NOTHING;

-- 商品サンプルデータ（JSONB metadata付き）
INSERT INTO products (name, description, price, stock_quantity, category_id, is_active, metadata) VALUES
('スマートフォン', '最新のスマートフォン', 89800.00, 50, 1, TRUE, '{"brand": "TechCo", "color": "black", "specs": {"ram": "8GB", "storage": "256GB"}}'),
('ノートパソコン', '高性能ノートPC', 128000.00, 30, 1, TRUE, '{"brand": "CompTech", "cpu": "Intel i7", "screen": "15.6inch"}'),
('PHPプログラミング入門', 'PHP学習の決定版', 3200.00, 100, 2, TRUE, '{"pages": 480, "publisher": "TechBooks", "isbn": "978-1234567890"}'),
('JavaによるSpring Boot入門', 'Spring Boot完全ガイド', 3800.00, 80, 2, TRUE, '{"pages": 520, "publisher": "DevPress", "version": "Spring Boot 3.x"}'),
('Goプログラミング実践', 'Goで学ぶバックエンド開発', 3500.00, 60, 2, TRUE, '{"pages": 450, "publisher": "CodePub"}'),
('TypeScript完全ガイド', '型安全なJavaScript開発', 3600.00, 90, 2, TRUE, '{"pages": 500, "publisher": "WebDev"}'),
('Pythonデータ分析入門', 'データサイエンスの基礎', 4200.00, 70, 2, TRUE, '{"pages": 550, "includes": "Jupyter notebooks"}'),
('PostgreSQL実践ガイド', 'リレーショナルデータベースの極意', 4800.00, 55, 8, TRUE, '{"pages": 600, "version": "PostgreSQL 16"}'),
('Docker & Kubernetes', 'コンテナ技術完全マスター', 5200.00, 45, 6, TRUE, '{"pages": 650, "hands_on": true}'),
('Tシャツ', 'コットン100%のTシャツ', 2980.00, 200, 3, TRUE, '{"sizes": ["S", "M", "L", "XL"], "colors": ["white", "black", "navy"]}'),
('ガーデニングセット', '初心者向けガーデニングツール', 5800.00, 30, 4, TRUE, '{"items": 15, "includes": "manual"}'),
('ランニングシューズ', '軽量ランニングシューズ', 12800.00, 75, 5, TRUE, '{"weight": "250g", "sizes": [25, 26, 27, 28]}')
ON CONFLICT DO NOTHING;

-- 注文サンプルデータ
INSERT INTO orders (user_id, total_amount, status, shipping_address, notes) VALUES
(1, 93000.00, 'delivered', '東京都渋谷区1-2-3 マンションA 101号室', '午前中配送希望'),
(2, 7400.00, 'processing', '大阪府大阪市北区4-5-6 ビルB 5階', '不在時は宅配ボックスへ'),
(3, 18600.00, 'shipped', '愛知県名古屋市中区7-8-9 アパートC 203号室', 'インターホン故障中'),
(4, 10000.00, 'pending', '福岡県福岡市博多区10-11-12', NULL)
ON CONFLICT DO NOTHING;

-- 注文詳細サンプルデータ
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 89800.00),
(1, 3, 1, 3200.00),
(2, 4, 1, 3800.00),
(2, 6, 1, 3600.00),
(3, 2, 1, 128000.00),
(3, 7, 1, 4200.00),
(4, 8, 1, 4800.00),
(4, 9, 1, 5200.00)
ON CONFLICT DO NOTHING;

-- ログサンプルデータ（JSONB context付き）
INSERT INTO application_logs (level, message, context, user_id, ip_address) VALUES
('INFO', 'ユーザーログイン成功', '{"action": "login", "method": "POST", "duration_ms": 45}', 1, '192.168.1.100'),
('WARNING', 'パスワード試行失敗', '{"attempts": 3, "locked": false, "email": "unknown@example.com"}', NULL, '192.168.1.200'),
('ERROR', 'データベース接続エラー', '{"error": "Connection timeout", "database": "recursion_db", "retry_count": 3}', NULL, NULL),
('INFO', '商品追加', '{"product_id": 1, "action": "create", "category": "electronics"}', 2, '192.168.1.150'),
('CRITICAL', 'システムメモリ不足', '{"usage_percent": 95, "available_mb": 512, "total_mb": 8192}', NULL, NULL),
('DEBUG', 'キャッシュヒット', '{"cache_key": "user:1:profile", "hit": true, "ttl": 3600}', NULL, NULL)
ON CONFLICT DO NOTHING;

-- ==============================================
-- テスト用データベースのテーブル作成
-- ==============================================

\c recursion_db_test;

-- 拡張機能の有効化
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE EXTENSION IF NOT EXISTS "pg_trgm";
CREATE EXTENSION IF NOT EXISTS "pgcrypto";

-- テスト用にも同じ構造を作成（データは空）
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    uuid UUID DEFAULT uuid_generate_v4() UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    last_login_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    uuid UUID DEFAULT uuid_generate_v4() UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price NUMERIC(10, 2) NOT NULL,
    stock_quantity INTEGER DEFAULT 0,
    category_id INTEGER,
    is_active BOOLEAN DEFAULT TRUE,
    metadata JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    parent_id INTEGER NULL,
    display_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id SERIAL PRIMARY KEY,
    uuid UUID DEFAULT uuid_generate_v4() UNIQUE NOT NULL,
    user_id INTEGER NOT NULL,
    total_amount NUMERIC(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    shipping_address TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS application_logs (
    id SERIAL PRIMARY KEY,
    level VARCHAR(20) NOT NULL,
    message TEXT NOT NULL,
    context JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- 権限設定
-- ==============================================

-- メインデータベースの権限
\c recursion_db;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO recursion_user;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO recursion_user;
GRANT ALL PRIVILEGES ON DATABASE recursion_db TO recursion_user;

-- テストデータベースの権限
\c recursion_db_test;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO recursion_user;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO recursion_user;
GRANT ALL PRIVILEGES ON DATABASE recursion_db_test TO recursion_user;

-- デフォルト権限設定（将来作成されるテーブルにも適用）
\c recursion_db;
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON TABLES TO recursion_user;
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON SEQUENCES TO recursion_user;

\c recursion_db_test;
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON TABLES TO recursion_user;
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON SEQUENCES TO recursion_user;

-- ==============================================
-- 初期化完了メッセージ
-- ==============================================

\c recursion_db;

SELECT 'RecursionCurriculum PostgreSQL共通データベース初期化完了！' AS message;
SELECT COUNT(*) AS user_count FROM users;
SELECT COUNT(*) AS product_count FROM products;
SELECT COUNT(*) AS category_count FROM categories;
SELECT COUNT(*) AS order_count FROM orders;
SELECT COUNT(*) AS log_count FROM application_logs;