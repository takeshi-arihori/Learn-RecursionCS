<?php

/************************************************************
 ************************** 関数の分解(2) **********************
 ************************************************************
 */

/**
 * クレジットカード番号と請求金額を受け取り、カードが有効かつ支払い可能であれば、税とチップを追加した総額を返す関数
 * @param int $cardNumber クレジットカード番号
 * @param float $cost 請求金額
 * @return float 税とチップの総額
 */
function processPayment(int $cardNumber, float $cost): float
{
    // カードが有効かチェック
    $validcard = isCardValid($cardNumber);
    if (!$validcard) return -1;

    // チップの追加
    $tips = askForTips($cost);

    // 合計の金額
    $totalPayment = calculateTaxes($cost) + $tips;

    // カードと総額を決済ゲートウェイに送信
    $processSuccess = processCardThroughGateway($cardNumber, $totalPayment);
    if (!$processSuccess) return -1;

    // 送信した金額を返す
    return $totalPayment;
}


/**
 * クレジットカード番号が有効かどうかをチェックする関数
 * @param int $cardNumber クレジットカード番号
 * @return bool カードが有効であればtrue、無効であればfalse
 */
function isCardValid(int $cardNumber): bool
{
    // 簡単なチェック: カード番号が16桁であることを確認
    return strlen((string)$cardNumber) === 16;
}

/**
 * 請求金額に対してチップを計算する関数
 * @param float $cost 請求金額
 * @return float チップの金額
 */
function askForTips(float $cost): float
{
    // チップを10%と仮定
    $tipPercentage = 0.10;
    return $cost * $tipPercentage;
}

/**
 * 請求金額に対して税を計算する関数
 * @param float $cost 請求金額
 * @return float 税の金額
 */
function calculateTaxes(float $cost): float
{
    // 税率を8%と仮定
    $taxRate = 0.08;
    return $cost * $taxRate;
}

/**
 * クレジットカードを使用して決済ゲートウェイを通じて支払いを処理する関数
 * @param int $cardNumber クレジットカード番号
 * @param float $totalPayment 支払い総額
 * @return bool 支払いが成功した場合はtrue、失敗した場合はfalse
 */
function processCardThroughGateway(int $cardNumber, float $totalPayment): bool
{
    // 簡単なシミュレーション: 支払いが1000以下であれば成功とする
    return $totalPayment <= 1000;
}



/**
 * テスト関数: processPaymentの動作を確認する
 */
function testProcessPayment()
{
    // テストケース1: 有効なカードと正常な金額
    $cardNumber = 1234567890123456;
    $cost = 100.0;
    $result = processPayment($cardNumber, $cost);
    echo "Test Case 1: " . ($result > 0 ? "Passed" : "Failed") . "\n";
    echo "<br>";

    // テストケース2: 無効なカード
    $invalidCardNumber = 111111111111111;
    $result = processPayment($invalidCardNumber, $cost);
    echo "Test Case 2: " . ($result == -1 ? "Passed" : "Failed") . "\n";
    echo "<br>";

    // テストケース3: 決済ゲートウェイが失敗する場合
    $cardNumber = 1234567890123456;
    $cost = 1000000.0; // 高額で失敗する想定
    $result = processPayment($cardNumber, $cost);
    echo "Test Case 3: " . ($result == -1 ? "Passed" : "Failed") . "\n";
    echo "<br>";

    // テストケース4: 税とチップが正しく計算されるか
    $cardNumber = 1234567890123456;
    $cost = 50.0;
    $expectedTotal = calculateTaxes($cost) + askForTips($cost);
    $result = processPayment($cardNumber, $cost);
    echo "Test Case 4: " . ($result == $expectedTotal ? "Passed" : "Failed") . "\n";
    echo "<br>";
}

// テスト関数を実行
testProcessPayment();
