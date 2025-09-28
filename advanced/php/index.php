<?php
declare(strict_types=1);

/**
 * RecursionCurriculum - Advanced PHP
 * 高度なアルゴリズムとデータ構造演習エントリーポイント
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 Advanced PHP - RecursionCurriculum</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        h1 { 
            color: #2c3e50; 
            text-align: center; 
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .status { 
            background: #d4edda; 
            border: 1px solid #c3e6cb; 
            border-radius: 8px; 
            padding: 20px; 
            margin: 20px 0;
        }
        .warning { background: #fff3cd; border-color: #ffeaa7; }
        .info { background: #e8f4fd; border-color: #bee5eb; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .nav { 
            display: flex; 
            gap: 15px; 
            justify-content: center; 
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .nav a { 
            padding: 12px 24px; 
            background: #667eea; 
            color: white; 
            text-decoration: none; 
            border-radius: 6px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .nav a:hover { 
            background: #5a67d8; 
            transform: scale(1.05);
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1em;
        }
        .back-link:hover { color: #667eea; }
        .file-list {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .file-item {
            display: inline-block;
            background: #e9ecef;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="http://localhost:8080" class="back-link">← メインダッシュボードに戻る</a>
        
        <h1>🎯 Advanced PHP Learning Environment</h1>
        
        <div class="status">
            <h3>✅ 環境状態</h3>
            <p><strong>PHP Version:</strong> <?= PHP_VERSION ?></p>
            <p><strong>Date:</strong> <?= date('Y-m-d H:i:s') ?></p>
            <p><strong>Current Directory:</strong> <?= __DIR__ ?></p>
        </div>

        <div class="grid">
            <div class="card">
                <h3>🌳 データ構造</h3>
                <ul>
                    <li>二分木実装</li>
                    <li>連結リスト</li>
                    <li>ハッシュテーブル</li>
                    <li>グラフ構造</li>
                </ul>
            </div>

            <div class="card">
                <h3>🔄 アルゴリズム</h3>
                <ul>
                    <li>ソートアルゴリズム</li>
                    <li>探索アルゴリズム</li>
                    <li>動的プログラミング</li>
                    <li>再帰的解法</li>
                </ul>
            </div>

            <div class="card">
                <h3>📊 計算量解析</h3>
                <ul>
                    <li>時間計算量 O(n)</li>
                    <li>空間計算量</li>
                    <li>アルゴリズム最適化</li>
                    <li>性能評価</li>
                </ul>
            </div>
        </div>

        <?php
        // 利用可能なPHPファイルを取得
        $phpFiles = glob('*.php');
        $phpFiles = array_filter($phpFiles, function($file) {
            return $file !== 'index.php';
        });
        ?>

        <?php if (!empty($phpFiles)): ?>
        <div class="file-list">
            <h3>📁 利用可能な演習ファイル</h3>
            <?php foreach ($phpFiles as $file): ?>
                <span class="file-item"><?= htmlspecialchars($file) ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="status info">
            <h3>📖 学習到達目標</h3>
            <ul>
                <li>複雑なデータ構造の理解と実装</li>
                <li>効率的なアルゴリズムの設計</li>
                <li>計算量を意識したコード最適化</li>
                <li>実世界の問題への応用力</li>
            </ul>
        </div>

        <div class="nav">
            <a href="main.php">メイン演習</a>
            <a href="tests/">テスト実行</a>
            <a href="http://localhost:8082">Intermediate PHP</a>
            <a href="http://localhost:8084">OOP PHP</a>
            <a href="http://localhost:8090" target="_blank">データベース管理</a>
        </div>
    </div>
</body>
</html>