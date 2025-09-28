<?php
declare(strict_types=1);

/**
 * RecursionCurriculum - Beginner PHP
 * 基礎的なPHPプログラミング演習エントリーポイント
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📚 Beginner PHP - RecursionCurriculum</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h1 { color: #2c3e50; text-align: center; margin-bottom: 30px; }
        .status { 
            background: #d4edda; 
            border: 1px solid #c3e6cb; 
            border-radius: 5px; 
            padding: 15px; 
            margin: 20px 0;
        }
        .info { background: #e8f4fd; border-color: #bee5eb; }
        .nav { display: flex; gap: 15px; justify-content: center; margin-top: 30px; }
        .nav a { 
            padding: 10px 20px; 
            background: #007bff; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav a:hover { background: #0056b3; }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #6c757d;
            text-decoration: none;
        }
        .back-link:hover { color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <a href="http://localhost:8080" class="back-link">← メインダッシュボードに戻る</a>
        
        <h1>📚 Beginner PHP Learning Environment</h1>
        
        <div class="status">
            <h3>✅ 環境状態</h3>
            <p><strong>PHP Version:</strong> <?= PHP_VERSION ?></p>
            <p><strong>Date:</strong> <?= date('Y-m-d H:i:s') ?></p>
            <p><strong>Server:</strong> <?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></p>
        </div>

        <div class="status info">
            <h3>📖 学習内容</h3>
            <ul>
                <li>PHP基本構文と変数</li>
                <li>関数の定義と使用</li>
                <li>制御構造（if/else, for, while）</li>
                <li>配列操作</li>
                <li>文字列処理</li>
            </ul>
        </div>

        <div class="nav">
            <a href="main.php">メイン演習</a>
            <a href="tests/">テスト実行</a>
            <a href="http://localhost:8090" target="_blank">データベース管理</a>
        </div>
    </div>
</body>
</html>