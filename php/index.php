<?php

function splitAndAdd(int $digits): int
{
    return splitAndAddHelper($digits, 0);
}

function splitAndAddHelper(int $digits, int $cnt): int
{
    if (!$digits) return $cnt;
    echo "digits : " . $digits . "<br>";
    $cnt += $digits % 10;
    echo "digits % = " . $digits % 10  . "<br>";
    $digits = (int)($digits / 10);
    echo "digits / = " . $digits / 10 . "<br>";

    return splitAndAddHelper($digits, $cnt);
}

?>

<p><?php print(splitAndAdd(19)); ?></p>
<p><?php print(splitAndAdd(999999)); ?></p>
<p><?php print(splitAndAdd(123456)); ?></p>
<p><?php print(splitAndAdd(123456789)); ?></p>
<p><?php print(splitAndAdd(1234567890)); ?></p>
<p><?php print(splitAndAdd(12345678901234567890)); ?></p>