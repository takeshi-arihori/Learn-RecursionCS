<?php

spl_autoload_extensions(".php");
spl_autoload_register( function($name) {
    // __DIR__は、現在のファイルの絶対ディレクトリパスを取得します。
    $filepath = __DIR__ . "/" . str_replace('\\', '/', $name) . ".php";
    echo "\nRequiring...." . $name . " once ($filepath).\n";
    // バックスラッシュ(\)をフロントスラッシュ(/)に置き換えます。フロントスラッシュはLinuxのファイルパスで使用されます。
    require_once $filepath;
});

$gasCar = new \Cars\GasCar('Toyota');
$electricCar = new \Cars\ElectricCar('Tesla');

echo $gasCar->drive() . PHP_EOL; // Output: Driving the gas car...
echo $gasCar->start() . PHP_EOL; // Output: Starting the gasoline engine...

echo $electricCar->drive() . PHP_EOL; // Output: Driving the electric car...
echo $electricCar->start() . PHP_EOL; // Output: Starting the electric engine...
