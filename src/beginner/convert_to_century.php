<h1>西暦を世紀へ変換</h1>
<p>medium</p>
<div>西暦 year が与えられるので、世紀へと変更する関数、getCentury という関数を作成してください。</div>
<?php
function convertToCentury(int $year): string
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
