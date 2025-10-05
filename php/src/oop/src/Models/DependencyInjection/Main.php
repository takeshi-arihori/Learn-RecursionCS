<?php

declare(strict_types=1);

/**
 * 依存性注入のデモンストレーション
 *
 * このファイルは依存性注入パターンの違いを示すサンプルコードです。
 * Fieldクラスの2つのメソッドを比較することで、
 * 依存性の隠蔽と依存性注入の違いを理解できます。
 */

require_once __DIR__ . '/Player.php';
require_once __DIR__ . '/Monster.php';
require_once __DIR__ . '/Coordinate.php';
require_once __DIR__ . '/Field.php';

use App\Models\DependencyInjection\Field;
use App\Models\DependencyInjection\Monster;
use App\Models\DependencyInjection\Player;

// プレイヤーとモンスターのインスタンスを作成
$p1 = new Player('Batrunner', 2000, 200, 60, 1000);
$gorilla = new Monster('Gorilla', 4000, 40, 100);
$vampire = new Monster('Vampire', 6000, 160, 20);

// フィールドを作成
$world = new Field();

// このメソッドではモンスターの名前とパラメータを引数として渡すことでモンスターを追加します。
// この場合、内部でどのようにモンスターが作成されているか、このメソッドがどのクラスに依存しているかはわかりません。
$world->randomlyAdd('Dragon', 30000, 400, 400);

// このメソッドではモンスターオブジェクトを直接引数として渡すことでモンスターを追加します。
// この場合、このメソッドがMonsterクラスに依存していることが明示的にわかります。
// また、モンスターオブジェクトが既に作成されているため、このメソッド内部でどのようにモンスターが作成されるかを
// 考慮する必要がありません。これが依存性注入の一例です。
$world->randomlyAddWithDependency($gorilla);
$world->randomlyAddWithDependency($vampire);

// フィールドの状態を出力
echo $world;
