-- RecursionCurriculum 共通データベース初期化SQL
-- 全言語環境（PHP, Java, Go, TypeScript, Python, C++）から共通で使用

-- ==============================================
-- データベース作成
-- ==============================================

-- メインデータベース
CREATE DATABASE IF NOT EXISTS recursion_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- テスト用データベース
CREATE DATABASE IF NOT EXISTS recursion_db_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ==============================================
-- メインデータベースのテーブル作成
-- ==============================================

USE recursion_db;

-- ユーザーテーブル（全言語共通）
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ユーザー情報テーブル';

-- 商品テーブル（EC学習用）
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT DEFAULT 0,
    category_id INT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category_id),
    INDEX idx_price (price),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品情報テーブル';

-- カテゴリテーブル
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    parent_id INT NULL,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_parent (parent_id),
    INDEX idx_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='カテゴリテーブル';

-- 注文テーブル
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    shipping_address TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='注文テーブル';

-- 注文詳細テーブル
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) GENERATED ALWAYS AS (quantity * price) STORED,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX idx_order (order_id),
    INDEX idx_product (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='注文詳細テーブル';

-- アプリケーションログテーブル
CREATE TABLE IF NOT EXISTS application_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level ENUM('debug', 'info', 'warning', 'error', 'critical') NOT NULL,
    message TEXT NOT NULL,
    context JSON,
    user_id INT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_level (level),
    INDEX idx_created_at (created_at),
    INDEX idx_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='アプリケーションログテーブル';

-- セッションテーブル（Web開発用）
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id INT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_last_activity (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='セッション管理テーブル';

-- キャッシュテーブル（学習用）
CREATE TABLE IF NOT EXISTS cache (
    cache_key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration TIMESTAMP NOT NULL,
    INDEX idx_expiration (expiration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='キャッシュテーブル';

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
('Database', 'database', 8);

-- ユーザーサンプルデータ（パスワード: password）
INSERT INTO users (name, email, password) VALUES
('山田太郎', 'yamada@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('田中花子', 'tanaka@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('佐藤次郎', 'sato@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('鈴木美咲', 'suzuki@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('高橋健太', 'takahashi@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- 商品サンプルデータ
INSERT INTO products (name, description, price, stock_quantity, category_id, is_active) VALUES
('スマートフォン', '最新のスマートフォン', 89800.00, 50, 1, TRUE),
('ノートパソコン', '高性能ノートPC', 128000.00, 30, 1, TRUE),
('PHPプログラミング入門', 'PHP学習の決定版', 3200.00, 100, 2, TRUE),
('JavaによるSpring Boot入門', 'Spring Boot完全ガイド', 3800.00, 80, 2, TRUE),
('Goプログラミング実践', 'Goで学ぶバックエンド開発', 3500.00, 60, 2, TRUE),
('TypeScript完全ガイド', '型安全なJavaScript開発', 3600.00, 90, 2, TRUE),
('Pythonデータ分析入門', 'データサイエンスの基礎', 4200.00, 70, 2, TRUE),
('Tシャツ', 'コットン100%のTシャツ', 2980.00, 200, 3, TRUE),
('ガーデニングセット', '初心者向けガーデニングツール', 5800.00, 30, 4, TRUE),
('ランニングシューズ', '軽量ランニングシューズ', 12800.00, 75, 5, TRUE),
('MySQL完全ガイド', 'データベース設計とSQL', 4500.00, 65, 8, TRUE),
('Docker実践ガイド', 'コンテナ技術の基礎', 3900.00, 55, 6, TRUE);

-- 注文サンプルデータ
INSERT INTO orders (user_id, total_amount, status, shipping_address) VALUES
(1, 93000.00, 'delivered', '東京都渋谷区1-2-3'),
(2, 6800.00, 'processing', '大阪府大阪市北区4-5-6'),
(3, 15780.00, 'shipped', '愛知県名古屋市中区7-8-9');

-- 注文詳細サンプルデータ
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 89800.00),
(1, 3, 1, 3200.00),
(2, 4, 1, 3800.00),
(2, 8, 1, 2980.00),
(3, 10, 1, 12800.00),
(3, 8, 1, 2980.00);

-- ログサンプルデータ
INSERT INTO application_logs (level, message, context, user_id) VALUES
('info', 'ユーザーログイン', JSON_OBJECT('action', 'login', 'method', 'POST'), 1),
('warning', 'パスワード試行失敗', JSON_OBJECT('attempts', 3, 'ip', '192.168.1.100'), NULL),
('error', 'データベース接続エラー', JSON_OBJECT('error', 'Connection timeout', 'database', 'recursion_db'), NULL),
('info', '商品追加', JSON_OBJECT('product_id', 1, 'action', 'create'), 2),
('critical', 'システムメモリ不足', JSON_OBJECT('usage', '95%', 'available', '512MB'), NULL);

-- ==============================================
-- テスト用データベースのテーブル作成
-- ==============================================

USE recursion_db_test;

-- テスト用にも同じ構造を作成（データは空）
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT DEFAULT 0,
    category_id INT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    parent_id INT NULL,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    shipping_address TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS application_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level ENUM('debug', 'info', 'warning', 'error', 'critical') NOT NULL,
    message TEXT NOT NULL,
    context JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==============================================
-- 権限設定
-- ==============================================

-- recursion_userに全権限付与
GRANT ALL PRIVILEGES ON recursion_db.* TO 'recursion_user'@'%';
GRANT ALL PRIVILEGES ON recursion_db_test.* TO 'recursion_user'@'%';

-- 権限を即座に反映
FLUSH PRIVILEGES;

-- ==============================================
-- 初期化完了メッセージ
-- ==============================================

SELECT 'RecursionCurriculum 共通データベース初期化完了！' AS Message;
SELECT COUNT(*) AS user_count FROM recursion_db.users;
SELECT COUNT(*) AS product_count FROM recursion_db.products;
SELECT COUNT(*) AS category_count FROM recursion_db.categories;
SELECT COUNT(*) AS order_count FROM recursion_db.orders;