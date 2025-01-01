<!DOCTYPE html>
<html lang="en">

<?php

// ファイル名のリスト
$files = [
    'Test.php',
    'Newton.php',
    'Newton2.php',
    'QuadraticEquation.php',
    'ValidCredit.php',
    'Gcd.php',
    'SieveOfElastoTenes.php',
    'Stack.php',
    'TwosComplement.php',
    'ForLoop.php',
    'MathSplit.php',
];

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intermediate</title>
    <link rel="stylesheet" href="../output.css">
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-green-600">Intermediate</h1>
            <p class="mt-2 text-lg text-gray-600">Take on more complex recursion examples.</p>
        </header>

        <main class="text-center mt-12">
            <?php foreach ($files as $file): ?>
                <p class="mt-2 text-lg text-green-600"><?php echo $file; ?></p>
                <?php require_once($file); ?>
            <?php endforeach; ?>
        </main>

        <footer class="text-center mt-12">
            <a href="/" class="inline-block bg-blue-500 text-white text-lg font-medium py-2 px-4 rounded hover:bg-blue-600 transition">
                ← Back to Home
            </a>
        </footer>

    </div>
</body>

</html>