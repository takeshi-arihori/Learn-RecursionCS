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
        <main class="text-center mb-2 h-[calc(100vh-3rem)]">

            <h1>西暦を世紀へ変換</h1>
            <p>medium</p>
            <div>西暦 year が与えられるので、世紀へと変更する関数、getCentury という関数を作成してください。</div>
            <?php
            function getCentury(int $year): string
            {
                // 2で終わる場合はnd（例：22nd, 32nd）
                // 3で終わる場合はrd（例：23rd, 33rd）
                // それ以外はth（例：24th, 25th）
                // 数字が11, 12, 13の場合はthを頭につける
                $suffix = "th";
                $century = ceil($year / 100);

                // echo "century: " . $century . PHP_EOL;   
                // echo "century % 100: " . $century % 100 . PHP_EOL;   
                // echo "century % 10: " . $century % 10 . PHP_EOL;   

                if (!in_array($century % 100, [11, 12, 13])) {
                    // 1で終わる場合はst（例：21st, 31st）
                    switch ($century % 10) {
                        case 1:
                            $suffix = "st";
                            break;
                        case 2:
                            $suffix = "nd";
                            break;
                        case 3:
                            $suffix = "rd";
                            break;
                        default:
                            $suffix = "th";
                    }
                }

                return $century . $suffix . " century";
            }

            echo getCentury(2000) . '<br>';
            echo getCentury(2001) . '<br>';
            echo getCentury(2002) . '<br>';
            echo getCentury(101) . '<br>';
            echo getCentury(23) . '<br>';
            echo getCentury(3301) . '<br>';


            ?>
        </main>

        <footer class="text-center mt-12">
            <a href="/" class="inline-block bg-blue-500 text-white text-lg font-medium py-2 px-4 rounded hover:bg-blue-600 transition">
                ← Back to Home
            </a>
        </footer>
    </div>
</body>

</html>