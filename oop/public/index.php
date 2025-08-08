<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/models/Person.php';
require_once __DIR__ . '/../src/models/Wallet.php';

$person = new Person("John", "Doe", 20, 1.8, 70);
echo "<h1>Person and Wallet Demo</h1>";

echo "<h2>Initial State:</h2>";
echo "<p>";
$person->printState();
echo "</p>";

echo "<h2>Adding Wallet and Money:</h2>";
$wallet = new Wallet();
$person->addWallet($wallet);
$person->wallet->insertBill(100, 10);

echo "<p>";
$person->printState();
echo "</p>";

echo "<h3>Total Money: $" . $person->getCash() . "</h3>";

echo "<h2>Dropping Wallet:</h2>";
$droppedWallet = $person->dropWallet();
echo "<p>Wallet dropped. Current cash: $" . $person->getCash() . "</p>";

if ($droppedWallet !== null) {
    echo "<p>Dropped wallet had: $" . $droppedWallet->getTotalMoney() . "</p>";
}