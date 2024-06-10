<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php");
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// クエリ文字列からパラメータを取得
$min = $_GET['min'] ?? 5;
$max = $_GET['max'] ?? 20;

// パラメータが整数であることを確認
$min = (int)$min;
$max = (int)$max;

// ユーザーの生成
$users = RandomGenerator::users($min, $max);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profiles</title>
  <style>
    .cards {
      width: 100%;
      font-family: Arial, sans-serif;
      justify-content: center;
      align-items: center;
      padding: 20px;
      display: flex;
      flex-wrap: wrap;
    }

    .user-card {
      background-color: #ffffff;
      border: 1px solid #dddddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin: 2rem;
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
      width: 25rem;
      height: auto;
    }

    .user-card:hover {
      transform: translate(10px, -10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    h1,
    h2 {
      font-size: 24px;
      margin-bottom: 10px;
      text-align: center;
    }

    .user-card p {
      font-size: 14px;
      margin: 5px 0;
    }

    @media (max-width: 768px) {
      .user-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <h1>User Profiles</h1>
  <!-- ユーザーの数を表示 -->
  <h2><?php echo count($users); ?> Users</h2>
  <div class="cards">
    <?php foreach ($users as $user) : ?>
      <?php echo $user->toHTML(); ?>
    <?php endforeach; ?>
  </div>
</body>

</html>