<?php

/**
 * Main.php
 * 
 * Player と Monster クラスの動作デモンストレーション
 * 元のJavaコードと同じシナリオで単位不一致問題を再現
 * 
 * @author   Recursion Curriculum
 * @version  1.0.0
 */

require_once __DIR__ . '/Player.php';
require_once __DIR__ . '/Monster.php';

/**
 * メイン実行関数
 */
function main(): void
{
    echo "=== Player vs Monster Demo ===\n\n";

    // プレイヤーとモンスターを作成（元のJavaコードと同じ設定）
    $p1 = new Player("Batrunner", 2000, 200, 60, 1000);
    $gorilla = new Monster("Gorilla", 4000, 40, 100);
    $vampire = new Monster("Vampire", 6000, 160, 20);

    // 初期状態の表示
    echo "=== 初期状態 ===\n";
    echo $p1 . "\n";
    echo $gorilla . "\n";
    echo $vampire . "\n\n";

    // 単位不一致問題のデモンストレーション
    echo "=== 単位不一致問題のデモ ===\n";
    echo "Player身長: " . $p1->getHeight() . " meters\n";
    echo "Gorilla身長: " . $gorilla->getHeight() . " centimeters\n";
    $gorillaHeight = $gorilla->getHeight();
    $playerThreshold = $p1->getHeight() * 3;
    echo "攻撃判定: Gorilla身長({$gorillaHeight}) >= Player身長 × 3({$playerThreshold})
";
    $attackResult = ($gorilla->getHeight() >= $p1->getHeight() * 3) ? "true (攻撃無効)" : "false (攻撃有効)";
    echo "結果: " . $attackResult . "

";

    // 攻撃実行
    echo "=== 攻撃実行 ===\n";
    $p1->attack($gorilla);
    echo "攻撃後の" . $gorilla . "\n";
    echo "→ ゴリラの体力が変わっていない（単位不一致による問題）\n\n";

    // 正しい単位変換での比較
    echo "=== 正しい単位変換での比較 ===\n";
    $playerHeightCm = $p1->getHeight() * 100; // メートル → センチメートル
    echo "Player身長（センチメートル換算）: {$playerHeightCm}cm\n";
    echo "Gorilla身長: " . $gorilla->getHeight() . "cm\n";
    $gorillaHeight2 = $gorilla->getHeight();
    $playerThresholdCm = $playerHeightCm * 3;
    echo "正しい判定: Gorilla身長({$gorillaHeight2}) >= Player身長 × 3({$playerThresholdCm})
";
    $correctResult = ($gorilla->getHeight() >= $playerHeightCm * 3) ? "true (攻撃無効)" : "false (攻撃有効)";
    echo "結果: " . $correctResult . "
";
    echo "→ 正しい単位で比較すれば攻撃は有効になるはず\n\n";

    // Vampireとの戦闘（防御力が低いので攻撃力判定で通るかもしれない）
    echo "=== Vampire との戦闘 ===\n";
    echo "Vampire防御力: " . $vampire->getDefense() . "\n";
    echo "Player攻撃力: " . $p1->getAttack() . "\n";
    $playerAttack = $p1->getAttack();
    $vampireDefense = $vampire->getDefense();
    echo "攻撃力判定: Player攻撃力({$playerAttack}) > Vampire防御力({$vampireDefense})
";
    $vampireHeight = $vampire->getHeight();
    $playerThreshold3 = $p1->getHeight() * 3;
    echo "身長判定: Vampire身長({$vampireHeight}) >= Player身長 × 3({$playerThreshold3})
";
    $p1->attack($vampire);
    echo "攻撃後の" . $vampire . "\n";
    echo "→ 身長判定で引っかかり、こちらも攻撃無効\n";
}

// メイン関数を実行
main();
