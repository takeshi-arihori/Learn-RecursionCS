<!DOCTYPE html>
<html lang="en">


<?php
// ファイル名のリスト
$files = [];
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced</title>
    <link rel="stylesheet" href="../output.css">
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-red-600">Advanced</h1>
            <p class="mt-2 text-lg text-gray-600">Explore advanced recursion techniques and challenges.</p>
        </header>

        <main class="text-center mt-12">
            <?php foreach ($files as $file): ?>
                <?php require_once($file); ?>
                <p class="text-gray-700 text-lg">This is the Advanced page. Dive into the complexities of recursion!</p>
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