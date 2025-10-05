<?php
declare(strict_types=1);

/**
 * RecursionCurriculum - Dynamic Web Server
 * 動的Webサーバー実装とEngine系クラス演習エントリーポイント
 */

// Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌐 Dynamic Web Server - RecursionCurriculum</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
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
            font-size: 2.8em;
        }
        .status { 
            background: #d4edda; 
            border: 1px solid #c3e6cb; 
            border-radius: 8px; 
            padding: 20px; 
            margin: 20px 0;
        }
        .info { background: #e8f4fd; border-color: #bee5eb; }
        .warning { background: #fff3cd; border-color: #ffeaa7; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }
        .card {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 25px;
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
            border-color: #667eea;
        }
        .card h3 {
            color: #495057;
            margin-top: 0;
            font-size: 1.4em;
        }
        .nav { 
            display: flex; 
            gap: 15px; 
            justify-content: center; 
            margin-top: 40px;
            flex-wrap: wrap;
        }
        .nav a { 
            padding: 14px 28px; 
            background: #667eea; 
            color: white; 
            text-decoration: none; 
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
            font-size: 1.05em;
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
        code {
            background: #f1f3f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="http://localhost:8080" class="back-link">← メインダッシュボードに戻る</a>
        
        <h1>🌐 Dynamic Web Server Environment</h1>
        
        <div class="status">
            <h3>✅ 環境状態</h3>
            <p><strong>PHP Version:</strong> <?= PHP_VERSION ?></p>
            <p><strong>Date:</strong> <?= date('Y-m-d H:i:s') ?></p>
            <p><strong>Composer:</strong> <?= file_exists(__DIR__ . '/vendor/autoload.php') ? '✅ 利用可能' : '❌ 未インストール' ?></p>
            <p><strong>Project Path:</strong> <?= __DIR__ ?></p>
        </div>

        <div class="grid">
            <div class="card">
                <h3>🚀 Webサーバー実装</h3>
                <ul>
                    <li>HTTP リクエスト処理</li>
                    <li>ルーティングシステム</li>
                    <li>ミドルウェア実装</li>
                    <li>レスポンス生成</li>
                    <li>セッション管理</li>
                </ul>
            </div>

            <div class="card">
                <h3>⚙️ Engine系クラス</h3>
                <ul>
                    <li>Template Engine</li>
                    <li>Database Engine</li>
                    <li>Cache Engine</li>
                    <li>Security Engine</li>
                    <li>Logger Engine</li>
                </ul>
            </div>

            <div class="card">
                <h3>🔧 HTTP処理</h3>
                <ul>
                    <li>GET/POST/PUT/DELETE</li>
                    <li>ヘッダー管理</li>
                    <li>クッキー処理</li>
                    <li>ファイルアップロード</li>
                    <li>API エンドポイント</li>
                </ul>
            </div>

            <div class="card">
                <h3>🏗️ アーキテクチャ</h3>
                <ul>
                    <li>MVC パターン</li>
                    <li>依存性注入</li>
                    <li>設定管理</li>
                    <li>エラーハンドリング</li>
                    <li>パフォーマンス最適化</li>
                </ul>
            </div>
        </div>

        <div class="status info">
            <h3>🎯 学習目標</h3>
            <ul>
                <li>HTTP プロトコルの深い理解</li>
                <li>スケーラブルなWebアプリケーション設計</li>
                <li>セキュリティを考慮した実装</li>
                <li>パフォーマンスとメモリ効率の最適化</li>
                <li>実際のWebフレームワークの内部構造理解</li>
            </ul>
        </div>

        <div class="nav">
            <a href="src/">ソースコード</a>
            <a href="logs/">ログ確認</a>
            <a href="README.md">ドキュメント</a>
            <a href="http://localhost:8084">OOP PHP</a>
            <a href="http://localhost:8083">Advanced PHP</a>
            <a href="http://localhost:8090" target="_blank">データベース管理</a>
        </div>
    </div>
</body>
</html>