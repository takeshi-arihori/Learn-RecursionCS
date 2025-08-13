<?php
/**
 * 初級レベル - 西暦→世紀変換テスト
 * 
 * このテストファイルは初学者がPHPの基本的なテストの書き方を
 * 学ぶためのサンプルです。
 */

// テスト対象の関数を読み込み
require_once __DIR__ . '/../src/convert_to_century.php';

/**
 * 簡単なテスト関数
 */
function test_convertToCentury() {
    echo "=== 西暦→世紀変換テスト ===\n";
    
    // テストケース配列
    $testCases = [
        ['year' => 2000, 'expected' => '20th century'],
        ['year' => 2001, 'expected' => '21st century'],
        ['year' => 1900, 'expected' => '19th century'],
        ['year' => 1901, 'expected' => '20th century'],
        ['year' => 100, 'expected' => '1st century'],
        ['year' => 101, 'expected' => '2nd century'],
        ['year' => 200, 'expected' => '2nd century'],
        ['year' => 201, 'expected' => '3rd century'],
        ['year' => 1100, 'expected' => '11th century'],
        ['year' => 1200, 'expected' => '12th century'],
        ['year' => 1300, 'expected' => '13th century'],
    ];
    
    $passCount = 0;
    $totalCount = count($testCases);
    
    foreach ($testCases as $i => $testCase) {
        $year = $testCase['year'];
        $expected = $testCase['expected'];
        $actual = convertToCentury($year);
        
        if ($actual === $expected) {
            echo "✅ テスト" . ($i + 1) . ": PASS - {$year}年 → {$actual}\n";
            $passCount++;
        } else {
            echo "❌ テスト" . ($i + 1) . ": FAIL - {$year}年\n";
            echo "   期待値: {$expected}\n";
            echo "   実際値: {$actual}\n";
        }
    }
    
    echo "\n=== テスト結果 ===\n";
    echo "成功: {$passCount}/{$totalCount}\n";
    
    if ($passCount === $totalCount) {
        echo "🎉 すべてのテストが成功しました！\n";
    } else {
        echo "⚠️ 一部のテストが失敗しました。コードを確認してください。\n";
    }
    
    return $passCount === $totalCount;
}

/**
 * エッジケースのテスト
 */
function test_edgeCases() {
    echo "\n=== エッジケーステスト ===\n";
    
    $edgeCases = [
        ['year' => 1, 'expected' => '1st century'],
        ['year' => 11, 'expected' => '1st century'],
        ['year' => 1111, 'expected' => '12th century'],
        ['year' => 2100, 'expected' => '21st century'],
        ['year' => 2200, 'expected' => '22nd century'],
        ['year' => 2300, 'expected' => '23rd century'],
    ];
    
    $passCount = 0;
    $totalCount = count($edgeCases);
    
    foreach ($edgeCases as $i => $testCase) {
        $year = $testCase['year'];
        $expected = $testCase['expected'];
        $actual = convertToCentury($year);
        
        if ($actual === $expected) {
            echo "✅ エッジケース" . ($i + 1) . ": PASS - {$year}年 → {$actual}\n";
            $passCount++;
        } else {
            echo "❌ エッジケース" . ($i + 1) . ": FAIL - {$year}年\n";
            echo "   期待値: {$expected}\n";
            echo "   実際値: {$actual}\n";
        }
    }
    
    echo "\nエッジケース結果: {$passCount}/{$totalCount}\n";
    return $passCount === $totalCount;
}

// メイン実行部分
if (php_sapi_name() === 'cli') {
    echo "🚀 初級PHPテスト実行中...\n\n";
    
    $basicTestResult = test_convertToCentury();
    $edgeTestResult = test_edgeCases();
    
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "📊 最終結果\n";
    echo str_repeat("=", 50) . "\n";
    
    if ($basicTestResult && $edgeTestResult) {
        echo "🎯 すべてのテストが成功しました！\n";
        echo "📚 次のステップ: intermediate/ ディレクトリで中級問題に挑戦しましょう。\n";
        exit(0);
    } else {
        echo "🔧 一部のテストが失敗しました。\n";
        echo "💡 ヒント: src/convert_to_century.php の実装を確認してください。\n";
        exit(1);
    }
} else {
    echo "<p>このテストファイルはコマンドラインから実行してください。</p>";
    echo "<p>実行方法: <code>php tests/ConvertToCenturyTest.php</code></p>";
}