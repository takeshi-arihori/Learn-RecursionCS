<?php
declare(strict_types=1);

/**
 * RecursionCurriculum MySQL接続サンプル
 *
 * 各PHPプロジェクトでMySQLに接続する際の基本パターンを示します。
 */

// 環境変数またはコンテナ内の設定を使用
$host = 'mysql'; // Docker Composeのサービス名
$port = 3306;
$dbname = 'recursion_db';
$username = 'recursion_user';
$password = 'recursion_pass';

// DSN構築
$dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

// PDOオプション設定
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // データベース接続
    $pdo = new PDO($dsn, $username, $password, $options);
    echo "✅ MySQL接続成功!\n";

    // サンプルクエリ実行
    $stmt = $pdo->query("SELECT COUNT(*) as user_count FROM users");
    $result = $stmt->fetch();
    echo "👥 ユーザー数: {$result['user_count']}\n";

    // サンプル挿入
    $stmt = $pdo->prepare("INSERT INTO application_logs (level, message, context) VALUES (?, ?, ?)");
    $stmt->execute([
        'info',
        'MySQL接続テスト実行',
        json_encode(['timestamp' => date('Y-m-d H:i:s'), 'source' => 'connection_test'])
    ]);
    echo "📝 ログ挿入完了\n";

    // 商品データ取得例
    $stmt = $pdo->query("
        SELECT p.name, p.price, c.name as category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        LIMIT 3
    ");

    echo "\n🛍️ 商品サンプル:\n";
    while ($product = $stmt->fetch()) {
        echo "  - {$product['name']} (¥{$product['price']}) - {$product['category_name']}\n";
    }

} catch (PDOException $e) {
    echo "❌ データベース接続エラー: " . $e->getMessage() . "\n";
    exit(1);
}

/**
 * 実用的なDB接続クラスの例
 */
class DatabaseConnection
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $dsn = "mysql:host=mysql;port=3306;dbname=recursion_db;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            self::$instance = new PDO($dsn, 'recursion_user', 'recursion_pass', $options);
        }

        return self::$instance;
    }
}

// 使用例
try {
    $db = DatabaseConnection::getInstance();
    echo "\n✅ シングルトンDB接続成功!\n";
} catch (PDOException $e) {
    echo "\n❌ シングルトンDB接続エラー: " . $e->getMessage() . "\n";
}