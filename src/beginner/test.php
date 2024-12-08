<?php


function getCentury(int $year): string
{
    $century = ceil($year / 100);
    // 1 => st
    // 2 => nd
    // 3 => rd
    // other => th
    $suffix = "";
    return $century . " century";
}

echo getCentury(2000) . PHP_EOL;
echo getCentury(2001) . PHP_EOL;
echo getCentury(2002) . PHP_EOL;
echo getCentury(101) . PHP_EOL;
echo getCentury(23) . PHP_EOL;
echo getCentury(3301) . PHP_EOL;
