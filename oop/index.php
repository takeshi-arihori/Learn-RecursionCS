<?php
declare(strict_types=1);

/**
 * RecursionCurriculum - OOP PHP
 * オブジェクト指向プログラミング演習エントリーポイント
 */

// Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏗️ OOP PHP - RecursionCurriculum</title>
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
        .composer-info {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .composer-info h4 {
            margin-top: 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="http://localhost:8080" class="back-link">← メインダッシュボードに戻る</a>
        
        <h1>🏗️ OOP PHP Development Environment</h1>
        
        <div class="status">
            <h3>✅ 環境状態</h3>
            <p><strong>PHP Version:</strong> <?= PHP_VERSION ?></p>
            <p><strong>Date:</strong> <?= date('Y-m-d H:i:s') ?></p>
            <p><strong>Composer:</strong> <?= file_exists(__DIR__ . '/vendor/autoload.php') ? '✅ 利用可能' : '❌ 未インストール' ?></p>
            <p><strong>Docker Environment:</strong> ✅ 稼働中</p>
        </div>

        <div class="grid">
            <div class="card">
                <h3>🎭 基本概念</h3>
                <ul>
                    <li>クラスとオブジェクト</li>
                    <li>継承 (Inheritance)</li>
                    <li>カプセル化 (Encapsulation)</li>
                    <li>ポリモーフィズム</li>
                    <li>抽象化 (Abstraction)</li>
                </ul>
            </div>

            <div class="card">
                <h3>🔧 デザインパターン</h3>
                <ul>
                    <li>Factory Pattern</li>
                    <li>Observer Pattern</li>
                    <li>Strategy Pattern</li>
                    <li>Command Pattern</li>
                    <li>MVC Architecture</li>
                </ul>
            </div>

            <div class="card">
                <h3>🏛️ アーキテクチャ</h3>
                <ul>
                    <li>SOLID原則</li>
                    <li>依存性注入 (DI)</li>
                    <li>インターフェース設計</li>
                    <li>名前空間とオートローディング</li>
                    <li>テスト駆動開発 (TDD)</li>
                </ul>
            </div>

            <div class="card">
                <h3>🔬 実装例</h3>
                <ul>
                    <li>Person & Wallet クラス</li>
                    <li>Vehicle継承システム</li>
                    <li>Animal多様性実装</li>
                    <li>Audibleインターフェース</li>
                    <li>Engine系クラス群</li>
                </ul>
            </div>
        </div>

        <?php if (file_exists(__DIR__ . '/vendor/autoload.php')): ?>
        <div class="composer-info">
            <h4>📦 Composer パッケージ情報</h4>
            <p>PHPUnit, PHPStan, Laravel Pint が利用可能です。</p>
            <p>テスト実行: <code>./vendor/bin/phpunit</code></p>
            <p>静的解析: <code>./vendor/bin/phpstan analyse</code></p>
        </div>
        <?php endif; ?>

        <div class="status info">
            <h3>📚 学習目標</h3>
            <ul>
                <li>オブジェクト指向の四大原則の理解と実装</li>
                <li>実世界の問題をクラス設計で解決</li>
                <li>テスト可能でメンテナブルなコード作成</li>
                <li>デザインパターンの適切な適用</li>
                <li>リファクタリングスキルの向上</li>
            </ul>
        </div>

        <div class="nav">
            <a href="relationships.php">関係性デモ</a>
            <a href="tests/">テスト実行</a>
            <a href="docs/">ドキュメント</a>
            <a href="http://localhost:8081">Beginner PHP</a>
            <a href="http://localhost:8082">Intermediate PHP</a>
            <a href="http://localhost:8090" target="_blank">データベース管理</a>
        </div>
    </div>
</body>
</html>