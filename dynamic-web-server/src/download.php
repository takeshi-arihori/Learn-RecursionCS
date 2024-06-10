<?php

// コードベースのファイルのオートロード設定
spl_autoload_extensions(".php");
spl_autoload_register();

// Composerの依存関係をオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// POSTリクエストからパラメータ'count'を取得。存在しない場合はデフォルトで5を設定
$count = $_POST['count'] ?? 5;
// POSTリクエストからパラメータ'format'を取得。存在しない場合はデフォルトで'html'を設定
$format = $_POST['format'] ?? 'html';

// 'count'パラメータを整数に変換
$count = (int)$count;

// 指定された数のユーザーを生成
$users = RandomGenerator::users($count, $count);

// 出力フォーマットに応じてヘッダーとコンテンツを設定
if ($format === 'markdown') {
  // Markdown形式で出力するためのヘッダーを設定し、ダウンロードさせる
  header('Content-Type: text/markdown');
  header('Content-Disposition: attachment; filename="users.md"');
  // 各ユーザーのMarkdown形式の情報を出力
  foreach ($users as $user) {
    echo $user->toMarkdown();
  }
} elseif ($format === 'json') {
  // JSON形式で出力するためのヘッダーを設定し、ダウンロードさせる
  header('Content-Type: application/json');
  header('Content-Disposition: attachment; filename="users.json"');
  // ユーザーオブジェクトを配列に変換し、JSON形式で出力
  $usersArray = array_map(fn ($user) => $user->toArray(), $users);
  echo json_encode($usersArray);
} elseif ($format === 'txt') {
  // テキスト形式で出力するためのヘッダーを設定し、ダウンロードさせる
  header('Content-Type: text/plain');
  header('Content-Disposition: attachment; filename="users.txt"');
  // 各ユーザーのテキスト形式の情報を出力
  foreach ($users as $user) {
    echo $user->toString();
  }
} else {
  // HTML形式で出力するためのヘッダーを設定（デフォルト）、ブラウザに直接表示
  header('Content-Type: text/html');
  // 各ユーザーのHTML形式の情報を出力
  foreach ($users as $user) {
    echo $user->toHTML();
  }
}
