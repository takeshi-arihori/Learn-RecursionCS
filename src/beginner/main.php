<?php
// Include the function and execute if a year is provided

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intermediate</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- containerを削除してheader全体を幅100vwに対応 -->
    <header class="text-center mb-3 w-full bg-gray-200 py-4">
        <h1 class="text-4xl mb-2 font-bold text-blue-600">Beginner</h1>
        <p class="text-lg text-gray-600">Start your journey with basic recursion concepts.</p>
    </header>

    <div class="container mx-auto">
        <main class="text-center mb-2">
            <?php
            require_once('convert_to_century.php');
            ?>
        </main>

    </div>
    <footer class="text-center mt-12">
        <a href="/" class="inline-block bg-blue-500 text-white text-lg font-medium py-2 px-4 rounded hover:bg-blue-600 transition">
            ← Back to Home
        </a>
    </footer>
</body>

</html>